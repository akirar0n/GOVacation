<?php
    include 'IndexAdm.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de locações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Cadastrar nova Locação</h5>
            </div>
            
            <div class="card-body">
                <form class="cadastro-locacoes" method="POST" action="./controller/ControleLocs.php?ACAO=cadastrarLocs">
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
                            <input type="number" step="0.01" name="preco" class="form-control" id="preco" required>
                        </div>
                        <div class="col-md-4">
                            <label for="local" class="form-label">Localização:</label>
                            <input type="text" name="localizacao" class="form-control" id="localizacao" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="qtdhospedes" class="form-label">Quant. de hóspedes:</label>
                            <input type="number" name="qtdhospedes" class="form-control" id="qtdhospedes" required>
                        </div>
                    </div>       
                    <div class="mb-3">
                        <label for="descr" class="form-label">Descrição:</label>
                        <textarea class="form-control" name="descr" id="descr" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="disp" class="form-label">Disponibilidade:</label>
                        <select class="form-select" name="disp" id="disp" required>
                            <option value="">Selecione...</option>
                            <option value="Disponível">Disponível</option>
                            <option value="Indisponível">Indisponível</option>
                            <option value="Ocupado">Ocupado</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Registrar Locação</button>
                        <a href="IndexAdm.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>