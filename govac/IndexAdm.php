<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

<<<<<<< Updated upstream
if (!empty($_SESSION['usuario']) && $_SESSION['tipousuario'] == 1) {
    header('Location: IndexAdm.php');
    exit();
}
=======
session_start();
if (empty($_SESSION)) {
    print "<script>location.href='IndexAdm.php';</script>";
} 
>>>>>>> Stashed changes

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOVac Adm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-dark">
                <div class="position-sticky pt-3">
                    <h4 class="text-white px-3">GOVacation Admin</h4>
                    <hr class="bg-light">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="CadLocs.php" id="new-rental-link">
                                <i class="bi bi-plus-circle me-2"></i> Nova Locação
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ListarLocs.php" id="edit-rental-link">
                                <i class="bi bi-pencil-square me-2"></i> Manter locação
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-left"></i> Log-out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Painel de Administração GOVacation</h1>
                </div>

                <div class="welcome-header">
                    <h3>Bem-vindo, Administrador!</h3>
                    <p class="lead">Gerencie as locações do hotel utilizando o menu ao lado.</p>
                </div>
<<<<<<< Updated upstream
=======

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
                            <form class="alterar-locacoes" method = "POST" action="./controller/ControleLocs.php?ACAO=alterarLocs">
                                <!--<div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="search-rental" class="form-label">Buscar Locação (ID)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="idloc" id="idloc" placeholder="Digite o ID">
                                            <button class="btn btn-outline-secondary" type="button">Buscar</button>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" name="idloc" id="edit-client-name" value="<?php echo htmlspecialchars($loc['idloc']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-client-name" class="form-label">Tipo da Locação:</label>
                                        <input type="text" class="form-control" name="tipoloc" id="edit-client-name" value="<?php echo htmlspecialchars($loc['tipoloc']); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit-checkin-date" class="form-label">Titulo:</label>
                                        <input type="text" class="form-control" 
                                        name="titulo"
                                        id="edit-checkin-date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-checkout-date" class="form-label">Link da Imagem</label>
                                        <input type="text" class="form-control" 
                                        name="imagem"
                                        id="edit-checkout-date">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-additional-info" class="form-label">Informações Adicionais</label>
                                    <textarea class="form-control" id="edit-additional-info" rows="3" ></textarea>
                                </div>
                                <button type="button" class="btn btn-success" id="edit-button">Editar</button>
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
>>>>>>> Stashed changes
            </main>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>