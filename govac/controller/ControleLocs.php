<?php
require '../model/ClassLocs.php';
require '../model/DAO/ClassLocsDAO.php';

$idloc_from_post = $_POST['idloc'] ?? null; 
$titulo = $_POST['titulo'] ?? null;
$imagem = $_POST['imagem'] ?? null;
$descr = $_POST['descr'] ?? null;
$preco = $_POST['preco'] ?? null;
$localizacao = $_POST['localizacao'] ?? null;
$qtdhospedes = $_POST['qtdhospedes'] ?? null;
$disp = $_POST['disp'] ?? null;
$acao = $_GET['ACAO'] ?? null;

$loc = new ClassLocs();

if ($acao == 'alterarLocs' && $idloc_from_post !== null) { 
}

$loc->setTipoloc($tipoloc);
$loc->setTitulo($titulo);
$loc->setImagem($imagem);
$loc->setDescr($descr);
$loc->setPreco($preco);
$loc->setLocalizacao($localizacao);
$loc->setQtdhospedes($qtdhospedes);
$loc->setDisp($disp);

$ClassLocsDAO = new ClassLocsDAO();

switch ($acao) {
    case 'cadastrarLocs':
        $resultado = $ClassLocsDAO->cadastrarLocs($loc);
        if ($resultado >= 1) {
            header("Location:../CadLocs.php?&MSG=Cadastro de locação realizado com sucesso!");
        } else {
            header('Location:../CadLocs.php?&MSG=Não foi possível realizar o cadastro da locação!');
        }
        break;

    case 'alterarLocs':
        $resultado = $ClassLocsDAO->alterarLocs($loc);
        if ($resultado == 1) {
            header('Location:../ListarLocs.php?&MSG= Locação atualizada com sucesso!');
        } else {
            header('Location:../ListarLocs.php?&MSG= Não foi possível atualizar a locação!');
        }
        break;

    case 'excluirLocs':
        if (isset($_GET['idloc'])) {
            $idloc = $_GET['idloc'];
            $classLocsDAO = new ClassLocsDAO();
            $resultado = $classLocsDAO->excluirLocs($idloc);
            if ($resultado == TRUE) {
                header('Location:../ListarLocs.php?&MSG= Locação excluida com sucesso!');
            } else {
                header('Location:../ListarLocs.php?&MSG=Não foi possivel realizar a exclusão da locação!');
            }
        }
        break; 
}
