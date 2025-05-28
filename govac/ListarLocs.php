<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manter locações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="card">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Listar/Alterar/Excluir Locação</h5>
        <a href="IndexAdm.php" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
    <div class="card-body">
        <div class="container mt-3">
            <div class="card shadow">
                <div class="card-body table-responsive">
                    <?php
                            require './model/ClassLocs.php';
                            require './model/DAO/ClassLocsDAO.php';
                            $classLocsDAO = new ClassLocsDAO();
                            $loc = $classLocsDAO->listarLocs();

                            echo "<div class='container mt-5'>";
                            echo "<div class='card shadow'>";
                            echo "<div class='card-body table-responsive'>";
                            echo "<table class='table table-striped table-hover table-bordered'>";
                            echo "<thead class='thead-dark'>";
                            echo "<tr>";
                            echo "<th scope='col' class='text-nowrap'>ID Loc</th>";
                            echo "<th scope='col'>Tipo Locação</th>";
                            echo "<th scope='col'>Título</th>";
                            echo "<th scope='col'>Imagem</th>";
                            echo "<th scope='col'>Descrição</th>";
                            echo "<th scope='col'>Preço</th>";
                            echo "<th scope='col'>Localização</th>";
                            echo "<th scope='col'>Hóspedes</th>";
                            echo "<th scope='col'>Disponibilidade</th>";
                            echo "<th scope='col' colspan='2'>Ações</th>";
                            echo "</tr>";
                            echo "</thead>";

                            echo "<tbody>";
                            foreach ($loc as $loc) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($loc['idloc']) . "</td>";
                                echo "<td>" . htmlspecialchars($loc['tipoloc']) . "</td>";
                                echo "<td>" . htmlspecialchars($loc['titulo']) . "</td>";
                                echo "<td><a href='" . htmlspecialchars($loc['imagem']) . "' data-lightbox='image-" . htmlspecialchars($loc['idloc']) . "' data-title='" . htmlspecialchars($loc['titulo']) . "'>";
                                echo "<img src='" . htmlspecialchars($loc['imagem']) . "' class='img-thumbnail' style='max-width: 100px; max-height: 60px;'>";
                                echo "</a></td>";
                                echo "<td class='text-truncate' style='max-width: 200px;'>" . htmlspecialchars($loc['descr']) . "</td>";
                                echo "<td>R$ " . number_format(htmlspecialchars($loc['preco']), 2, ',', '.') . "</td>";
                                echo "<td>" . htmlspecialchars($loc['localizacao']) . "</td>";
                                echo "<td>" . htmlspecialchars($loc['qtdhospedes']) . "</td>";
                                echo "<td><span class='badge " . ($loc['disp'] == 'Disponível' ? 'bg-success' : ($loc['disp'] == 'Ocupado' ? 'bg-danger' : 'bg-warning')) . "'>" . htmlspecialchars($loc['disp']) . "</span></td>";

                                echo "<td class='text-nowrap'>";
                                echo "<a href='AlterarLocs.php?id=" . htmlspecialchars($loc['idloc']) . "' class='btn btn-warning btn-sm'>";
                                echo "<i class='bi bi-pencil'></i> Alterar";
                                echo "</a>";
                                echo "</td>";

                                echo "<td class='text-nowrap'>";
                                echo "<a href='controller/ControleLocs.php?ACAO=excluirLocs&idloc=" . htmlspecialchars($loc['idloc']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir esta locação?\");'>";
                                echo "<i class='bi bi-trash'></i> Excluir";
                                echo "</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>