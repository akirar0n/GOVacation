<?php
require '../model/ClassRes.php';
require '../model/DAO/ClassResDAO.php';

$idreserva = $_POST['idreserva'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;
$idloc = $_POST['idloc'] ?? null;
$metodopag = $_POST['metodopag'] ?? null;
$datacheckin = $_POST['datacheckin'] ?? null;
$datacheckout = $_POST['datacheckout'] ?? null;

$res = new ClassRes();
$res->setIdreserva($idreserva);
$res->setIdusuario($idusuario);
$res->setIdloc($idloc);
$res->setMetodopag($metodopag);
$res->setDatacheckin($datacheckin);
$res->setDatacheckout($datacheckout);

$ClassResDAO = new ClassResDAO();

switch ($acao) {
    case 'efetuarReserva':
        $resultado = $ClassResDAO->efetuarReserva($res);
        if ($resultado >= 1) {
            header("Location:../Reserva.php?&MSG=Cadastro de locação realizado com sucesso!");
        } else {
            header('Location:../Reserva.php?&MSG=Não foi possível realizar o cadastro da locação!');
        }
        break;
}
