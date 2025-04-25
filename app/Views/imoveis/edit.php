<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Imóvel</title>
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

    .btn-primary {
        background-color: #f49431;
        border-color: #f49431;
    }

    .btn-primary:hover {
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
    <h2 class="mb-4">Editar Imóvel</h2>

    <form action="/desafio_infoideias/Imovel/update/<?= $imovel['id'] ?>" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo de imóvel</label>
                <select class="form-control" name="tipo" required>
                    <option value="Apartamento" <?= $imovel['tipo'] == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
                    <option value="Casa" <?= $imovel['tipo'] == 'Casa' ? 'selected' : '' ?>>Casa</option>
                    <option value="Kitnet" <?= $imovel['tipo'] == 'Kitnet' ? 'selected' : '' ?>>Kitnet</option>
                    <option value="Terreno" <?= $imovel['tipo'] == 'Terreno' ? 'selected' : '' ?>>Terreno</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?= htmlspecialchars($imovel['bairro']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="quartos" class="form-label">Número de quartos</label>
                <input type="number" class="form-control" name="quartos" min="0" value="<?= $imovel['quartos'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" class="form-control" name="preco" min="0.01" step="0.01" value="<?= $imovel['preco'] ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/desafio_infoideias/Imovel/index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
