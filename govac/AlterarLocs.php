<?php
include 'IndexAdm.php';


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar locações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <?php 
    require './model/ClassLocs.php';
        require './model/DAO/ClassLocsDAO.php';
        
        if (isset($_GET['idloc'])) {
            $idloc = $_GET['idloc'];
            
            $ClassLocsDAO = new ClassLocsDAO();
            $loc = $ClassLocsDAO->buscarLocs($idloc);

            if (!$loc) {
                echo "<div class='alert alert-danger'>Locação não encontrada!</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>ID da locação não fornecido!</div>";
            exit;
        }
    ?>

    <div class="container">
        <div class="card-form-container">
            <form method="POST" action="./controller/ControleLocs.php?ACAO=alterarLocs">
                <h1 class="form-title">Alterar Locações</h1>
                <input type="hidden" name="idloc" value="<?php echo htmlspecialchars($loc->getIdloc()); ?>">
                

                <div class="form-group">
                    <label for="tipoloc" class="form-label">Tipo loc</label>
                    <input type="text" class="form-control" id="tipoloc" name="tipoloc" value="<?php echo htmlspecialchars($loc->getTipoloc()); ?>">
                </div>
                
                <div class="form-group">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($loc->getTitulo()); ?>">
                </div>
                
                <div class="form-group">
                    <label for="imagem" class="form-label">Imagem (URL)</label>
                    <div class="input-icon">
                        <i class="fas fa-image"></i>
                        <input type="text" class="form-control" id="imagem" name="imagem" value="<?php echo htmlspecialchars($loc->getImagem()); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="descr" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descr" name="descr" rows="3"><?php echo htmlspecialchars($loc->getDescr()); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="preco" class="form-label">Preço</label>
                    <div class="input-icon">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="text" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($loc->getPreco()); ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localizacao" class="form-label">Localização</label>
                            <div class="input-icon">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" class="form-control" id="localizacao" name="localizacao" value="<?php echo htmlspecialchars($loc->getLocalizacao()); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="qtdhospedes" class="form-label">Hóspedes</label>
                            <div class="input-icon">
                                <i class="fas fa-users"></i>
                                <input type="number" class="form-control" id="qtdhospedes" name="qtdhospedes" value="<?php echo htmlspecialchars($loc->getQtdhospedes()); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="disp" class="form-label">Disponibilidade</label>
                            <select class="form-control" id="disp" name="disp">
                                <option value="1" <?php echo htmlspecialchars($loc->getDisp()) == 1 ? 'selected' : ''; ?>>Disponível</option>
                                <option value="0" <?php echo htmlspecialchars($loc->getDisp()) == 0 ? 'selected' : ''; ?>>Indisponível</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-submit">
                    <i class="fas fa-save me-2"></i>Salvar Alterações
                </button>
                <a href="IndexAdm.php" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('Tem certeza que deseja alterar esta locação?')) {
                e.preventDefault();
            }
        });
    </script>
    <?php include 'footer.php';?>
</body>
</html>