<?php
    include 'IndexAdm.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de locações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #ecf0f1;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-text);
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
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .form-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 8px;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }
        
        .input-icon input {
            padding-left: 40px;
        }
        
        @media (max-width: 768px) {
            .card-form-container {
                padding: 1.5rem;
                margin: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-form-container">
            <form method="POST" action="./controller/ControleLocs.php?ACAO=cadastrarLocs">
                <h1 class="form-title">Cadastrar Locações</h1>
    
                <div class="form-group">
                    <label for="tipoloc" class="form-label">Tipo loc</label>
                    <input type="text" class="form-control" id="tipoloc" name="tipoloc">
                </div>

                <div class="form-group">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>

                <div class="form-group">
                    <label for="imagem" class="form-label">Imagem (URL)</label>
                    <div class="input-icon">
                        <i class="fas fa-image"></i>
                        <input type="text" class="form-control" id="imagem" name="imagem">
                    </div>
                </div>

                <div class="form-group">
                    <label for="descr" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descr" name="descr" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="preco" class="form-label">Preço</label>
                    <div class="input-icon">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="text" class="form-control" id="preco" name="preco">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localizacao" class="form-label">Localização</label>
                            <div class="input-icon">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" class="form-control" id="localizacao" name="localizacao">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="qtdhospedes" class="form-label">Hóspedes</label>
                            <div class="input-icon">
                                <i class="fas fa-users"></i>
                                <input type="number" class="form-control" id="qtdhospedes" name="qtdhospedes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="disp" class="form-label">Disponibilidade</label>
                            <select class="form-control" id="disp" name="disp">
                                <option value="1">Disponível</option>
                                <option value="0">Indisponível</option>
                            </select>
                        </div>
                    </div>
                </div>

            <button type="submit" class="btn btn-primary">Registrar Locação</button>
            <a href="IndexAdm.php" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>