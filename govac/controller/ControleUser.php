<?php
require '../model/ClassUser.php';
require '../model/DAO/ClassUserDAO.php';

$email = $_POST['email'] ?? null;
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT) ?? null;
$nome = $_POST['nome'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$endereco = $_POST['endereco'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$acao = $_GET['ACAO'] ?? null;

$novoUsuario = new ClassUser();
$novoUsuario->setEmail($email);
$novoUsuario->setSenha($senha);
$novoUsuario->setNome($nome);
$novoUsuario->setCpf($cpf);
$novoUsuario->setEndereco($endereco);
$novoUsuario->setTelefone($telefone);

$classUserDAO = new ClassUserDAO();

switch ($acao) {
    case 'cadastrarUser':
        $usuario = $classUserDAO->cadastrarUser($novoUsuario);
        if ($usuario >= 1) {
            header('Location:../index.php?&MSG=Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    case 'cadastrarAdm':
        $usuario = $classUserDAO->cadastrarAdm($novoUsuario);
        if ($usuario >= 1) {
            header('Location:../index.php?&MSG=Administrador cadastrado com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    case 'alterarUser':
        $usuario = $classUserDAO->alterarUser($usuario);
        if ($usuario == 1) {
            header('Location:../ListarUser.php?&MSG= Cliente atualizado com sucesso!');
        } else {
            header('Location:../ListarUser.php?&MSG= Não foi possível atualizar os dados do cliente!');
        }
        break;

    case 'excluirUser':
        if (isset($_GET['idusuario'])) {
            $idusuario = $_GET['idusuario'];
            $classUserDAO = new ClassUserDAO();
            $usuario = $classUserDAO->excluirUser($idusuario);
            if ($usuario == TRUE) {
                header('Location:../ListarUser.php?&MSG= Cliente excluido com sucesso!');
            } else {
                header('Location:../ListarUser.php?&MSG=Não foi possivel realizar a exclusão do cliente!');
            }
        }
        break;
}