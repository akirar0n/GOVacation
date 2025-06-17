<?php
// Inclui o cabeçalho e navegação do cliente
include 'IndexCliente.php'; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Pendente - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .status-container {
            max-width: 600px;
            margin: 5rem auto;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #ffc107;
        }
        .status-icon {
            font-size: 4rem;
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-container">
            <div class="status-icon">
                <i class="bi bi-clock-fill"></i>
            </div>
            <h1 class="display-5 mt-3">Pagamento Pendente</h1>
            <p class="lead text-muted">Sua reserva foi registrada e está aguardando a confirmação do pagamento.</p>
            <hr class="my-4">
            <p>Se você optou por boleto, lembre-se de pagá-lo antes do vencimento para garantir sua locação. A confirmação pode levar até 2 dias úteis.</p>
            <a href="IndexCliente.php" class="btn btn-primary mt-3">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>