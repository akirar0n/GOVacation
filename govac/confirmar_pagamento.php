<?php
ob_start();

require './model/DAO/Conexao.php';
require './model/ClassRes.php';
require './model/DAO/ClassResDAO.php';
require './model/DAO/ClassLocsDAO.php'; 

$body = file_get_contents('php://input');
$data = json_decode($body, true);

file_put_contents('webhook_log.txt', print_r($data, true), FILE_APPEND);

if (isset($data['topic']) && $data['topic'] === 'merchant_order') {
    
    $accessToken = "APP_USR-2785755992350479-061500-001b96da1b4181d0713fdb3aa54e88bb-2493416496";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $data['resource']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $headers = ['Authorization: Bearer ' . $accessToken];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $orderData = json_decode($response, true);

    if ($orderData && $orderData['status'] == 'closed' && $orderData['order_status'] == 'paid') {
        
        $externalReference = $orderData['external_reference'];
        
        if (preg_match('/USER_(\d+)_LOC_(\d+)/', $externalReference, $matches)) {
            $idusuario = (int)$matches[1];
            $idloc = (int)$matches[2];

            $classResDAO = new ClassResDAO();

            if (!$classResDAO->reservaExiste($idusuario, $idloc)) {
                
                $reserva = new ClassRes();
                $reserva->setIdusuario($idusuario);
                $reserva->setIdloc($idloc);
                $reserva->setMetodopag($orderData['payments'][0]['payment_type_id']);
                
                $classResDAO->efetuarReserva($reserva);

                $classLocsDAO = new ClassLocsDAO();
                $classLocsDAO->atualizarDisponibilidade($idloc, 'Ocupado');
            }
        }
    }
}

ob_end_clean();

http_response_code(200);
?>