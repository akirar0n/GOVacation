<?php

require_once 'Conexao.php';
class ClassUserDAO {
    public function cadastrarUser(ClassUser $cadastrarUser) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (tipousuario, email, senha, nome, cpf, endereco, telefone)
                    values (2,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarUser->getEmail());
            $stmt->bindValue(2, $cadastrarUser->getSenha());
            $stmt->bindValue(3, $cadastrarUser->getNome());
            $stmt->bindValue(4, $cadastrarUser->getCpf());
            $stmt->bindValue(5, $cadastrarUser->getEndereco());
            $stmt->bindValue(6, $cadastrarUser->getTelefone());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarAdm(ClassUser $cadastrarAdm) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (tipousuario, email, senha, nome, cpf, endereco, telefone)
                    values (1,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarAdm->getEmail());
            $stmt->bindValue(2, $cadastrarAdm->getSenha());
            $stmt->bindValue(3, $cadastrarAdm->getNome());
            $stmt->bindValue(4, $cadastrarAdm->getCpf());
            $stmt->bindValue(5, $cadastrarAdm->getEndereco());
            $stmt->bindValue(6, $cadastrarAdm->getTelefone());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarUser($idusuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idusuario, email, nome, cpf, endereco, telefone FROM usuario WHERE idusuario = ? LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idusuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            error_log($exc->getMessage());
            return null;
        }
    }

    public function alterarUser(ClassUser $altUser)
    {
        try {
            $pdo = Conexao::getInstance();
            
            if (!empty($altUser->getSenha())) {
                $sql = "UPDATE usuario SET email = ?, senha = ?, endereco = ?, telefone = ? WHERE idusuario = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $altUser->getEmail());
                $stmt->bindValue(2, password_hash($altUser->getSenha(), PASSWORD_DEFAULT)); // Hash da nova senha
                $stmt->bindValue(3, $altUser->getEndereco());
                $stmt->bindValue(4, $altUser->getTelefone());
                $stmt->bindValue(5, $altUser->getIdusuario(), PDO::PARAM_INT);
            } else {
                $sql = "UPDATE usuario SET email = ?, endereco = ?, telefone = ? WHERE idusuario = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $altUser->getEmail());
                $stmt->bindValue(2, $altUser->getEndereco());
                $stmt->bindValue(3, $altUser->getTelefone());
                $stmt->bindValue(4, $altUser->getIdusuario(), PDO::PARAM_INT);
            }
            
            $stmt->execute();
            return $stmt->rowCount() > 0;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function listarUser()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM usuario order by (idusuario) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $idusuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $idusuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirUser($idusuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM usuario WHERE idusuario =:idusuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}