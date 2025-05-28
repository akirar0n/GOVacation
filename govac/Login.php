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
    die("Erro ao conectar: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['tipousuario'] = $usuario['tipousuario'];

            if ($usuario['tipousuario'] == 1) {
                header("Location: IndexAdm.php");
                exit;
            } elseif ($usuario['tipousuario'] == 2) {
                header("Location: IndexCliente.php");
                exit;
            } else {
                header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?error=3");
                exit;
            }
        } else {
            header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?error=2");
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
    <title>Login - GoVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo h1 {
            color: #0d6efd;
            font-weight: bold;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="login-logo">
                <h1>GOVacation</h1>
                <p class="text-muted">Faça login para continuar</p>
            </div>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    switch ($_GET['error']) {
                        case 1:
                            echo "Email não encontrado.";
                            break;
                        case 2:
                            echo "Senha incorreta.";
                            break;
                        case 3:
                            echo "Cadastro não autorizado.";
                            break;
                        default:
                            echo "Erro desconhecido.";
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" required>
                </div>
                <div class="mb-3">
                    <label for="inputSenha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="inputSenha" required>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-login">Entrar</button>
                </div>
                <div class="text-center">
                    <a href="index.php" class="text-decoration-none">Voltar</a>
                </div>
                <hr>
                <div class="text-center">
                    <a href="" class="text-decoration-none">Esqueceu a senha?</a>
                </div>
                
            </form>
        </div>
    </div>

                <!-- RODAPÉ-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">GOVac</h5>
                    <p>Plataforma completa para gerenciamento de propriedades para locação.</p>
                    <div class="social-icons">
                        <a href="https://github.com/akirar0n"><i class="bi bi-github"></i></a>
                        <a href="https://www.linkedin.com/in/roneyvilanovadossantos/"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="footer-title">Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="IndexAdm.php"><i class="bi bi-house-door"></i> Início</a></li>
                        <li><a href="#"><i class="bi bi-building"></i> Propriedades</a></li>
                        <li><a href="#"><i class="bi bi-people"></i> Clientes</a></li>
                        <li><a href="#"><i class="bi bi-file-earmark-text"></i> Relatórios</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="footer-title">Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt"></i> Rua Exemplo, 123 - Cidade/UF</li>
                        <li><i class="bi bi-telephone"></i> (00) 1234-5678</li>
                        <li><i class="bi bi-envelope"></i> contato@sistemalocacoes.com</li>
                    </ul>
                </div>
                
            </div>
            
            <div class="copyright">
                <div class="container">
                    <p class="mb-0">&copy; 2025 GOVac. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>