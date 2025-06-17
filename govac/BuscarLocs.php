<?php
include 'IndexCliente.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['idusuario'])) { header('Location: Login.php'); exit(); }
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
        body { background-color: #f8f9fa; }
        .property-card { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07); transition: all 0.3s ease; }
        .property-card:hover { transform: translateY(-5px); box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1); }
        .property-card-img { height: 220px; object-fit: cover; }
        .property-card .card-body { padding: 1.5rem; }
        .price-tag { font-size: 1.5rem; font-weight: 700; color: #0d6efd; }
        .price-tag small { font-size: 0.9rem; font-weight: 400; color: #6c757d; }
        .icon-text { display: inline-flex; align-items: center; margin-right: 1.5rem; color: #6c757d; }
        .icon-text i { margin-right: 0.5rem; }
        .btn-whatsapp {
            background-color: #25D366;
            border-color: #25D366;
            color: white;
        }
        .btn-whatsapp:hover {
            background-color: #1DA851;
            border-color: #1DA851;
            color: white;
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
                    <img src="<?php echo htmlspecialchars($loc['imagem']); ?>" class="card-img-top property-card-img">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($loc['titulo']); ?></h5>
                        <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars($loc['descr']); ?></p>
                        <div class="d-flex mb-3">
                            <div class="icon-text"><i class="bi bi-tag-fill"></i> <?php echo htmlspecialchars($loc['tipoloc']); ?></div>
                            <div class="icon-text"><i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($loc['localizacao']); ?></div>
                            <div class="icon-text"><i class="bi bi-people-fill"></i> <?php echo htmlspecialchars($loc['qtdhospedes']); ?></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="price-tag">R$<?php echo number_format($loc['preco'], 2, ',', '.'); ?><small>/noite</small></div>
                            <a href="https://wa.me/+5561995008900" class="btn btn-whatsapp me-2" title="Contatar">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <?php if ($loc['disp'] == 'Disponível'): ?>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaModal" data-idloc="<?php echo $loc['idloc']; ?>">
                                    <i class="bi bi-calendar-check me-1"></i> Reservar
                                </button>
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

    <div class="modal fade" id="reservaModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="gerar_pagamento.php" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Datas da Reserva</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Selecione as datas de check-in e checkout.</p>
                        <input type="hidden" name="idloc" id="modalIdLoc">
                        <div class="mb-3">
                            <label for="datacheckin" class="form-label">Data de Check-in</label>
                            <input type="date" class="form-control" name="checkin" id="datacheckin" required>
                        </div>
                        <div class="mb-3">
                            <label for="datacheckout" class="form-label">Data de Check-out</label>
                            <input type="date" class="form-control" name="checkout" id="datacheckout" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Ir para Pagamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var reservaModal = document.getElementById('reservaModal');
        reservaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var idloc = button.getAttribute('data-idloc');
            var modalInput = reservaModal.querySelector('#modalIdLoc');
            modalInput.value = idloc;

            var today = new Date().toISOString().split('T')[0];
            document.getElementById('datacheckin').setAttribute('min', today);
            document.getElementById('datacheckout').setAttribute('min', today);
        });
    </script>
</body>
</html>