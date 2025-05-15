<?php
require '../model/ClassUser.php';
require '../model/DAO/ClassUserDAO.php';

$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;
$nome = $_POST['nome'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$endereco = $_POST['endereco'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$acao = $_GET['ACAO'] ?? null;

$usuario = new ClassUser();
$usuario->setEmail($email);
$usuario->setSenha($senha);
$usuario->setNome($nome);
$usuario->setCpf($cpf);
$usuario->setEndereco($endereco);
$usuario->setTelefone($telefone);

$classUserDAO = new ClassUserDAO();

switch ($acao) {
    case 'cadastrarUser':
        $usuario = $classUserDAO->cadastrarUser($usuario);
        if ($usuario >= 1) {
            header('Location:govac/index.php?&MSG=Cadastro realizado com sucesso!');
        } else {
            header('Location:../Cadastro.php?&MSG=Não foi possível realizar o cadastro!');
        }
        break;

    default:
        //header('Location:../index.php?&MSG=Ação inválida!');
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