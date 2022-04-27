<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/') ?>/styles/bootstrap.min.css" />
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="<?php echo base_url('/') ?>/styles/loginStyle.css">
    <link rel="shortcut icon" href="<?php echo base_url('/') ?>/lasBorregas.ico" type="image/x-icon">
    <title>Login las Borregas</title>
</head>

<body>
    <style>
        body {
            display: flex;
            justify-content: center;
            background-color: blueviolet;
        }

        .loginContainer {
            width: 40vw;
            height: 30vh;
            /*background-color: cadetblue;*/
            margin: 25vh 0px 0px 0px;
        }

        .letrero {
            width: auto;
            height: 10vh;
            margin: 0px 0px 0px 0px;
            justify-content: center;
            text-align: center;
            color: aliceblue;
        }
    </style>
    <div class="loginContainer">
        <div class="letrero">
            <h1>Bloquera Las Borregas</h1>
        </div>
        <?php echo $this->renderSection('contenidoForm'); ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>