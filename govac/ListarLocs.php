<?php 
include 'IndexAdm.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manter Locações - GOVacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #ecf0f1;
        }
        
        body {
            background-color: var(--light-bg);
            color: var(--dark-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .search-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 0;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            vertical-align: middle;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .img-thumbnail {
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 80px;
            height: 60px;
            object-fit: cover;
        }
        
        .img-thumbnail:hover {
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.3);
        }
        
        .price-tag {
            font-weight: 700;
            color: var(--accent-color);
        }
        
        .btn-alterar {
            background-color: #f39c12;
            border: none;
            font-weight: 500;
            color: white;
        }
        
        .btn-alterar:hover {
            background-color: #e67e22;
            color: white;
        }
        
        .btn-excluir {
            background-color: var(--accent-color);
            border: none;
            font-weight: 500;
            color: white;
        }
        
        .btn-excluir:hover {
            background-color: #c0392b;
            color: white;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 0;
            }
            
            .search-header h5 {
                font-size: 1.2rem;
            }
            
            .img-thumbnail {
                width: 60px;
                height: 45px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid px-0">
        
        <div class="container py-4">
            <div class="table-container">
                <?php
                require './model/ClassLocs.php';
                require './model/DAO/ClassLocsDAO.php';

                $classLocsDAO = new ClassLocsDAO();
                $loc = $classLocsDAO->listarLocs();

                echo '<div class="table-responsive">';
                echo '<table class="table table-hover align-middle">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" class="ps-4">ID</th>';
                echo '<th scope="col">Tipo</th>';
                echo '<th scope="col">Título</th>';
                echo '<th scope="col">Imagem</th>';
                echo '<th scope="col">Descrição</th>';
                echo '<th scope="col">Preço</th>';
                echo '<th scope="col">Localização</th>';
                echo '<th scope="col">Hóspedes</th>';
                echo '<th scope="col">Status</th>';
                echo '<th scope="col" colspan="2" class="text-center">Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($loc as $locacao) {
                    echo '<tr>';
                    
                    echo '<td class="ps-4">' . htmlspecialchars($locacao['idloc']) . '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['tipoloc']) . '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['titulo']) . '</td>';
                    
                    echo '<td>';
                    echo '<a href="' . htmlspecialchars($locacao['imagem']) . '" data-lightbox="image-' . htmlspecialchars($locacao['idloc']) . '" data-title="' . htmlspecialchars($locacao['titulo']) . '">';
                    echo '<img src="' . htmlspecialchars($locacao['imagem']) . '" class="img-thumbnail">';
                    echo '</a>';
                    echo '</td>';
                    
                    echo '<td class="text-truncate" style="max-width: 200px;">' . htmlspecialchars($locacao['descr']) . '</td>';
                    
                    echo '<td class="price-tag">R$ ' . number_format($locacao['preco'], 2, ',', '.') . '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['localizacao']) . '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['qtdhospedes']) . '</td>';
                    
                    echo '<td>';
                    $badgeClass = ($locacao['disp'] == 'Disponível') ? 'bg-success' : (($locacao['disp'] == 'Ocupado') ? 'bg-danger' : 'bg-warning');
                    echo '<span class="badge ' . $badgeClass . '">' . htmlspecialchars($locacao['disp']) . '</span>';
                    echo '</td>';
                    
                    echo '<td class="text-center">';
                    echo '<a href="AlterarLocs.php?idloc=' . $locacao['idloc'] . '" class="btn btn-alterar btn-sm">';
                    echo '<i class="bi bi-pencil"></i> Alterar';
                    echo '</a>';
                    echo '</td>';
                    
                    echo '<td class="text-center pe-4">';
                    echo '<a href="controller/ControleLocs.php?ACAO=excluirLocs&idloc=' . htmlspecialchars($locacao['idloc']) . '" class="btn btn-excluir btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir esta locação?\');">';
                    echo '<i class="bi bi-trash"></i> Excluir';
                    echo '</a>';
                    echo '</td>';
                    
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Imagem %1 de %2'
        });
    </script>
    <?php include 'footer.php';?>
</body>
</html>