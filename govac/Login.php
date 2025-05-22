<?php
/* session_start();

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'govacation';
$username = 'root';
$password = '';

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Busca o usuário no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['tipousuario'] = $usuario['tipousuario'];

            // Redirecionamentos
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
</head>

<body>
    <h1>Entrar</h1>
    
    <!-- Exibição de mensagens de erro -->
    <?php if (isset($_GET['error'])): ?>
        <div style="color: red; margin: 10px 0;">
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
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div>
            <label for="inputEmail">Email</label><br>
            <input type="email" name="email" id="inputEmail" required>
        </div>
        <div>
            <label for="inputSenha">Senha</label><br>
            <input type="password" name="senha" id="inputSenha" required>
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>
</body>
</html> */

session_start();

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'govacation';
$username = 'root';
$password = '';

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Busca o usuário no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['tipousuario'] = $usuario['tipousuario'];

            // Redirecionamentos
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos customizados -->
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
                <h1>GoVacation</h1>
                <p class="text-muted">Faça login para continuar</p>
            </div>
            
            <!-- Exibição de mensagens de erro -->
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
                    <a href="#" class="text-decoration-none">Esqueceu a senha?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>