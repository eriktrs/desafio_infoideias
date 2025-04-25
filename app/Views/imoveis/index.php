<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Imóveis</title>
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
        <h2 class="mb-4">CRUD de Imóveis</h2>

        <!-- Formulário de Imóvel -->
        <form class="mb-4" action="/desafio_infoideias/Imovel/store" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="row h-100">
                        <div class="col-md-6 mb-2">
                            <select class="form-control" name="tipo" required>
                                <option value="" disabled selected>Tipo de imóvel</option>
                                <option>Apartamento</option>
                                <option>Casa</option>
                                <option>Kitnet</option>
                                <option>Terreno</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" placeholder="Bairro" name="bairro" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Número de quartos" min="0" step="1" name="quartos" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Preço (R$)" min="0.01" step="0.01" name="preco" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <button type="submit" class="btn btn-primary w-100 h-100">
                        Adicionar Imóvel
                    </button>
                </div>
            </div>
        </form>


        <!-- Tabela de Imóveis -->
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Tipo</th>
                    <th>Bairro</th>
                    <th>Número de quartos</th>
                    <th>Preço (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['imoveis'] as $imovel): ?>
                    <tr>
                        <td><?= htmlspecialchars($imovel['tipo']) ?></td>
                        <td><?= htmlspecialchars($imovel['bairro']) ?></td>
                        <td><?= $imovel['quartos'] ?></td>
                        <td>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></td>
                        <td>
                            <a href="/desafio_infoideias/Imovel/edit/<?= $imovel['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/desafio_infoideias/Imovel/delete/<?= $imovel['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este imóvel?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="/desafio_infoideias/home" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>