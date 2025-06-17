<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['idusuario'])) {
    header('Location: Login.php');
    exit();
}

$nomeUsuario = $_SESSION['nome'] ?? 'Cliente';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Cliente - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link i {
            margin-right: 0.5rem;
        }
        .welcome-panel {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            margin-top: 3rem;
        }
        .welcome-panel h1 {
            font-weight: 700;
            color: #343a40;
        }
        .welcome-panel .lead {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        .action-card {
            text-align: center;
            padding: 2rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #343a40;
            background-color: #fff;
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-color: #0d6efd;
        }
        .action-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="IndexCliente.php">GOVacation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="BuscarLocs.php">
                            <i class="bi bi-search"></i> Buscar Locações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-panel text-center">
            <h1>Olá, <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
            <p class="lead">Encontre o lugar perfeito para sua próxima viagem.</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <a href="BuscarLocs.php" class="action-card d-block">
                        <i class="bi bi-search"></i>
                        <h5>Buscar Locações</h5>
                        <p class="text-muted small">Explore nosso catálogo de propriedades disponíveis.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>