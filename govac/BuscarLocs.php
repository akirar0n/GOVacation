<?php
include 'IndexCliente.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['idusuario'])) {
    header('Location: Login.php');
    exit();
}

require './model/DAO/ClassLocsDAO.php';
$classLocsDAO = new ClassLocsDAO();
$locacoes = $classLocsDAO->listarLocs();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Locações - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .property-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }
        .property-card-img {
            height: 220px;
            object-fit: cover;
        }
        .property-card .card-body {
            padding: 1.5rem;
        }
        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d6efd;
        }
        .price-tag small {
            font-size: 0.9rem;
            font-weight: 400;
            color: #6c757d;
        }
        .icon-text {
            display: inline-flex;
            align-items: center;
            margin-right: 1.5rem;
            color: #6c757d;
        }
        .icon-text i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Encontre sua Próxima Aventura</h1>
        <div class="row g-4">
            <?php foreach ($locacoes as $loc): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card property-card h-100">
                    <img src="<?php echo htmlspecialchars($loc['imagem']); ?>" class="card-img-top property-card-img" alt="<?php echo htmlspecialchars($loc['titulo']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($loc['titulo']); ?></h5>
                        <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars($loc['descr']); ?></p>
                        
                        <div class="d-flex mb-3">
                            <div class="icon-text" title="Tipo">
                                <i class="bi bi-tag-fill"></i> <?php echo htmlspecialchars($loc['tipoloc']); ?>
                            </div>
                            <div class="icon-text" title="Localização">
                                <i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($loc['localizacao']); ?>
                            </div>
                            <div class="icon-text" title="Hóspedes">
                                <i class="bi bi-people-fill"></i> <?php echo htmlspecialchars($loc['qtdhospedes']); ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="price-tag">
                                R$<?php echo number_format($loc['preco'], 2, ',', '.'); ?><small>/noite</small>
                            </div>
                            <?php if ($loc['disp'] == 'Disponível'): ?>
                                <a href="gerar_pagamento.php?idloc=<?php echo htmlspecialchars($loc['idloc']); ?>" class="btn btn-primary">
                                    <i class="bi bi-calendar-check me-1"></i> Reservar
                                </a>
                            <?php else: ?>
                                <button class="btn btn-outline-secondary" disabled>Indisponível</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>