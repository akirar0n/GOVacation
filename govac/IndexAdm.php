<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['idusuario']) || $_SESSION['tipousuario'] != 1) {
    header('Location: Login.php?error=4'); 
    exit();
}

$nomeUsuario = $_SESSION['nome'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador - GOVacation</title>
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
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #343a40;
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-color: #0d6efd;
        }
        .action-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="IndexAdm.php">GOVacation Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="CadLocs.php"><i class="bi bi-house-add"></i> Nova Locação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ListarLocs.php"><i class="bi bi-list-ul"></i> Manter Locações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AlterarUser.php"><i class="bi bi-person-circle"></i> Meus Dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="welcome-panel text-center">
            <h1>Bem-vindo, <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
            <p class="lead">Gerencie as locações e reservas de forma simples e eficiente.</p>
            <div class="row justify-content-center g-4">
                <div class="col-md-5">
                    <a href="CadLocs.php" class="action-card d-block">
                        <i class="bi bi-house-add"></i>
                        <h5>Cadastrar Nova Locação</h5>
                        <p class="text-muted small">Adicione uma nova propriedade ao seu portfólio.</p>
                    </a>
                </div>
                <div class="col-md-5">
                    <a href="ListarLocs.php" class="action-card d-block">
                        <i class="bi bi-pencil-square"></i>
                        <h5>Manter Locações</h5>
                        <p class="text-muted small">Edite ou remova propriedades existentes.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>