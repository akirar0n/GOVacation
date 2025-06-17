<?php

require_once 'Conexao.php';
class ClassResDAO {
    public function efetuarReserva(ClassRes $reserva) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO reservas (idusuario, idloc, metodopag, datacheckin, datacheckout) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $reserva->getIdusuario());
            $stmt->bindValue(2, $reserva->getIdloc());
            $stmt->bindValue(3, $reserva->getMetodopag());
            $stmt->bindValue(4, $reserva->getDatacheckin());
            $stmt->bindValue(5, $reserva->getDatacheckout());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            error_log($exc->getMessage());
            return FALSE;
        }
    }

    public function reservaExiste($idusuario, $idloc) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT COUNT(*) FROM reservas WHERE idusuario = ? AND idloc = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idusuario);
            $stmt->bindValue(2, $idloc);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $exc) {
            error_log($exc->getMessage());
            return false;
        }
    }

    public function listarHistorico($idusuario) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT 
                        r.idreserva, 
                        r.datacheckin, 
                        r.datacheckout, 
                        r.metodopag,
                        l.titulo, 
                        l.imagem, 
                        l.localizacao
                    FROM 
                        reservas AS r
                    JOIN 
                        locacoes AS l ON r.idloc = l.idloc
                    WHERE 
                        r.idusuario = ?
                    ORDER BY 
                        r.datacheckin DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idusuario, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            error_log($exc->getMessage());
            return []; 
        }
    }
}