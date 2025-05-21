<?php
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
</html>