<?php
require '../model/ClassUser.php';
require '../model/DAO/ClassUserDAO.php';

$senha = $_POST['senha'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$nome = $_POST['nome'] ?? null;
$endereco = $_POST['endereco'] ?? null;
$email = $_POST['email'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$acao = $_GET['ACAO'] ?? null;

$usuario = new ClassUser();
$usuario->setSenha($senha);
$usuario->setCpf($cpf);
$usuario->setNome($nome);
$usuario->setEndereco($endereco);
$usuario->setEmail($email);
$usuario->setTelefone($telefone);

$classUserDAO = new ClassUserDAO();

switch ($acao) {
    case "cadastrarUser":
        $usuario = $classUserDAO->cadastrarUser($usuario);
        if ($usuario >= 1) {
            header('Location:../index.php?&MSG=Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    default:
        header('Location:../index.php?&MSG=Ação inválida!');
        break;

    case 'alterarUser':
        $usuario = $classUserDAO->alterarUser($usuario);
        if ($usuario == 1) {
            header('Location:../ListarUser.php?&MSG= Cliente atualizado com sucesso!');
        } else {
            header('Location:../ListarUser.php?&MSG= Não foi possível atualizar os dados do cliente!');
        }
        break;

    case "excluirUser":
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