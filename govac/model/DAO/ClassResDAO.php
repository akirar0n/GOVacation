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
            // Para depuração, você pode logar o erro em vez de apenas mostrá-lo.
            error_log($exc->getMessage());
            return FALSE;
        }
    }

    /**
     * NOVA FUNÇÃO: Verifica se uma reserva já foi criada para um usuário e uma locação.
     * Isso previne a criação de registros duplicados a partir de webhooks.
     * @param int $idusuario
     * @param int $idloc
     * @return bool
     */
    public function reservaExiste($idusuario, $idloc) {
        try {
            $pdo = Conexao::getInstance();
            // A lógica aqui pode ser mais complexa, talvez verificando um período de datas.
            // Por simplicidade, vamos apenas verificar se existe qualquer reserva para esta combinação.
            $sql = "SELECT COUNT(*) FROM reservas WHERE idusuario = ? AND idloc = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idusuario);
            $stmt->bindValue(2, $idloc);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $exc) {
            error_log($exc->getMessage());
            return false; // Em caso de erro, é mais seguro assumir que não existe.
        }
    }
}

