<?php
include 'IndexCliente.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['idusuario'])) {
    header('Location: Login.php');
    exit();
}

require './model/DAO/ClassResDAO.php';

$classResDAO = new ClassResDAO();
$idusuario = $_SESSION['idusuario'];
$reservas = $classResDAO->listarHistorico($idusuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Reservas - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .reserva-card {
            display: flex;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .reserva-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }
        .reserva-img-container {
            flex-basis: 35%;
            min-width: 200px;
        }
        .reserva-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .reserva-details {
            padding: 1.5rem;
            flex-grow: 1;
        }
        .icon-text { display: flex; align-items: center; color: #6c757d; margin-bottom: 0.5rem; }
        .icon-text i { margin-right: 0.8rem; font-size: 1.2rem; }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Minhas Reservas</h1>

        <?php if (empty($reservas)): ?>
            <div class="text-center p-5 bg-light rounded">
                <i class="bi bi-journal-x" style="font-size: 3rem; color: #6c757d;"></i>
                <h3 class="mt-3">Nenhuma reserva encontrada</h3>
                <p class="lead text-muted">Você ainda não fez nenhuma reserva. Que tal encontrar um lugar incrível para sua próxima viagem?</p>
                <a href="BuscarLocs.php" class="btn btn-primary mt-3">Buscar Locações</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($reservas as $reserva): ?>
                <div class="col-12">
                    <div class="reserva-card">
                        <div class="reserva-img-container">
                            <img src="<?php echo htmlspecialchars($reserva['imagem']); ?>" class="reserva-img" alt="<?php echo htmlspecialchars($reserva['titulo']); ?>">
                        </div>
                        <div class="reserva-details">
                            <h4 class="mb-3"><?php echo htmlspecialchars($reserva['titulo']); ?></h4>
                            <div class="icon-text">
                                <i class="bi bi-calendar-check-fill text-success"></i>
                                <span><strong>Check-in:</strong> <?php echo date("d/m/Y", strtotime($reserva['datacheckin'])); ?></span>
                            </div>
                            <div class="icon-text">
                                <i class="bi bi-calendar-x-fill text-danger"></i>
                                <span><strong>Check-out:</strong> <?php echo date("d/m/Y", strtotime($reserva['datacheckout'])); ?></span>
                            </div>
                            <div class="icon-text">
                                <i class="bi bi-credit-card-fill text-primary"></i>
                                <span><strong>Pagamento:</strong> <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($reserva['metodopag']))); ?></span>
                            </div>
                            <div class="icon-text">
                                <i class="bi bi-geo-alt-fill text-info"></i>
                                <span><strong>Local:</strong> <?php echo htmlspecialchars($reserva['localizacao']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>