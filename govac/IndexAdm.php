<?php

session_start();
if (empty($_SESSION)) {
    print "<script>location.href='IndexAdm.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOVac Adm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: #007bff;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .welcome-header {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-dark">
                <div class="position-sticky pt-3">
                    <h4 class="text-white px-3">Hotel Admin</h4>
                    <hr class="bg-light">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="dashboard-link">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="new-rental-link">
                                <i class="bi bi-plus-circle me-2"></i>Nova Locação
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="edit-rental-link">
                                <i class="bi bi-pencil-square me-2"></i>Alterar Locação
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="search-rental-link">
                                <i class="bi bi-search me-2"></i>Buscar Locação
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="delete-rental-link">
                                <i class="bi bi-trash me-2"></i>Excluir Locação
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel de Administração</h1>
                </div>

                <div class="welcome-header">
                    <h3>Bem-vindo, Administrador!</h3>
                    <p class="lead">Gerencie as locações do hotel utilizando o menu ao lado.</p>
                </div>

                <!-- Conteúdo dinâmico baseado na seleção do menu -->
                <div id="dashboard-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title">Resumo do Dia</h5>
                                </div>
                                <div class="card-body">
                                    <p>Check-ins hoje: <strong>12</strong></p>
                                    <p>Check-outs hoje: <strong>8</strong></p>
                                    <p>Ocupação atual: <strong>85%</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title">Estatísticas</h5>
                                </div>
                                <div class="card-body">
                                    <p>Total de locações ativas: <strong>45</strong></p>
                                    <p>Quartos disponíveis: <strong>15</strong></p>
                                    <p>Receita mensal: <strong>R$ 120.450,00</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="new-rental-content" class="content-section">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Cadastrar nova Locação</h5>
                        </div>
                        <div class="card-body">
                            <form class="cadastro-locacoes" method = "POST" action="./controller/ControleLocs.php?ACAO=cadastrarLocs">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo-loc" class="form-label">Tipo de locação:</label>
                                        <input type="text" name="tipoloc" class="form-control" id="tipo-loc" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="titulo" class="form-label">Titulo:</label>
                                        <input type="text" name="titulo" class="form-control" id="titulo" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="imagem" class="form-label">Link da imagem:</label>
                                        <input type="url" name="imagem" class="form-control" id="imagem" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="preco" class="form-label">Preço por dia:</label>
                                        <input type="float" name="preco" class="form-control" id="preco" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="local" class="form-label">Localização:</label>
                                        <input type="text" name="localizacao" class="form-control" id="localizacao" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="qtdhospedes" class="form-label">Quant. de hóspedes:</label>
                                        <input type="number" name="qtdhospedes" class="form-control" id="qtdhospedes" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="disp" class="form-label">Disponibilidade:</label>
                                        <select class="form-select" name="disp" id="disp" required>
                                            <option value="">Selecione...</option>
                                            <option value="Disponível">Disponível</option>
                                            <option value="Indisponível">Indisponível</option>
                                            <option value="Ocupado">Ocupado</option>
                                        </select>
                                </div>        
                                <div class="mb-3">
                                    <label for="descr" class="form-label">Descrição:</label>
                                    <textarea class="form-control" name="descr" id="descr" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar Locação</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="edit-rental-content" class="content-section" style="display: none;">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title">Alterar Locação</h5>
                        </div>
                        <div class="card-body">
                            <form class="alterar-locacoes" method = "POST" action="./controller/ControleLocs.php?ACAO=buscarLocs">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="search-rental" class="form-label">Buscar Locação (ID)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="idloc" id="idloc" placeholder="Digite o ID">
                                            <button class="btn btn-outline-secondary" type="button">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit-client-name" class="form-label">Tipo da locação:</label>
                                        <input type="text" class="form-control" name="tipoloc" id="edit-client-name" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-room-number" class="form-label">Disponibilidade:</label>
                                        <select class="form-select" id="edit-room-number" disabled>
                                            <option value="">Selecione...</option>
                                            <option value="Disponível">Disponível</option>
                                            <option value="Indisponível">Indisponível</option>
                                            <option value="Ocupado">Ocupado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit-checkin-date" class="form-label">Data de Check-in</label>
                                        <input type="date" class="form-control" id="edit-checkin-date" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-checkout-date" class="form-label">Data de Check-out</label>
                                        <input type="date" class="form-control" id="edit-checkout-date" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-additional-info" class="form-label">Informações Adicionais</label>
                                    <textarea class="form-control" id="edit-additional-info" rows="3" disabled></textarea>
                                </div>
                                <button type="button" class="btn btn-warning" id="edit-button">Editar</button>
                                <button type="submit" class="btn btn-success" id="save-button" style="display: none;">Salvar Alterações</button>
                                <button type="button" class="btn btn-secondary" id="cancel-button" style="display: none;">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="search-rental-content" class="content-section" style="display: none;">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title">Buscar Locação</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="search-criteria" class="form-label">Critério de Busca</label>
                                        <select class="form-select" id="search-criteria">
                                            <option value="id">ID da Locação</option>
                                            <option value="cpf">CPF do Cliente</option>
                                            <option value="name">Nome do Cliente</option>
                                            <option value="room">Número do Quarto</option>
                                            <option value="date">Data de Check-in</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="search-term" class="form-label">Termo de Busca</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="search-term" placeholder="Digite o termo de busca">
                                            <button class="btn btn-outline-primary" type="button">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Quarto</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1001</td>
                                            <td>João Silva</td>
                                            <td>201</td>
                                            <td>15/05/2023</td>
                                            <td>20/05/2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-info">Detalhes</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1002</td>
                                            <td>Maria Souza</td>
                                            <td>102</td>
                                            <td>16/05/2023</td>
                                            <td>22/05/2023</td>
                                            <td>
                                                <button class="btn btn-sm btn-info">Detalhes</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="delete-rental-content" class="content-section" style="display: none;">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title">Excluir Locação</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="delete-rental-id" class="form-label">ID da Locação</label>
                                        <input type="text" class="form-control" id="delete-rental-id" placeholder="Digite o ID da locação">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="button" class="btn btn-outline-danger" id="search-to-delete">Buscar Locação</button>
                                    </div>
                                </div>
                                <div id="rental-to-delete-info" style="display: none;">
                                    <div class="alert alert-warning">
                                        <h6>Informações da Locação</h6>
                                        <p><strong>Cliente:</strong> <span id="delete-client-name"></span></p>
                                        <p><strong>Quarto:</strong> <span id="delete-room-number"></span></p>
                                        <p><strong>Período:</strong> <span id="delete-period"></span></p>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="confirm-delete">
                                        <label class="form-check-label" for="confirm-delete">
                                            Confirmo que desejo excluir esta locação
                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-danger" id="confirm-delete-button" disabled>Excluir Locação</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para alternar entre as seções de conteúdo
        document.addEventListener('DOMContentLoaded', function() {
            // Esconde todas as seções de conteúdo
            function hideAllSections() {
                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.getElementById('dashboard-content').style.display = 'none';
            }
            
            // Remove a classe 'active' de todos os links do menu
            function deactivateAllMenuLinks() {
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
            }
            
            // Configura os eventos de clique nos links do menu
            document.getElementById('dashboard-link').addEventListener('click', function(e) {
                e.preventDefault();
                hideAllSections();
                deactivateAllMenuLinks();
                this.classList.add('active');
                document.getElementById('dashboard-content').style.display = 'block';
            });
            
            document.getElementById('new-rental-link').addEventListener('click', function(e) {
                e.preventDefault();
                hideAllSections();
                deactivateAllMenuLinks();
                this.classList.add('active');
                document.getElementById('new-rental-content').style.display = 'block';
            });
            
            document.getElementById('edit-rental-link').addEventListener('click', function(e) {
                e.preventDefault();
                hideAllSections();
                deactivateAllMenuLinks();
                this.classList.add('active');
                document.getElementById('edit-rental-content').style.display = 'block';
            });
            
            document.getElementById('search-rental-link').addEventListener('click', function(e) {
                e.preventDefault();
                hideAllSections();
                deactivateAllMenuLinks();
                this.classList.add('active');
                document.getElementById('search-rental-content').style.display = 'block';
            });
            
            document.getElementById('delete-rental-link').addEventListener('click', function(e) {
                e.preventDefault();
                hideAllSections();
                deactivateAllMenuLinks();
                this.classList.add('active');
                document.getElementById('delete-rental-content').style.display = 'block';
            });
            
            // Mostra a seção de dashboard por padrão
            //document.getElementById('dashboard-content').style.display = 'block';
            
            // Lógica para o botão de edição
            document.getElementById('edit-button').addEventListener('click', function() {
                document.getElementById('edit-client-name').disabled = false;
                document.getElementById('edit-room-number').disabled = false;
                document.getElementById('edit-checkin-date').disabled = false;
                document.getElementById('edit-checkout-date').disabled = false;
                document.getElementById('edit-additional-info').disabled = false;
                
                document.getElementById('edit-button').style.display = 'none';
                document.getElementById('save-button').style.display = 'inline-block';
                document.getElementById('cancel-button').style.display = 'inline-block';
            });
            
            document.getElementById('cancel-button').addEventListener('click', function() {
                document.getElementById('edit-client-name').disabled = true;
                document.getElementById('edit-room-number').disabled = true;
                document.getElementById('edit-checkin-date').disabled = true;
                document.getElementById('edit-checkout-date').disabled = true;
                document.getElementById('edit-additional-info').disabled = true;
                
                document.getElementById('edit-button').style.display = 'inline-block';
                document.getElementById('save-button').style.display = 'none';
                document.getElementById('cancel-button').style.display = 'none';
            });
            
            // Lógica para a exclusão
            document.getElementById('search-to-delete').addEventListener('click', function() {
                // Simulação de busca - em uma aplicação real, isso viria de uma API
                document.getElementById('delete-client-name').textContent = 'João Silva';
                document.getElementById('delete-room-number').textContent = '201';
                document.getElementById('delete-period').textContent = '15/05/2023 a 20/05/2023';
                document.getElementById('rental-to-delete-info').style.display = 'block';
            });
            
            document.getElementById('confirm-delete').addEventListener('change', function() {
                document.getElementById('confirm-delete-button').disabled = !this.checked;
            });
            
            document.getElementById('confirm-delete-button').addEventListener('click', function() {
                alert('Locação excluída com sucesso!');
                document.getElementById('delete-rental-id').value = '';
                document.getElementById('confirm-delete').checked = false;
                document.getElementById('rental-to-delete-info').style.display = 'none';
                document.getElementById('confirm-delete-button').disabled = true;
            });
        });
    </script>
</body>
</html>