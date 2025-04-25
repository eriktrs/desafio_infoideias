<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado de Matches de Interesses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #273f5b;
            color: #fff;
            padding-top: 60px;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary,
        .btn-success {
            background-color: #f49431;
            border-color: #f49431;
        }

        .btn-primary:hover,
        .btn-success:hover {
            background-color: #d87d1d;
            border-color: #d87d1d;
        }

        .navbar {
            background-color: #1f3247 !important;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #f49431 !important;
        }

        table thead {
            background-color: #f49431;
            color: #fff;
        }

        .form-control {
            border-radius: 6px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/desafio_infoideias/home">INFOIDEIAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Resultado de Matches de Interesses</h2>

        <!-- Tabela de Matches de Interesse -->
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Tipo de Imóvel Desejado</th>
                        <th>Faixa de Preço (R$)</th>
                        <th>Número Mínimo de Quartos</th>
                        <th>Bairros Desejados</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($matches)): ?>
                        <?php foreach ($matches as $match): ?>
                            <tr>
                                <td><?= htmlspecialchars($match['nome']) ?></td>
                                <td><?= htmlspecialchars($match['telefone']) ?></td>
                                <td><?= htmlspecialchars($match['tipo_desejado']) ?></td>
                                <td>
                                    R$ <?= $match['preco_min'] ? number_format($match['preco_min'], 2, ',', '.') : '---' ?>
                                    até
                                    R$ <?= $match['preco_max'] ? number_format($match['preco_max'], 2, ',', '.') : '---' ?>
                                </td>
                                <td><?= $match['quartos'] ?? '---' ?></td>
                                <td>
                                    <?php if (isset($match['bairro']) && is_array($match['bairro'])): ?>
                                        <?= implode(', ', array_map('htmlspecialchars', $match['bairro'])) ?>
                                    <?php else: ?>  
                                        <?= htmlspecialchars($match['bairro']) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Nenhum match encontrado para os interesses cadastrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="/desafio_infoideias/home" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
