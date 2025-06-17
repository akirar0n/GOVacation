<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['idusuario'])) {
    header("Location: Login.php?error=4");
    exit;
}

if (!isset($_GET['idloc']) || !is_numeric($_GET['idloc'])) {
    die("Erro: ID da locação inválido.");
}

$idloc = intval($_GET['idloc']);
$idusuario = $_SESSION['idusuario'];

require './model/DAO/ClassLocsDAO.php';
require './model/ClassLocs.php';

$classLocsDAO = new ClassLocsDAO();
$locacao = $classLocsDAO->buscarLocs($idloc);

if (!$locacao || $locacao->getDisp() !== 'Disponível') {
    die("Desculpe, esta locação não está mais disponível.");
}

$accessToken = "APP_USR-2785755992350479-061500-001b96da1b4181d0713fdb3aa54e88bb-2493416496";

$paymentData = [
    'items' => [
        [
            'id' => $locacao->getIdloc(),
            'title' => 'Reserva: ' . $locacao->getTitulo(),
            'description' => $locacao->getDescr(),
            'quantity' => 1,
            'currency_id' => 'BRL',
            'unit_price' => floatval($locacao->getPreco())
        ]
    ],
    'back_urls' => [
        'success' => 'http://localhost/Projeto-GOVacation/govac/reserva_sucesso.php',
        'failure' => 'http://localhost/Projeto-GOVacation/govac/reserva_falha.php',
        'pending' => 'http://localhost/Projeto-GOVacation/govac/reserva_pendente.php'
    ],
    'notification_url' => 'https://SEU_LINK_DO_NGROK/Projeto-GOVacation/govac/confirmar_pagamento.php',
    'external_reference' => "USER_{$idusuario}_LOC_{$idloc}"
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/checkout/preferences");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accessToken
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

curl_close($ch);

$responseData = json_decode($response, true);

if (isset($responseData['init_point'])) {
    header("Location: " . $responseData['init_point']);
    exit();
} else {
    echo "<h2>Erro ao criar preferência de pagamento</h2>";
    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
    die();
}
