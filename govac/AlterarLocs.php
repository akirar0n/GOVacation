<?php
include 'IndexAdm.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require './model/DAO/Conexao.php';

if (!isset($_GET['idloc'])) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Erro: ID da locação não informado!</div></div>");
}

$idloc = $_GET['idloc'];
$pdo = Conexao::getInstance();

try {
    $sql = "SELECT * FROM locacoes WHERE idloc = :idloc";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':idloc', $idloc, PDO::PARAM_INT);
    $stmt->execute();
    $loc = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$loc) {
        die("<div class='container mt-5'><div class='alert alert-danger'>Erro: Locação não encontrada!</div></div>");
    }
} catch (PDOException $e) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Erro na consulta: " . $e->getMessage() . "</div></div>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar locações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 8px;
            transition: all 0.3s;
            width: auto;
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-voltar {
            margin-top: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
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
            <h1 class="form-title">Alterar Locação</h1>
            
            <form id="alterarForm" method="POST" action="./controller/ControleLocs.php?ACAO=alterarLocs">
                
                <input type="hidden" name="idloc" value="<?php echo htmlspecialchars($loc['idloc']); ?>">

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="tipoloc" class="form-label">Tipo de Locação</label>
                        <input type="text" class="form-control" id="tipoloc" name="tipoloc" value="<?php echo htmlspecialchars($loc['tipoloc']); ?>" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($loc['titulo']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagem" class="form-label">Imagem (URL)</label>
                    <div class="input-icon">
                        <i class="fas fa-image"></i>
                        <input type="url" class="form-control" id="imagem" name="imagem" value="<?php echo htmlspecialchars($loc['imagem']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descr" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descr" name="descr" rows="3" required><?php echo htmlspecialchars($loc['descr']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="preco" class="form-label">Preço</label>
                        <div class="input-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($loc['preco']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="localizacao" class="form-label">Localização</label>
                        <div class="input-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" class="form-control" id="localizacao" name="localizacao" value="<?php echo htmlspecialchars($loc['localizacao']); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="qtdhospedes" class="form-label">Máximo de Hóspedes</label>
                        <div class="input-icon">
                            <i class="fas fa-users"></i>
                            <input type="number" class="form-control" id="qtdhospedes" name="qtdhospedes" value="<?php echo htmlspecialchars($loc['qtdhospedes']); ?>" required min="1">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="disp" class="form-label">Disponibilidade</label>
                        <select class="form-select" id="disp" name="disp" required>
                            <option value="Disponível" <?php echo ($loc['disp'] == 'Disponível') ? 'selected' : ''; ?>>Disponível</option>
                            <option value="Indisponível" <?php echo ($loc['disp'] == 'Indisponível') ? 'selected' : ''; ?>>Indisponível</option>
                            <option value="Ocupado" <?php echo ($loc['disp'] == 'Ocupado') ? 'selected' : ''; ?>>Ocupado</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-save me-2"></i>Salvar Alterações
                    </button>
                    <a href="ListarLocs.php" class="btn btn-light btn-voltar">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const qtdHospedes = document.getElementById('qtdhospedes').value;
            if (parseInt(qtdHospedes, 10) < 1) {
                alert('A quantidade de hóspedes não pode ser menor que 1.');
                e.preventDefault(); 
                return; 
            }

        document.getElementById('alterarForm').addEventListener('submit', function(e) {
            if (!confirm('Tem certeza que deseja alterar esta locação?')) {
                e.preventDefault(); 
            }
        });
    </script>
</body>
</html>