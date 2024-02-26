<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Appartamenti - Prenotazioni";
$templateParams['nome'] = 'template/creareGruppo.php';
$templateParams['condomini'] = $dbh->getCondomini();
if (
    isset($_POST['nome']) && isset($_POST['numero_componenti'])
) {
    $id = $dbh->createGruppo($_POST['nome']);
    for ($i = 0; $i<$_POST['numero_componenti']; $i++) {
        $cl = 'cliente' . $i;
        $rl = 'ruolo' . $i;
        if(isset($_POST[$cl]) && isset($_POST[$rl])) {
            $dbh->addPerson($_POST[$cl], $id, $_POST[$rl]);
        }
    }
    header("location:gruppi.php");
}
require("template/base.php");
