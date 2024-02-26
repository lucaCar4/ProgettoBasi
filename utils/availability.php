<?php
function checkAnno($anno, $appartamento)
{
    require_once '../bootstrap.php';
    $res = $dbh->checkListinoYear($anno, $appartamento);
    echo json_encode($res);
}

function checkDates($from, $to, $app) {
    require_once '../bootstrap.php';
    $res = $dbh->checkDate($from, $to, $app);
    echo json_encode($res);
}
function sendPeriod($data_inizio, $data_fine, $anno, $app, $prezzo) {
    require_once '../bootstrap.php';
    $dbh->insertNewPeriod($data_inizio, $data_fine, $anno, $app, $prezzo);
    echo json_encode(array( "di" => $data_inizio, "df" => $data_fine, "a" =>$anno,"aa" => $app, "p" => $prezzo));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'check_disp' : if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['id-app'])) {
                checkDates($_POST['from'], $_POST['to'], $_POST['id-app']);
            }
            break;
        }
    }

} else {
    echo 'Accesso non consentito.';
}