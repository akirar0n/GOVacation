<?php

require_once 'Conexao.php';
class ClassLocsDAO {
    public function cadastrarLocs(ClassLocs $cadastrarLocs) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO locacoes (tipoloc, titulo, imagem, descr, preco, localizacao, qtdhospedes, disp) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarLocs->getTipoloc());
            $stmt->bindValue(2, $cadastrarLocs->getTitulo());
            $stmt->bindValue(3, $cadastrarLocs->getImagem());
            $stmt->bindValue(4, $cadastrarLocs->getDescr());
            $stmt->bindValue(5, $cadastrarLocs->getPreco());
            $stmt->bindValue(6, $cadastrarLocs->getLocalizacao());
            $stmt->bindValue(7, $cadastrarLocs->getQtdhospedes());
            $stmt->bindValue(8, $cadastrarLocs->getDisp());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarLocs($idloc)
{
    try {
        $loc = new ClassLocs();
        $pdo = Conexao::getInstance();
        $sql = "SELECT idloc, tipoloc, titulo, imagem, descr, preco, localizacao, qtdhospedes, disp FROM locacoes WHERE idloc =:idloc LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idloc', $idloc);

        $stmt->execute();
        $locAssoc = $stmt->fetch(PDO::FETCH_ASSOC);

        $loc->setIdloc($locAssoc['idloc']);
        $loc->setTipoloc($locAssoc['tipoloc']);
        $loc->setTitulo($locAssoc['titulo']);
        $loc->setImagem($locAssoc['imagem']);
        $loc->setDescr($locAssoc['descr']);
        $loc->setPreco($locAssoc['preco']);
        $loc->setLocalizacao($locAssoc['localizacao']);
        $loc->setQtdhospedes($locAssoc['qtdhospedes']);
        $loc->setDisp($locAssoc['disp']);

        return $loc;
    } catch (PDOException $exc) {
        return $exc->getMessage();
    }
}

    public function alterarLocs(ClassLocs $loc)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE locacoes SET tipoloc = ?, titulo = ?, imagem = ?, descr = ?,
                    preco = ?, localizacao = ?, qtdhospedes = ?, disp = ?  
                    WHERE idloc=? ";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(1, $loc->getTipoloc(), PDO::PARAM_STR);
            $stmt->bindValue(2, $loc->getTitulo(), PDO::PARAM_STR);
            $stmt->bindValue(3, $loc->getImagem(), PDO::PARAM_STR);
            $stmt->bindValue(4, $loc->getDescr(), PDO::PARAM_STR);
            $stmt->bindValue(5, $loc->getPreco(), PDO::PARAM_STR);
            $stmt->bindValue(6, $loc->getLocalizacao(), PDO::PARAM_STR);
            $stmt->bindValue(7, $loc->getQtdhospedes(), PDO::PARAM_STR);
            $stmt->bindValue(8, $loc->getDisp(), PDO::PARAM_STR);
            $stmt->bindValue(9, $loc->getIdloc(), PDO::PARAM_INT);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $exc) {
        echo "<div class='alert alert-danger'>Erro ao atualizar o equipamento: " . $exc->getMessage() . "</div>";
        return false;
    }
}


    public function listarLocs()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM locacoes order by (idloc) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $idloc = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $idloc;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirLocs($idloc)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM locacoes WHERE idloc =:idloc";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idloc', $idloc);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function atualizarDisponibilidade($idloc, $status)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE locacoes SET disp = ? WHERE idloc = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $status, PDO::PARAM_STR);
            $stmt->bindValue(2, $idloc, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $exc) {
            error_log("Erro ao atualizar disponibilidade: " . $exc->getMessage());
            return false;
        }
    }
}