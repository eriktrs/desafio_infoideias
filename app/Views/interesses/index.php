<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Interesse de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
</style>

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
        <h2 class="mb-4">CRUD de Interesse de clientes</h2>

        <!-- Formulário de Interesse de cliente -->
        <form class="mb-4" action="/desafio_infoideias/Interesse/store" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" placeholder="Nome" name="nome" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="tel" class="form-control" placeholder="Telefone" name="telefone" required>
                </div>
                <div class="col-md-6 mb-3">
                    <select class="form-control" name="tipo_desejado" required>
                        <option value="" disabled selected>Tipo de imóvel desejado</option>
                        <option>Apartamento</option>
                        <option>Casa</option>
                        <option>Kitnet</option>
                        <option>Terreno</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Faixa de preço desejada (R$)</label>
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control" placeholder="Mínimo" name="preco_min" min="0" step="0.01" id="precoMin">
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control" placeholder="Máximo" name="preco_max" min="0.01" step="0.01" id="precoMax">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="number" class="form-control" placeholder="Número mínimo de quartos" name="quartos" min="0" step="1"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <select name="bairros" class="form-control" multiple required>
                        <?php if (isset($data['bairros']) && !empty($data['bairros'])): ?>
                            <?php foreach ($data['bairros'] as $bairro): ?>
                                <option value="<?= htmlspecialchars($bairro) ?>"><?= htmlspecialchars($bairro) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Nenhum bairro disponível</option>
                        <?php endif; ?>
                    </select>
                    <small class="text-light">Segure CTRL para selecionar múltiplos bairros.</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar Interesse</button>
        </form>


        <!-- Tabela de Interesse de clientes -->
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Tipo de Imóvel desejado</th>
                    <th>Faixa de preço (R$)</th>
                    <th>Número mínimo de quartos</th>
                    <th>Lista de bairros desejados</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($interesses as $interesse): ?>
                    <?php foreach ($interesse_bairros as $interesse_bairro): ?>
                        <?php if ($interesse['id'] == $interesse_bairro['interesse_id']): ?>
                            <tr>
                                <td><?= htmlspecialchars($interesse['nome']) ?></td>
                                <td><?= htmlspecialchars($interesse['telefone']) ?></td>
                                <td><?= htmlspecialchars($interesse['tipo_desejado']) ?></td>
                                <td>
                                    R$ <?= $interesse['preco_min'] ? number_format($interesse['preco_min'], 2, ',', '.') : '---' ?>
                                    até
                                    R$ <?= $interesse['preco_max'] ? number_format($interesse['preco_max'], 2, ',', '.') : '---' ?>
                                </td>
                                <td><?= $interesse['quartos'] ?? '---' ?></td>
                                <td>
                                    <?php if (isset($interesse_bairro['bairro']) && is_array($interesse_bairro['bairro'])): ?>
                                        <?= implode(', ', array_map('htmlspecialchars', $interesse_bairro['bairro'])) ?>
                                    <?php else: ?>
                                        <?= htmlspecialchars($interesse_bairro['bairro']) ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/desafio_infoideias/Interesse/edit/<?= $interesse['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="/desafio_infoideias/Interesse/delete/<?= $interesse['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este interesse?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td><?= htmlspecialchars($interesse['nome']) ?></td>
                        <td><?= htmlspecialchars($interesse['telefone']) ?></td>
                        <td><?= htmlspecialchars($interesse['tipo_desejado']) ?></td>
                        <td>
                            R$ <?= $interesse['preco_min'] ? number_format($interesse['preco_min'], 2, ',', '.') : '---' ?>
                            até
                            R$ <?= $interesse['preco_max'] ? number_format($interesse['preco_max'], 2, ',', '.') : '---' ?>
                        </td>
                        <td><?= $interesse['quartos'] ?? '---' ?></td>
                        <td>
                            <p>Nenhum</p>
                        </td>
                        <td>
                            <a href="/desafio_infoideias/Interesse/edit/<?= $interesse['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/desafio_infoideias/Interesse/delete/<?= $interesse['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este interesse?')">Excluir</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>


        <a href="index.html" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para verificar se um dos campos de preço mínimo ou máximo foram preenchidos -->
    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            const min = document.getElementById("precoMin").value;
            const max = document.getElementById("precoMax").value;

            if (!min && !max) {
                e.preventDefault();
                alert("Por favor, informe pelo menos o preço mínimo ou máximo.");
            }
        });
    </script>

</body>

</html>