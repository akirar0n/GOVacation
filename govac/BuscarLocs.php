<?php
include 'IndexCliente.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Locações - GOVacation</title>
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
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
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
        
        .btn-reserva {
            background-color: var(--secondary-color);
            border: none;
            font-weight: 500;
            color: white;
        }
        
        .btn-reserva:hover {
            background-color: #2980b9;
            color: white;
        }
        
        .whatsapp-btn {
            color: #25D366;
            font-size: 1.5rem;
            transition: transform 0.2s;
        }
        
        .whatsapp-btn:hover {
            transform: scale(1.1);
            color: #128C7E;
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
        <div class="container py-4">
            <div class="table-container">
                <?php
                require './model/ClassLocs.php';
                require './model/DAO/ClassLocsDAO.php';
                require './model/ClassRes.php';
                require './model/DAO/ClassResDAO.php';

                $ClassLocsDAO = new ClassLocsDAO();
                $loc = $ClassLocsDAO->listarLocs();

                echo '<div class="table-responsive">';
                echo '<table class="table table-hover align-middle">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" class="ps-4">Propriedade</th>';
                echo '<th scope="col">Tipo</th>';
                echo '<th scope="col">Localização</th>';
                echo '<th scope="col">Hóspedes</th>';
                echo '<th scope="col">Preço</th>';
                echo '<th scope="col">Status</th>';
                echo '<th scope="col">Ação</th>';
                echo '<th scope="col" class="pe-4">Contato</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($loc as $locacao) {
                    echo '<tr>';
                    
                    echo '<td class="ps-4">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<a href="' . htmlspecialchars($locacao['imagem']) . '" data-lightbox="image-' . htmlspecialchars($locacao['idloc']) . '" data-title="' . htmlspecialchars($locacao['titulo']) . '" class="me-3">';
                    echo '<img src="' . htmlspecialchars($locacao['imagem']) . '" class="img-thumbnail">';
                    echo '</a>';
                    echo '<div>';
                    echo '<h6 class="mb-0">' . htmlspecialchars($locacao['titulo']) . '</h6>';
                    echo '<small class="text-muted">' . htmlspecialchars(substr($locacao['descr'], 0, 30)) . '...</small>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['tipoloc']) . '</td>';

                    echo '<td>' . htmlspecialchars($locacao['localizacao']) . '</td>';
                    
                    echo '<td>' . htmlspecialchars($locacao['qtdhospedes']) . '</td>';
                    
                    echo '<td class="price-tag">R$ ' . number_format($locacao['preco'], 2, ',', '.') . '</td>';
                    
                    echo '<td>';
                    $badgeClass = ($locacao['disp'] == 'Disponível') ? 'bg-success' : (($locacao['disp'] == 'Ocupado') ? 'bg-danger' : 'bg-warning');
                    echo '<span class="badge ' . $badgeClass . '">' . htmlspecialchars($locacao['disp']) . '</span>';
                    echo '</td>';
                    
                    echo '<td>';
                    if ($locacao['disp'] == 'Disponível') {
                        echo '<a href="https://nubank.com.br/cobrar/1dkdn3/6840dbaa-e796-4019-9a49-b05e033ed25b?idloc=' . htmlspecialchars($locacao['idloc']) . '" class="btn btn-reserva btn-sm">';
                        echo '<i class="bi bi-calendar-check me-1"></i> Reservar';
                        echo '</a>';
                    } else {
                        echo '<button class="btn btn-outline-secondary btn-sm" disabled>';
                        echo '<i class="bi bi-calendar-x me-1"></i> Indisponível';
                        echo '</button>';
                    }
                    echo '</td>';
                    
                    echo '<td class="pe-4 text-center">';
                    echo '<a href="https://wa.me/5561995008900" class="whatsapp-btn">';
                    echo '<i class="bi bi-whatsapp"></i>';
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