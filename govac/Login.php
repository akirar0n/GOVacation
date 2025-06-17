<?php
session_start();

$host = 'localhost';
$dbname = 'govacation';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipousuario'] = $usuario['tipousuario'];

        if ($usuario['tipousuario'] == 1) {
            header("Location: IndexAdm.php");
            exit;
        } elseif ($usuario['tipousuario'] == 2) {
            header("Location: IndexCliente.php");
            exit;
        }
    } else {
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?error=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .auth-logo {
            font-size: 2.8rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .auth-title {
            margin-bottom: 0.5rem;
            font-weight: 700;
            color: #343a40;
        }
        .auth-subtitle {
            margin-bottom: 2rem;
            color: #6c757d;
        }
        .btn-submit {
            padding: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-logo">
            <i class="bi bi-building"></i>
        </div>
        <h1 class="auth-title">GOVacation</h1>
        <p class="auth-subtitle">Faça login para gerenciar suas locações</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email ou senha incorretos. Tente novamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="seu@email.com" required>
                <label for="inputEmail">Email</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="senha" id="inputSenha" placeholder="Sua senha" required>
                <label for="inputSenha">Senha</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-submit">Entrar</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="text-muted">Não tem uma conta? <a href="Cadastro.php">Cadastre-se</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>