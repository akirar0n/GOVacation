<?php
include 'IndexAdm.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Locação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
        }
        body {
            background-color: #f5f7fa;
        }
        .card-form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: white;
        }
        .form-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        .btn-submit {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-submit:hover {
            background-color: var(--secondary-color);
        }
        .input-icon {
            position: relative;
        }
        .input-icon .form-control {
            padding-left: 40px;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-form-container">
            <h1 class="form-title">Cadastrar Nova Locação</h1>
            <form method="POST" action="./controller/ControleLocs.php?ACAO=cadastrarLocs" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tipoloc" class="form-label">Tipo de Locação</label>
                        <input type="text" name="tipoloc" class="form-control" id="tipoloc" required>
                    </div>
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem (URL)</label>
                    <div class="input-icon">
                        <i class="fas fa-image"></i>
                        <input type="url" name="imagem" class="form-control" id="imagem" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descr" class="form-label">Descrição</label>
                    <textarea class="form-control" name="descr" id="descr" rows="3" required></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="preco" class="form-label">Preço (R$)</label>
                        <div class="input-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" step="0.01" name="preco" class="form-control" id="preco" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="localizacao" class="form-label">Localização</label>
                        <div class="input-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="localizacao" class="form-control" id="localizacao" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="qtdhospedes" class="form-label">Máx. de Hóspedes</label>
                        <div class="input-icon">
                            <i class="fas fa-users"></i>
                            <input type="number" name="qtdhospedes" class="form-control" id="qtdhospedes" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="disp" class="form-label">Disponibilidade Inicial</label>
                        <select class="form-select" name="disp" id="disp" required>
                            <option value="Disponível" selected>Disponível</option>
                            <option value="Indisponível">Indisponível</option>
                            <option value="Ocupado">Ocupado</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">
                        <i class="bi bi-check-circle me-2"></i>Registrar Locação
                    </button>
                    <a href="IndexAdm.php" class="btn btn-light btn-lg">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>