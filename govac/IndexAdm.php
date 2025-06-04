<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['email']) && $_SESSION['tipousuario'] == 1) {
    header('Location: IndexAdm.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOVac Adm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .navbar {
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-link {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
        }
        .nav-link i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GOVacation Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="CadLocs.php" id="new-rental-link">
                            <i class="bi bi-plus-circle"></i> Nova Locação
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ListarLocs.php" id="edit-rental-link">
                            <i class="bi bi-pencil-square"></i> Manter locação
                        </a>
                    </li>
                    <li class="nav-item ms-lg-auto">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-left"></i> Log-out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <!-- Conteúdo principal do site vai aqui -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>