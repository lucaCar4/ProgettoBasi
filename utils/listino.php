<?php
function checkAnno($anno, $appartamento)
{
    require_once '../bootstrap.php';
    $res = $dbh->checkListinoYear($anno, $appartamento);
    echo json_encode($res);
}

function checkDates($data_inizio, $data_fine, $anno, $app) {
    require_once '../bootstrap.php';
    $res = $dbh->getListinoDate($data_inizio, $data_fine, $anno, $app);
    echo json_encode(count($res) == 0);
}
function sendPeriod($data_inizio, $data_fine, $anno, $app, $prezzo) {
    require_once '../bootstrap.php';
    $dbh->insertNewPeriod($data_inizio, $data_fine, $anno, $app, $prezzo);
    echo json_encode(array( "di" => $data_inizio, "df" => $data_fine, "a" =>$anno,"aa" => $app, "p" => $prezzo));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'check_year':
                if (isset($_POST['anno']) && isset($_POST['app'])) {
                    checkAnno($_POST['anno'], $_POST['app']);
                }
            case 'check_dates' : if(isset($_POST['data_inizio']) && isset($_POST['data_fine']) && isset($_POST['anno']) && isset($_POST['app'])) {
                checkDates($_POST['data_inizio'], $_POST['data_fine'], $_POST['anno'], $_POST['app']);
            }
            break;
            case 'new_period' : if(isset($_POST['data_inizio']) && isset($_POST['data_fine']) && isset($_POST['anno']) && isset($_POST['app']) && isset($_POST['prezzo'])) {
                sendPeriod($_POST['data_inizio'], $_POST['data_fine'], $_POST['anno'], $_POST['app'], $_POST['prezzo']);
            }
            break;
        }
    }

} else {
    echo 'Accesso non consentito.';
}