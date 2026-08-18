<?php
declare(strict_types=1);

$conexion = new mysqli('127.0.0.1', 'root', '', 'ProyectoTAI', 3307);
$conexion->set_charset('utf8mb4');

if ($conexion->connect_error) {
    http_response_code(500);
    exit('No se pudo conectar con la base de datos.');
}

$resultado = $conexion->query(
    'SELECT id_Armazon, nombre_Armazon, tipo_montura, material_Armazon,
            forma_Armazon, tamano_Armazon, apto_graduacion_alta,
            apto_bifocal_progresivo, apto_deporte, apto_uso_diario,
            foto_Armazon, cuidado_Armazon
     FROM armazones ORDER BY id_Armazon'
);

if (!$resultado) {
    http_response_code(500);
    exit('No se pudieron obtener los armazones.');
}

function e(?string $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function apto(int|string $valor): string
{
    return (int) $valor === 1 ? 'Si' : 'No';
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalogo de armazones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="hero">
        <div>
            <p class="eyebrow">T.A.I · Óptica</p>
            <h1>Catalogo de armazones</h1>
            <p class="hero-copy">Explora las opciones disponibles, sus caracteristicas y recomendaciones de cuidado.</p>
        </div>
        <div class="counter"><strong><?= $resultado->num_rows ?></strong><span>modelos cargados</span></div>
    </header>

    <main class="catalogo">
        <?php if ($resultado->num_rows === 0): ?>
            <p class="vacio">Todavia no hay armazones cargados.</p>
        <?php else: ?>
            <section class="grid" aria-label="Listado de armazones">
                <?php while ($armazon = $resultado->fetch_assoc()): ?>
                    <article class="tarjeta">
                        <div class="foto-wrap">
                            <img
                                src="<?= e($armazon['foto_Armazon']) ?>"
                                alt="Armazon <?= e($armazon['nombre_Armazon']) ?>"
                                loading="lazy"
                                onerror="this.closest('.foto-wrap').classList.add('sin-imagen'); this.style.display='none';"
                            >
                            <span class="foto-alternativa">Imagen no disponible</span>
                            <span class="tipo"><?= e($armazon['tipo_montura']) ?></span>
                        </div>
                        <div class="contenido">
                            <div class="titulo">
                                <p>Ref. #<?= e($armazon['id_Armazon']) ?></p>
                                <h2><?= e($armazon['nombre_Armazon']) ?></h2>
                            </div>
                            <dl class="detalles">
                                <div><dt>Material</dt><dd><?= e($armazon['material_Armazon']) ?></dd></div>
                                <div><dt>Forma</dt><dd><?= e($armazon['forma_Armazon']) ?></dd></div>
                                <div><dt>Tamano</dt><dd><?= e($armazon['tamano_Armazon']) ?></dd></div>
                            </dl>
                            <div class="aptitudes" aria-label="Compatibilidades">
                                <span class="<?= (int) $armazon['apto_graduacion_alta'] ? 'activo' : '' ?>">Graduacion alta: <?= apto($armazon['apto_graduacion_alta']) ?></span>
                                <span class="<?= (int) $armazon['apto_bifocal_progresivo'] ? 'activo' : '' ?>">Bifocal/progresivo: <?= apto($armazon['apto_bifocal_progresivo']) ?></span>
                                <span class="<?= (int) $armazon['apto_deporte'] ? 'activo' : '' ?>">Deporte: <?= apto($armazon['apto_deporte']) ?></span>
                                <span class="<?= (int) $armazon['apto_uso_diario'] ? 'activo' : '' ?>">Uso diario: <?= apto($armazon['apto_uso_diario']) ?></span>
                            </div>
                            <div class="cuidado">
                                <h3>Cuidado recomendado</h3>
                                <p><?= e($armazon['cuidado_Armazon']) ?></p>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
<?php
$resultado->free();
$conexion->close();
?>
