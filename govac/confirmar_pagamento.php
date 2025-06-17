<?php
ob_start();

require './model/DAO/Conexao.php';
require './model/ClassRes.php';
require './model/DAO/ClassResDAO.php';
require './model/DAO/ClassLocsDAO.php';

$body = file_get_contents('php://input');
$data = json_decode($body, true);
file_put_contents('webhook_log.txt', date('Y-m-d H:i:s') . " - NOTIFICATION: " . print_r($data, true) . "\n", FILE_APPEND);

if (isset($data['topic']) && $data['topic'] === 'merchant_order') {
    $accessToken = "APP_USR-2785755992350479-061500-001b96da1b4181d0713fdb3aa54e88bb-2493416496";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $data['resource']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
    $response = curl_exec($ch);
    curl_close($ch);
    $orderData = json_decode($response, true);
    
    file_put_contents('webhook_log.txt', date('Y-m-d H:i:s') . " - ORDER DATA: " . print_r($orderData, true) . "\n", FILE_APPEND);

    if ($orderData && $orderData['status'] == 'closed' && $orderData['order_status'] == 'paid') {
        $externalReference = $orderData['external_reference'];
        
        if (preg_match('/USER_(\d+)_LOC_(\d+)_CIN_([\d-]+)_COUT_([\d-]+)/', $externalReference, $matches)) {
            $idusuario = (int)$matches[1];
            $idloc = (int)$matches[2];
            $datacheckin = $matches[3];
            $datacheckout = $matches[4];

            $classResDAO = new ClassResDAO();
            if (!$classResDAO->reservaExiste($idusuario, $idloc)) {
                $metodoDePagamento = 'Nao informado'; 
                if (isset($orderData['payments']) && !empty($orderData['payments'])) {
                    foreach ($orderData['payments'] as $payment) {
                        if (isset($payment['status']) && $payment['status'] == 'approved') {
                            $metodoDePagamento = $payment['payment_type_id'] ?? 'Aprovado';
                            break; 
                        }
                    }
                }

                $reserva = new ClassRes();
                $reserva->setIdusuario($idusuario);
                $reserva->setIdloc($idloc);
                $reserva->setMetodopag($metodoDePagamento);
                $reserva->setDatacheckin($datacheckin); 
                $reserva->setDatacheckout($datacheckout);
                
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