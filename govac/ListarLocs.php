<?php 
include 'IndexAdm.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['idusuario']) || $_SESSION['tipousuario'] != 1) {
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
    <title>Manter Locações - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }
        .img-thumbnail {
            width: 100px;
            height: 75px;
            object-fit: cover;
            border-radius: 8px;
        }
        .text-truncate-cust {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-acao {
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Gerenciamento de Locações</h2>
                <a href="CadLocs.php" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Nova Locação</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th class="text-truncate-cust">Descrição</th>
                            <th>Localização</th>
                            <th>Hóspedes</th>
                            <th>Preço/dia</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($locacoes as $loc): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($loc['idloc']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($loc['imagem']); ?>" class="img-thumbnail"></td>
                            <td class="text-start"><?php echo htmlspecialchars($loc['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($loc['tipoloc']); ?></td>
                            <td class="text-truncate-cust"><?php echo htmlspecialchars($loc['descr']); ?></td>
                            <td><?php echo htmlspecialchars($loc['localizacao']); ?></td>
                            <td><?php echo htmlspecialchars($loc['qtdhospedes']); ?></td>
                            <td>R$ <?php echo number_format($loc['preco'], 2, ',', '.'); ?></td>
                            <td>
                                <?php 
                                $status = htmlspecialchars($loc['disp']);
                                $badgeClass = 'bg-secondary';
                                if ($status == 'Disponível') $badgeClass = 'bg-success';
                                if ($status == 'Ocupado') $badgeClass = 'bg-danger';
                                if ($status == 'Indisponível') $badgeClass = 'bg-warning text-dark';
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                            </td>
                            <td>
                                <a href="AlterarLocs.php?idloc=<?php echo $loc['idloc']; ?>" class="btn btn-warning btn-sm btn-acao mb-1">
                                    <i class="bi bi-pencil-fill"></i> Alterar
                                </a>
                                <a href="controller/ControleLocs.php?ACAO=excluirLocs&idloc=<?php echo $loc['idloc']; ?>" class="btn btn-danger btn-sm btn-acao" onclick="return confirm('Tem certeza que deseja excluir esta locação?');">
                                    <i class="bi bi-trash-fill"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>