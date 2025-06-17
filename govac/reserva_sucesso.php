<?php
include 'IndexCliente.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada!</title>
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
        }
        .status-icon {
            font-size: 4rem;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-container">
            <div class="status-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1 class="display-5 mt-3">Reserva Confirmada!</h1>
            <p class="lead">Seu pagamento foi aprovado com sucesso. Em breve você receberá um email com os detalhes da sua reserva.</p>
            <hr>
            <a href="BuscarLocs.php" class="btn btn-primary mt-3">Ver outras locações</a>
        </div>
    </div>
</body>
</html>