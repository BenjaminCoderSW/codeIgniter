<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Sistema de Cine</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/Estilos.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        /* Fondo para el Home */
        .background3 { 
            background-image: url("../img/silla.avif");
            width: 100%;
            height: auto;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="background3">
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BenVani Cineplex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-info mx-2" href="<?= base_url('peliculas') ?>">Peliculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary mx-2" href="<?= base_url('taquilla') ?>">Taquilla</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning mx-2" href="<?= base_url('usuarios') ?>">Usuarios</a>
                    </li>
                </ul>
                <!-- Botones a la derecha -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-success mx-2" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="<?= base_url('salir') ?>">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mt-4">
        <h1>Bienvenido a BenVani Cineplex</h1>
        <p>¡Da clic a Usuarios para ingresar un nuevo usuario!</p>
        <!-- Contenido del HOME va aqui -->
    </div>
</body>
</html>
