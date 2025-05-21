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
            $sql = "SELECT tipoloc, titulo, imagem, descr, preco, localizacao, qtdhospedes, disp FROM locacoes WHERE idloc =:idloc LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idloc', $idloc);

            $stmt->execute();
            $locAssoc = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($locAssoc) {
                $loc->getTipoloc($locAssoc['tipoloc']);
                $loc->getTitulo($locAssoc['titulo']);
                $loc->getImagem($locAssoc['imagem']);
                $loc->getDescr($locAssoc['descr']);
                $loc->getPreco($locAssoc['preco']);
                $loc->getLocalizacao($locAssoc['localizacao']);
                $loc->getQtdhospedes($locAssoc['qtdhospedes']);
                $loc->getDisp($locAssoc['disp']);

                return $loc;
            }

            return $loc;
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    public function alterarLocs(Classlocs $altloc)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE locacoes SET tipoloc = ?, titulo = ?, imagem = ?, descr = ?,
                    preco = ?, localizacao = ?, qtdhospedes = ?, disp = ?  
                    WHERE idloc=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $altloc->getTipoloc());
            $stmt->bindValue(2, $altloc->getTitulo());
            $stmt->bindValue(3, $altloc->getImagem());
            $stmt->bindValue(4, $altloc->getDescr());
            $stmt->bindValue(5, $altloc->getPreco());
            $stmt->bindValue(6, $altloc->getLocalizacao());
            $stmt->bindValue(7, $altloc->getQtdhospedes());
            $stmt->bindValue(8, $altloc->getDisp());
            $stmt->bindValue(9, $altloc->getIdloc());
            return $stmt->rowCount();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
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
}