<?php
/* session_start();

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
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if ($senha === $usuario['senha']) {
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['tipousuario'] = $usuario['tipousuario'];

            if ($usuario['tipousuario'] == 1) {
                header("Location: Fodase.php");
            } elseif ($usuario['tipousuario'] == 2) {
                header("Location: Fodase2.php");
            } else {
                header("Location: " . $_SERVER['PHP_SELF'] . "?Cadastro não autorizado");
            }
            exit;
        } else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?Senha incorreta");
            exit;
        }
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?Usuário não encontrado");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../view/CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php //require 'MenuOff.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-form"> Entrar </h1>
                <form method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                    <div class="formulario-login">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email" id="inputEmail" required>
                        <br>
                        <label for="inputSenha">Senha</label>
                        <input type="password" name="senha" id="inputSenha" required>
                        <br>
                        <button type="submit" class="btn-entrar-um"> Entrar </button>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger mt-3">
            <?php
            if ($_GET['error'] == 1) {
                echo "Email não encontrado.";
            } elseif ($_GET['error'] == 2) {
                echo "Senha incorreta.";
            }
            ?>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
        // Verifica a senha - versão segura com password_verify
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['tipousuario'] = $usuario['tipousuario'];

            // Redirecionamentos
            if ($usuario['tipousuario'] == 1) {
                header("Location: Fodase.php");
                exit;
            } elseif ($usuario['tipousuario'] == 2) {
                header("Location: Fodase2.php");
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
    <link rel="stylesheet" href="../view/CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Entrar</h1>
<p>aaaaaaaaaaaa </p>
                        <!-- Exibição de mensagens de erro -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger">
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
                            <div class="mb-3">
                                
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="inputEmail" required>
                            </div>
                            <div class="mb-3">
                                
                                <label for="inputSenha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="inputSenha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>