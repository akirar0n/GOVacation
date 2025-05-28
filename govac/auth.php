<?php
function verificarAdmin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Verifica se já está na página de login
    if (basename($_SERVER['PHP_SELF']) === 'IndexAdm.php') {
        return;
    }
    
    // Verifica autenticação usando email e tipo de usuário
    if (empty($_SESSION['email']) || empty($_SESSION['tipousuario']) || $_SESSION['tipousuario'] != 1) {
        $_SESSION['mensagem'] = "Acesso restrito a administradores";
        header('Location: IndexAdm.php');
        exit();
    }
}