<?php
require '../model/ClassUser.php';
require '../model/DAO/ClassUserDAO.php';

$acao = $_GET['ACAO'] ?? $_POST['ACAO'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;
$email = $_POST['email'] ?? null;
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT) ?? null;
$nome = $_POST['nome'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$endereco = $_POST['endereco'] ?? null;
$telefone = $_POST['telefone'] ?? null;

$novoUsuario = new ClassUser();
$novoUsuario->setIdusuario($idusuario);
$novoUsuario->setEmail($email);
$novoUsuario->setSenha($senha);
$novoUsuario->setNome($nome);
$novoUsuario->setCpf($cpf);
$novoUsuario->setEndereco($endereco);
$novoUsuario->setTelefone($telefone);

$ClassUserDAO = new ClassUserDAO();

switch ($acao) {
    case 'cadastrarUser':
        $usuario = $ClassUserDAO->cadastrarUser($novoUsuario);
        if ($usuario >= 1) {
            header('Location:../index.php?&MSG=Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    case 'cadastrarAdm':
        $usuario = $ClassUserDAO->cadastrarAdm($novoUsuario);
        if ($usuario >= 1) {
            header('Location:../index.php?&MSG=Administrador cadastrado com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    case 'alterarUser':
        session_start();
        $resultado = $ClassUserDAO->alterarUser($novoUsuario);
        $redirectPage = ($_SESSION['tipousuario'] == 1) ? 'IndexAdm.php' : 'IndexCliente.php';
        
        if ($resultado) {
            header("Location:../$redirectPage?msg=success");
        } else {
            header("Location:../$redirectPage?msg=error");
        }
        break;

    case 'excluirUser':
        if (isset($_GET['idusuario'])) {
            $idusuario = $_GET['idusuario'];
            $ClassUserDAO = new ClassUserDAO();
            $usuario = $ClassUserDAO->excluirUser($idusuario);
            if ($usuario == TRUE) {
                header('Location:../ListarUser.php?&MSG= Cliente excluido com sucesso!');
            } else {
                header('Location:../ListarUser.php?&MSG=Não foi possivel realizar a exclusão do cliente!');
            }
        }
        break;
}