<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Las Borregas</title>
</head>

<body>
    <style>
        .contenedor-head {
            background-color: cadetblue;
        }

        .nav-link {
            color: black;
        }

        .twoHeader {
            /*background-color: blue;*/
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
    </style>

    <div class="contenedor-head">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb -3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Las Borregas</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="<?php echo base_url('/vistas/admin'); ?>" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="<?php echo base_url('/clientes'); ?>" class="nav-link">Clientes</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="<?php echo base_url('/auth/logout'); ?>" class="nav-link">
                        <?php
                        echo session('cliente')->usuario ?? '';
                        ?>
                    </a></li>
            </ul>
        </header>
    </div>

    <!-- También se pueden importar componentes -->
    <?php echo $this->include('componentes/alerta'); ?>
    <!-- Fin Navbar -->
    <!-- Inicio Contenido -->
    <?php echo $this->renderSection('contenido'); ?>
    <!-- Fin Contenido -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>