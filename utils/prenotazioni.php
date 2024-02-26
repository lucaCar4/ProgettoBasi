<?php
function getAppartamenti($id)
{
    require_once '../bootstrap.php';
    $res = $dbh->getAppartamentiByCondominio($id);
    if (count($res)) {
        echo json_encode(array('appartamenti' => $res));
    } else {
        echo json_encode(array('appartamenti' => array()));
    }
}

function checkDates($inizio, $fine, $id_appartamenti)
{
    require_once '../bootstrap.php';
    $bici = "";
    $check = false;
    if (explode("-", $inizio)[0] >= date("Y") && explode("-", $fine)[0] >= date("Y")) {
        $res = $dbh->checkDate($inizio, $fine, $id_appartamenti);
        if ($res) {
            $bici = $dbh->getFreeBici($inizio, $fine);
        }
        $check = $res;
    }
    echo json_encode(array("check" => $check, "bici" => $bici));
}
function getDaysDiff($from, $to)
{
    $dif = floor((strtotime($to) - strtotime($from)) / 86400) + 1;
    return $dif;
}

function getDays($from, $to, $from_p, $to_p)
{
    $effective_from = $from_p;
    $effective_to = $to_p;
    if ($from > $from_p) {
        $effective_from = $from;
    }
    if ($to < $to_p) {
        $effective_to = $to;
    }
    return getDaysDiff($effective_from, $effective_to);
}

function getAmount($from, $to, $anno, $app)
{
    require_once '../bootstrap.php';
    $periods = $dbh->getListinoDate($from, $to, $anno, $app);
    $tot_p = count($periods);
    $amount = 0;
    $days = 0;
    $errore = false;
    for ($i = 0; $i < $tot_p; $i++) {
        $from_p = $periods[$i]['Data_Inizio'];
        $to_p = $periods[$i]['Data_fine'];
        $day_price = round($periods[$i]['Prezzo'] / getDaysDiff($from_p, $to_p));
        $day_p = getDays($from, $to, $from_p, $to_p);
        $days += $day_p;
        $amount += $day_p * $day_price;
    }
    if ($days < getDaysDiff($from, $to)) {
        $errore = true;
    }
    echo json_encode(array("amount" => round($amount), "error" => $errore));
}

function checkGruppo($id)
{
    require_once '../bootstrap.php';
    $check = count($dbh->getGruppoByID($id)) == 1;
    echo json_encode($check);
}

function checkCliente($id)
{
    require_once '../bootstrap.php';
    $check = count($dbh->getClienteByID($id)) == 1;
    echo json_encode($check);
}

function prenote($cliente, $gruppo, $from, $to, $bici, $importo, $app)
{
    require_once '../bootstrap.php';
    $sconto = 0;
    if (getDaysDiff($from, $to) >= 30) {
        $sconto = 0.05;
    }
    echo json_encode($dbh->prenote($sconto, $from, $to, $importo, $app, $cliente, $gruppo));

}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'get_appartamenti':
                if (isset($_POST['id_condominio'])) {
                    getAppartamenti($_POST['id_condominio']);
                }
                break;
            case 'check':
                if (isset($_POST['data_inizio']) && isset($_POST['data_fine']) && isset($_POST['id_appartamenti'])) {
                    checkDates($_POST['data_inizio'], $_POST['data_fine'], $_POST['id_appartamenti']);
                }
                break;
            case 'amount':
                if (isset($_POST['data_inizio']) && isset($_POST['data_fine']) && isset($_POST['anno']) && isset($_POST['app'])) {
                    getAmount($_POST['data_inizio'], $_POST['data_fine'], $_POST['anno'], $_POST['app']);
                }
                break;
            case 'check_group':
                if (isset($_POST['id'])) {
                    checkGruppo($_POST['id']);
                }
                break;
            case 'check_cliente':
                if (isset($_POST['id'])) {
                    checkCliente($_POST['id']);
                }
                break;
            case 'prenote':
                if (isset($_POST['cliente']) && isset($_POST['gruppo']) && isset($_POST['data_inizio']) && isset($_POST['data_fine']) && isset($_POST['bici']) && isset($_POST['importo']) && isset($_POST['app'])) {
                    //echo json_encode(array($_POST['cliente'], $_POST['gruppo'], $_POST['data_inizio'], $_POST['data_fine'], $_POST['bici'], $_POST['importo'], $_POST['app']));
                    prenote($_POST['cliente'], $_POST['gruppo'], $_POST['data_inizio'], $_POST['data_fine'], $_POST['bici'], $_POST['importo'], $_POST['app']);
                }
        }

    }

} else {
    echo 'Accesso non consentito.';
}
