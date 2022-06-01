<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="<?php echo base_url('/') ?>/styles/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('/') ?>/fontawesome-6/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('/') ?>/styles/styles.css">
    <link rel="shortcut icon" href="<?php echo base_url('/') ?>/lasBorregas.ico" type="image/x-icon">
    <title>Las Borregas</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <div class="contenedor-head">
            <div class="logo">
                <a href="<?php echo base_url('/vistas/admin'); ?>" class="d-flex align-items-center mb -3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24" />
                        </g>
                        <g>
                            <g>
                                <g>
                                    <path d="M21.67,18.17l-5.3-5.3h-0.99l-2.54,2.54v0.99l5.3,5.3c0.39,0.39,1.02,0.39,1.41,0l2.12-2.12 C22.06,19.2,22.06,18.56,21.67,18.17z M18.84,19.59l-4.24-4.24l0.71-0.71l4.24,4.24L18.84,19.59z" />
                                </g>
                                <g>
                                    <path d="M17.34,10.19l1.41-1.41l2.12,2.12c1.17-1.17,1.17-3.07,0-4.24l-3.54-3.54l-1.41,1.41V1.71L15.22,1l-3.54,3.54l0.71,0.71 h2.83l-1.41,1.41l1.06,1.06l-2.89,2.89L7.85,6.48V5.06L4.83,2.04L2,4.87l3.03,3.03h1.41l4.13,4.13l-0.85,0.85H7.6l-5.3,5.3 c-0.39,0.39-0.39,1.02,0,1.41l2.12,2.12c0.39,0.39,1.02,0.39,1.41,0l5.3-5.3v-2.12l5.15-5.15L17.34,10.19z M9.36,15.34 l-4.24,4.24l-0.71-0.71l4.24-4.24l0,0L9.36,15.34L9.36,15.34z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="fs-4">Las Borregas</span>
                </a>
            </div>
            <div class="menu">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="<?php echo base_url('/home'); ?>" class="nav-link" aria-current="page">Home</a></li>
                    <!-- condicion para identificar el rol del empleado y desplegar las vistas para cada uno-->
                    <?php if (session('usuario')->fkidrol == '1') { ?>
                        <li class="nav-item"><a href="<?php echo base_url('/clientes'); ?>" class="nav-link">Clientes</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('/empleados'); ?>" class="nav-link">Empleados</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('/venta'); ?>" class="nav-link">Ventas</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('/bloque'); ?>" class="nav-link">Bloques</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('/reportes'); ?>" class="nav-link">Reportes</a></li>
                    <?php } elseif (session('usuario')->fkidrol == '2') { ?>
                        <li class="nav-item"><a href="<?php echo base_url('/empleados/agregar-venta'); ?>" class="nav-link">Ventas</a></li>
                    <?php } ?>
                    <li class="nav-item"><a href="<?php echo base_url('/vistas/nosotros'); ?>" class="nav-link">Nosotros</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('/auth/logout'); ?>" class="nav-link">
                            <?php
                            echo session('usuario')->nombre_usuario ?? '';
                            ?>
                        </a></li>
                    <?php if (session('usuario')->fkidrol == '3') {  ?>
                        <li><button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping"></i></button></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </header>

    <!-- También se pueden importar componentes -->
    <?php echo $this->include('componentes/alerta'); ?>
    <!-- Fin Navbar -->
    <!-- Inicio Contenido -->
    <?php echo $this->renderSection('contenido'); ?>
    <!-- Fin Contenido -->

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>
            <span class="text-muted">&copy; 2021 Borregas.Inc</span>
        </div>
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter" />
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram" />
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook" />
                    </svg></a></li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('/') ?>/js/logic.js"></script>
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>