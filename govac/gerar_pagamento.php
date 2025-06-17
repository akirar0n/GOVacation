<?php
session_start();
if (!isset($_SESSION['idusuario'])) { header("Location: Login.php?error=4"); exit; }

$idloc = filter_input(INPUT_GET, 'idloc', FILTER_VALIDATE_INT);
$checkin = filter_input(INPUT_GET, 'checkin');
$checkout = filter_input(INPUT_GET, 'checkout');

if (!$idloc || !$checkin || !$checkout) {
    die("Erro: Dados da reserva inválidos ou incompletos.");
}

$idusuario = $_SESSION['idusuario'];

require './model/DAO/ClassLocsDAO.php';
require './model/ClassLocs.php';
$classLocsDAO = new ClassLocsDAO();
$locacao = $classLocsDAO->buscarLocs($idloc);

if (!$locacao || $locacao->getDisp() !== 'Disponível') {
    die("Desculpe, esta locação não está mais disponível.");
}

$accessToken = "APP_USR-2785755992350479-061500-001b96da1b4181d0713fdb3aa54e88bb-2493416496";

$externalReference = "USER_{$idusuario}_LOC_{$idloc}_CIN_{$checkin}_COUT_{$checkout}";

$paymentData = [
    'items' => [[
        'id' => $locacao->getIdloc(),
        'title' => 'Reserva: ' . $locacao->getTitulo(),
        'description' => "Check-in: $checkin, Check-out: $checkout",
        'quantity' => 1,
        'currency_id' => 'BRL',
        'unit_price' => floatval($locacao->getPreco())
    ]],
    'back_urls' => [
        'success' => 'https://4300-191-223-221-143.ngrok-free.app//Projeto-GOVacation/govac/reserva_sucesso.php',
        'failure' => 'https://4300-191-223-221-143.ngrok-free.app//Projeto-GOVacation/govac/reserva_falha.php',
        'pending' => 'https://4300-191-223-221-143.ngrok-free.app//Projeto-GOVacation/govac/reserva_pendente.php'
    ],
    'notification_url' => 'https://4300-191-223-221-143.ngrok-free.app/Projeto-GOVacation/govac/confirmar_pagamento.php', 
        // INSERIR LINK NOVO DO NGROK TODA VEZ QUE INICIAR ELE
    'external_reference' => $externalReference
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/checkout/preferences");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $accessToken]);

$response = curl_exec($ch);
curl_close($ch);
$responseData = json_decode($response, true);

if (isset($responseData['init_point'])) {
    header("Location: " . $responseData['init_point']);
    exit();
} else {
    echo "<h2>Erro ao criar preferência de pagamento</h2><pre>"; print_r($responseData); echo "</pre>"; die();
}