<?php
// Silencia saídas para evitar respostas inesperadas ao webhook
ob_start();

require './model/DAO/Conexao.php';
require './model/ClassRes.php';
require './model/DAO/ClassResDAO.php';
require './model/DAO/ClassLocsDAO.php'; // Precisaremos para atualizar a locação

// Pega o conteúdo da notificação enviada pelo Mercado Pago
$body = file_get_contents('php://input');
$data = json_decode($body, true);

// Log para depuração (em um ambiente de produção, use um sistema de log mais robusto)
file_put_contents('webhook_log.txt', print_r($data, true), FILE_APPEND);

// Verifica se a notificação é sobre um pagamento (merchant_order)
if (isset($data['topic']) && $data['topic'] === 'merchant_order') {
    
    // Suas credenciais
    $accessToken = "APP_USR-2785755992350479-061500-001b96da1b4181d0713fdb3aa54e88bb-2493416496";
    
    // Obtém os detalhes completos do pedido
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $data['resource']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $headers = ['Authorization: Bearer ' . $accessToken];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $orderData = json_decode($response, true);

    // Verifica se o pedido foi pago e se tem a referência externa
    if ($orderData && $orderData['status'] == 'closed' && $orderData['order_status'] == 'paid') {
        
        $externalReference = $orderData['external_reference'];
        
        // Extrai os IDs de usuário e locação da referência
        if (preg_match('/USER_(\d+)_LOC_(\d+)/', $externalReference, $matches)) {
            $idusuario = (int)$matches[1];
            $idloc = (int)$matches[2];

            $classResDAO = new ClassResDAO();

            // **IMPORTANTE**: Verifica se a reserva já não foi inserida para evitar duplicatas
            if (!$classResDAO->reservaExiste($idusuario, $idloc)) {
                
                // Cria e preenche o objeto da reserva
                $reserva = new ClassRes();
                $reserva->setIdusuario($idusuario);
                $reserva->setIdloc($idloc);
                $reserva->setMetodopag($orderData['payments'][0]['payment_type_id']); // ex: 'credit_card'
                
                // Insere a reserva no banco
                $classResDAO->efetuarReserva($reserva);

                // **PASSO ADICIONAL**: Atualiza o status da locação para 'Ocupado'
                $classLocsDAO = new ClassLocsDAO();
                $classLocsDAO->atualizarDisponibilidade($idloc, 'Ocupado');
            }
        }
    }
}

// Limpa qualquer saída acidental
ob_end_clean();

// Responde ao Mercado Pago com status 200 OK para confirmar o recebimento
http_response_code(200);
?>