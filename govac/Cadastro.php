<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 2rem 0;
        }
        .auth-container {
            width: 100%;
            max-width: 600px;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .auth-logo {
            font-size: 2.8rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .auth-title {
            margin-bottom: 0.5rem;
            font-weight: 700;
            color: #343a40;
        }
        .auth-subtitle {
            margin-bottom: 2rem;
            color: #6c757d;
        }
        .btn-submit {
            padding: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-logo">
            <i class="bi bi-person-plus"></i>
        </div>
        <h1 class="auth-title">Crie sua Conta</h1>
        <p class="auth-subtitle">É rápido e fácil. Comece a planejar suas férias!</p>

        <form id="formCadastro" class="needs-validation text-start" novalidate method="POST" action="./controller/ControleUser.php?ACAO=cadastrarUser">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="inputNome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" name="nome" id="inputNome" required>
                    <div class="invalid-feedback">Por favor, insira seu nome.</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail" required>
                <div class="invalid-feedback">Por favor, insira um email válido.</div>
            </div>
            <div class="mb-3">
                <label for="inputSenha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="inputSenha" minlength="6" required>
                <div class="invalid-feedback">A senha precisa ter no mínimo 6 caracteres.</div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="inputCpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="inputCpf" required>
                    <div class="invalid-feedback">CPF inválido.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputTelefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" name="telefone" id="inputTelefone" required>
                    <div class="invalid-feedback">Por favor, insira um telefone.</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputEndereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="inputEndereco" required>
                <div class="invalid-feedback">Por favor, insira seu endereço.</div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-submit">Cadastrar</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="text-muted">Já tem uma conta? <a href="Login.php">Faça login</a></p>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#inputCpf').mask('000.000.000-00', {reverse: true});
            $('#inputTelefone').mask('(00) 00000-0000');
        });

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>