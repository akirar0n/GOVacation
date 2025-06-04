<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - GoVacation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-header {
            color: #0d6efd;
            font-weight: bold;
        }
        .subtext-header {
            color: #6c757d;
        }
        .btn-cadastro {
            width: 100%;
            padding: 10px;
            font-weight: bold;
            margin-top: 15px;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-form">
            <div class="card-header">
                <h1 class="text-header">Cadastre-se</h1>
                <p class="subtext-header">Torne-se um cliente GoVacation!</p>
            </div>
            <hr>
            
            <form id="formCadastro" class="needs-validation" novalidate method="POST" action="./controller/ControleUser.php?ACAO=cadastrarUser">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" required>
                    <div class="invalid-feedback">Por favor, insira um email válido.</div>
                </div>
                
                <div class="mb-3">
                    <label for="inputSenha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="inputSenha" minlength="6" required>
                    <div class="invalid-feedback">A senha deve ter pelo menos 6 caracteres.</div>
                </div>
                
                <div class="mb-3">
                    <label for="inputNome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" name="nome" id="inputNome" required>
                    <div class="invalid-feedback">Por favor, insira seu nome completo.</div>
                </div>
                
                <div class="mb-3">
                    <label for="inputCpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="inputCpf" required>
                    <div class="invalid-feedback">Por favor, insira um CPF válido.</div>
                </div>
                
                <div class="mb-3">
                    <label for="inputEndereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" name="endereco" id="inputEndereco" required>
                    <div class="invalid-feedback">Por favor, insira seu endereço.</div>
                </div>
                
                <div class="mb-3">
                    <label for="inputTelefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" name="telefone" id="inputTelefone" required>
                    <div class="invalid-feedback">Por favor, insira um telefone válido.</div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-cadastro">Cadastrar-se</button>
                </div>
                <hr>
                <div class="text-center">
                    <a href="index.php" class="text-decoration-none">Voltar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#inputCpf').mask('000.000.000-00', {reverse: true});
            $('#inputTelefone').mask('(00) 00000-0000');
        });

        (function() {
            'use strict';
            
            var form = document.getElementById('formCadastro');
            
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                var cpf = document.getElementById('inputCpf').value.replace(/\D/g, '');
                if (!validarCPF(cpf)) {
                    document.getElementById('inputCpf').classList.add('is-invalid');
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
            
            form.querySelectorAll('.form-control').forEach(function(input) {
                input.addEventListener('input', function() {
                    if (input.id === 'inputCpf') {
                        var cpf = input.value.replace(/\D/g, '');
                        if (validarCPF(cpf)) {
                            input.classList.remove('is-invalid');
                        } else {
                            input.classList.add('is-invalid');
                        }
                    } else {
                        if (input.checkValidity()) {
                            input.classList.remove('is-invalid');
                        } else {
                            input.classList.add('is-invalid');
                        }
                    }
                });
            });
            
            function validarCPF(cpf) {
                cpf = cpf.replace(/\D/g, '');
                if (cpf.length !== 11) return false;
                
                if (/^(\d)\1+$/.test(cpf)) return false;
                
                let soma = 0;
                let resto;
                
                for (let i = 1; i <= 9; i++) 
                    soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
                resto = (soma * 10) % 11;
                
                if ((resto === 10) || (resto === 11)) resto = 0;
                if (resto !== parseInt(cpf.substring(9, 10))) return false;
                
                soma = 0;
                for (let i = 1; i <= 10; i++) 
                    soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
                resto = (soma * 10) % 11;
                
                if ((resto === 10) || (resto === 11)) resto = 0;
                if (resto !== parseInt(cpf.substring(10, 11))) return false;
                
                return true;
            }
        })();
    </script>
</body>
</html> 