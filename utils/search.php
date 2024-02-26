<?php
function autocompleteCliente($value)
{
    require_once '../bootstrap.php';
    $clienti = $dbh->getAllCLienti();
    if (count($clienti)) {
        echo json_encode(array("res" => findClienti($clienti, $value)));
    } else {
        echo json_encode(array('res' => array()));
    }
}

function autoCompleteGruppo($value)
{
    require_once '../bootstrap.php';
    $gruppo = $dbh->getAllGruppi();
    if (count($gruppo)) {
        echo json_encode(array("res" => findGruppo($gruppo, $value)));
    } else {
        echo json_encode(array('res' => array()));
    }
}

function findGruppo($array, $value)
{
    $result = [];
    foreach ($array as $gruppo):
        $str = strtolower($gruppo['Cognome']);
        $value = strtolower($value);
        if (strpos($str, $value) !== false) {
            array_push($result, $gruppo);
        }
    endforeach;
    return $result;
}

function findClienti($array, $value)
{
    $result = [];
    foreach ($array as $cliente):
        $string = strtolower($cliente['Nome'] . " " . $cliente['Cognome']);
        $string2 = strtolower($cliente['Cognome'] . " " . $cliente['Nome']);
        $value = strtolower($value);
        if (strpos($string, $value) !== false || strpos($string2, $value) !== false) {
            array_push($result, $cliente);
        }
    endforeach;
    return $result;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        if(strpos($_POST['action'], 'cliente') !== false) {
            if (isset($_POST['value'])) {
                autocompleteCliente($_POST['value']);
            }
        } elseif(strpos($_POST['action'], 'gruppo') !== false) {
            if (isset($_POST['value'])) {
                autoCompleteGruppo($_POST['value']);
            }
        }
    }

} else {
    echo 'Accesso non consentito.';
}