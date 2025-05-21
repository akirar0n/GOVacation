<?php
require '../model/ClassLocs.php';
require '../model/DAO/ClassLocsDAO.php';

$tipoloc = $_POST['tipoloc'] ?? null;
$titulo = $_POST['titulo'] ?? null;
$imagem = $_POST['imagem'] ?? null;
$descr = $_POST['descr'] ?? null;
$preco = $_POST['preco'] ?? null;
$localizacao = $_POST['localizacao'] ?? null;
$qtdhospedes = $_POST['qtdhospedes'] ?? null;
$disp = $_POST['disp'] ?? null;
$acao = $_GET['ACAO'] ?? null;

$novoLoc = new ClassLocs();
$novoLoc->setTipoloc($tipoloc);
$novoLoc->setTitulo($titulo);
$novoLoc->setImagem($imagem);
$novoLoc->setDescr($descr);
$novoLoc->setPreco($preco);
$novoLoc->setLocalizacao($localizacao);
$novoLoc->setQtdhospedes($qtdhospedes);
$novoLoc->setDisp($disp);

$classLocsDAO = new ClassLocsDAO();

switch ($acao) {
    case 'cadastrarLocs':
        $loc = $classLocsDAO->cadastrarLocs($novoLoc);
        if ($loc >= 1) {
            header("Location:../IndexAdm.php?&MSG=Cadastro de locação realizado com sucesso!");
        } else {
            header('Location:../IndexAdm?&MSG=Não foi possível realizar o cadastro da locação!');
        }
        break;

    case 'alterarLocs':
        $loc = $classLocsDAO->alterarLocs($loc);
        if ($loc == 1) {
            header('Location:../IndexAdm.php?&MSG= Cliente atualizado com sucesso!');
        } else {
            header('Location:../IndexAdm.php?&MSG= Não foi possível atualizar os dados do cliente!');
        }
        break;

    case 'excluirLocs':
        if (isset($_GET['idloc'])) {
            $idloc = $_GET['idloc'];
            $classLocsDAO = new ClassLocsDAO();
            $loc = $classLocsDAO->excluirLocs($idloc);
            if ($loc == TRUE) {
                header('Location:../IndexAdm.php?&MSG= Cliente excluido com sucesso!');
            } else {
                header('Location:../IndexAdm.php?&MSG=Não foi possivel realizar a exclusão do cliente!');
            }
        }
        break; 
}
