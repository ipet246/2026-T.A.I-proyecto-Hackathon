<?php
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T.A.I</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="diseño.css">
</head>
<body>
    <header>
        <img src="img/logo.png" alt="Logo de TAI" width="100">

        <div>
            <h2>T.A.I</h2>
            <p class="subtitulo">Tu Armazón Ideal</p>
        </div>

        <a href="conocenos.html">Conócenos</a>
    </header>

    <nav class="main-menu">
        <ul>
            <li class="menu-item">
                <span class="menu-btn">Menú ☰</span>

                <ul class="submenu">
                    <li><a href="armazones.php">Armazones</a></li>
                    <li><a href="guia.php">Guía</a></li>
                    <li><a href="preguntas-frecuentes.html">Preguntas Frecuentes</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="inicio">
        <section class="panel-foto">
            <div class="panel-copy">
                <p class="etiqueta-analisis">Análisis facial orientativo</p>
                <h1>Encontrá armazones que acompañen tus rasgos</h1>
                <p>
                    Subí una foto frontal y nítida. El análisis se realiza localmente
                    para estimar las proporciones de tu rostro.
                </p>

                <form action="analizar.php" method="post" enctype="multipart/form-data">
                    <label for="foto">Elegí una fotografía</label>
                    <input
                        id="foto"
                        name="foto"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                        required
                    >
                    <small>JPG, PNG o WEBP · máximo 8 MB</small>
                    <button type="submit">Analizar mi rostro</button>
                </form>
            </div>

            <aside class="marca-principal" aria-label="Identidad de TAI">
                <img src="img/logo.png" alt="Logo TAI: Tu Armazón Ideal">
                <span>Tu Armazón Ideal</span>
            </aside>
        </section>

        <section class="panel-cuestionario">
            <h2>¿Preferís hacerlo paso a paso?</h2>
            <p>
                Completá el cuestionario y recibí tres recomendaciones según tus
                necesidades, estilo y uso.
            </p>
            <a class="accion" href="cuestionario.php">Realizar cuestionario</a>
        </section>
    </main>
</body>
</html>
