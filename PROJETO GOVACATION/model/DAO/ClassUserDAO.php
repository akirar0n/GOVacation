<?php

require_once 'Conexao.php';
class ClassUserDAO {
    public function cadastrarUser(ClassUser $cadastrarUser) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (tipousuario, senha, cpf, nome, endereco, email, telefone)
                    values (2,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarUser->getTipousuario());
            $stmt->bindValue(2, $cadastrarUser->getSenha());
            $stmt->bindValue(3, $cadastrarUser->getCpf());
            $stmt->bindValue(4, $cadastrarUser->getNome());
            $stmt->bindValue(5, $cadastrarUser->getEndereco());
            $stmt->bindValue(6, $cadastrarUser->getEmail());
            $stmt->bindValue(7, $cadastrarUser->getTelefone());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarUser($idusuario)
    {
        try {
            $usuario = new ClassUser();
            $pdo = Conexao::getInstance();
            $sql = "SELECT tipousuario, senha, cpf, nome, endereco, email, telefone FROM usuario WHERE idusuario =:idusuario LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idusuario', $idusuario);

            $stmt->execute();
            $userAssoc = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userAssoc) {
                $usuario->getTipousuario($userAssoc['tipousuario']);
                $usuario->getSenha($userAssoc['senha']);
                $usuario->getCpf($userAssoc['cpf']);
                $usuario->getNome($userAssoc['nome']);
                $usuario->getEndereco($userAssoc['endereco']);
                $usuario->getEmail($userAssoc['email']);
                $usuario->getTelefone($userAssoc['telefone']);

                return $usuario;
            }

            return $usuario;
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    public function alterarUser(ClassUser $altUser)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE usuario SET senha = ?, cpf = ?, nome = ?, endereco = ?, email = ?, telefone = ? WHERE idusuario=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $altUser->getSenha());
            $stmt->bindValue(2, $altUser->getCpf());
            $stmt->bindValue(3,$altUser->getNome());
            $stmt->bindValue(4, $altUser->getEndereco());
            $stmt->bindValue(5, $altUser->getEmail());
            $stmt->bindValue(6, $altUser->getTelefone());
            return $stmt->rowCount();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
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