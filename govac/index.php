<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .auth-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .auth-logo {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #0d6efd;
        }

        .auth-title {
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .auth-btn {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="auth-container">
        <div class="auth-logo">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h2 class="auth-title">Bem-vindo ao Nosso Sistema</h2>

        <a href="Cadastro.php" class="btn btn-primary auth-btn">
            <i class="bi bi-person-plus"></i> Cadastrar-se
        </a>

        <div class="divider">ou</div>

        <a href="Login.php" class="btn btn-outline-primary auth-btn">
            <i class="bi bi-box-arrow-in-right"></i> Já tenho cadastro
        </a>

        <p class="mt-3 text-muted">
            © 2025 GOVac - Todos os direitos reservados
        </p>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>