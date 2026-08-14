<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T.A.I</title>
    <link rel="icon" type="image/png" href="img/logo.png">

    <style>
    .h2 {
    text-align: top center;
    margin-bottom: 25px;
    }

    .img {
    text-align: top left;
    margin-bottom: 25px;
    }

    .main-menu {
    text-align: center left;
    margin-bottom: 25px;
    }

    .lateral {
    text-align: center right;
    margin-bottom: 25px;
    }

    .boton2 {
    text-align: center center;
    margin-bottom: 25px;
    }
    </style>
</head>
<body>
    
    <header>

        <img src="img/logo.png" alt="Logo de la pagina" width="100">

        <h2><title>T.A.I</title></h2>
        <tittle>Tu Armazon Ideal</tittle>
        <a href="">Conocenos</a></li>

    </header>

    <nav class="main-menu">
        <ul>
            <li class="menu-item">
                <span class="menu-btn">Menú ☰</span>
                <ul class="submenu">
                    <li><a href="">Lentes</a></li>
                    <li><a href="">Colorimetria</a></li>
                    <li><a href="">Consultas y Dudas</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="lateral">
        <br><br>
        <a href=""><button type="button">Cargar Foto</button></a>
    </div>

    <div class="boton1">
        <br><br>
        <a href="cuestionario.php"><button type="button">Realizar Cuestionario</button></a>
    </div>

</body>
</html>