<?php

if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['idusuario'])) { header('Location: Login.php'); exit(); }

if ($_SESSION['tipousuario'] == 1) {
    include 'IndexAdm.php';
} else {
    include 'IndexCliente.php';
}

require './model/DAO/ClassUserDAO.php';
$userDAO = new ClassUserDAO();
$usuario = $userDAO->buscarUser($_SESSION['idusuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Dados - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f5f7fa; }
        .form-container { max-width: 700px; margin: 2rem auto; padding: 2.5rem; background: white; border-radius: 12px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); }
        .form-title { color: #3498db; text-align: center; margin-bottom: 2rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Meus Dados Pessoais</h1>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger">Os campos de Email, Telefone e Endereço não podem estar vazios.</div>
            <?php endif; ?>

            <form id="alterarDadosForm" class="needs-validation" novalidate method="POST" action="./controller/ControleUser.php">
                <input type="hidden" name="ACAO" value="alterarUser">
                <input type="hidden" name="idusuario" value="<?php echo htmlspecialchars($usuario['idusuario']); ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['nome']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CPF</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" disabled readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                    <div class="invalid-feedback">Por favor, insira um email válido.</div>
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required>
                    <div class="invalid-feedback">O endereço é obrigatório.</div>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" required>
                    <div class="invalid-feedback">O telefone é obrigatório.</div>
                </div>
                
                <hr class="my-4">
                
                <div class="mb-3">
                    <label for="senha" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" minlength="6">
                    <div class="form-text">Deixe em branco para não alterar. A senha deve ter no mínimo 6 caracteres.</div>
                    <div class="invalid-feedback">A nova senha deve ter no mínimo 6 caracteres.</div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>