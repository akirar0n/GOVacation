<?php

require_once 'Conexao.php';
class ClassResDAO {
    public function efetuarReserva(ClassRes $efetuarReserva) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO reservas (idusuario, idloc, metodopag, datacheckin, datacheckout) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $efetuarReserva->getIdusuario());
            $stmt->bindValue(2, $efetuarReserva->getIdloc());
            $stmt->bindValue(3, $efetuarReserva->getMetodopag());
            $stmt->bindValue(4, $efetuarReserva->getDatacheckin());
            $stmt->bindValue(5, $efetuarReserva->getDatacheckout());

            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}