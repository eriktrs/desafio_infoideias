<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desafio INFOIDEIAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #273f5b;
            color: #fff;
            padding-top: 60px;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            margin-top: 20px;
        }

        .navbar {
            background-color: #1f3247 !important;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #f49431 !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">INFOIDEIAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container">
        <div class="card" id="usuarios">
            <div class="card-body">
                <h5 class="card-title">CRUD de Imóveis</h5>
                <p class="card-text">Acesse aqui o gerenciamento de Imóveis do sistema.</p>
                <a href="/desafio_infoideias/Imovel/index" class="btn btn-primary">Gerenciar Imóveis</a>
            </div>
        </div>

        <div class="card" id="clientes">
            <div class="card-body">
                <h5 class="card-title">CRUD de Interesse de Clientes</h5>
                <p class="card-text">Acesse aqui o gerenciamento de clientes.</p>
                <a href="/desafio_infoideias/Interesse/index" class="btn btn-success">Gerenciar Interesse de Clientes</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>