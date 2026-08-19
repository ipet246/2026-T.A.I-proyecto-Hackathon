<?php
declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require 'conexion.php';
mysqli_set_charset($conexion, 'utf8mb4');

function e(string|null $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function puntuarArmazon(array $armazon, array $r): int
{
    $puntaje = 10;
    $forma = $armazon['forma_Armazon'];
    $tamano = $armazon['tamano_Armazon'];

    if ($r['graduacion_cristal'] === 'alta') {
        $puntaje += (int) $armazon['apto_graduacion_alta'] === 1 ? 8 : -5;
    }
    if (in_array($r['tipo_cristal'], ['bifocal', 'progresivo'], true)) {
        $puntaje += (int) $armazon['apto_bifocal_progresivo'] === 1 ? 8 : -4;
    }
    if ($r['practica_deporte'] === 'si') {
        $puntaje += (int) $armazon['apto_deporte'] === 1 ? 9 : -3;
    }
    if ($r['frecuencia_uso'] === 'diario') {
        $puntaje += (int) $armazon['apto_uso_diario'] === 1 ? 4 : 0;
    }

    $formasRostro = [
        'redondo' => ['Rectangular', 'Cuadrado', 'Geométrico'],
        'ovalado' => ['Rectangular', 'Aviador', 'Ovalado'],
        'diamante' => ['Ovalado', 'Cat-eye'],
        'cuadrado' => ['Redondo', 'Ovalado'],
        'triangulo' => ['Cat-eye', 'Ovalado'],
        'triangulo_invertido' => ['Rectangular', 'Cuadrado', 'Geométrico'],
        'rectangular' => ['Redondo', 'Ovalado'],
        'alargado' => ['Redondo', 'Cuadrado'],
        'corazon' => ['Ovalado', 'Redondo', 'Cat-eye'],
    ];
    if (in_array($forma, $formasRostro[$r['tipo_rostro']] ?? [], true)) {
        $puntaje += 5;
    }

    $tamanoPuente = ['estrecho' => 'Pequeño', 'normal' => 'Mediano', 'ancho' => 'Grande'];
    if (($tamanoPuente[$r['puente_nariz']] ?? '') === $tamano) {
        $puntaje += 4;
    }

    $formasOjos = [
        'caidos' => ['Cat-eye', 'Geométrico'],
        'redondos' => ['Rectangular', 'Cat-eye'],
        'almendrados' => ['Ovalado', 'Aviador'],
        'rasgados' => ['Ovalado', 'Cat-eye'],
        'grandes' => ['Rectangular', 'Ovalado'],
        'chicos' => ['Ovalado', 'Redondo'],
    ];
    if (in_array($forma, $formasOjos[$r['forma_ojos']] ?? [], true)) {
        $puntaje += 3;
    }
    if ($r['tamano_ojos'] === 'chicos' && $tamano === 'Pequeño') {
        $puntaje += 2;
    }
    if ($r['tamano_ojos'] === 'grandes' && $tamano === 'Grande') {
        $puntaje += 2;
    }

    if ($r['separacion_ojos'] === 'juntos' && in_array($forma, ['Rectangular', 'Ovalado'], true)) {
        $puntaje += 2;
    }
    if ($r['separacion_ojos'] === 'separados' && in_array($forma, ['Redondo', 'Cat-eye'], true)) {
        $puntaje += 2;
    }

    $estilo = $r['estilo_preferido'];
    if ($estilo === 'minimalista' && in_array($armazon['tipo_montura'], ['Al aire', 'Tres piezas'], true)) {
        $puntaje += 5;
    }
    if ($estilo === 'deportivo' && ((int) $armazon['apto_deporte'] === 1 || $armazon['material_Armazon'] === 'TR-90')) {
        $puntaje += 5;
    }
    if ($estilo === 'retro' && in_array($forma, ['Redondo', 'Cat-eye'], true)) {
        $puntaje += 4;
    }
    if ($estilo === 'moderno' && in_array($forma, ['Geométrico', 'Rectangular'], true)) {
        $puntaje += 3;
    }
    if ($estilo === 'clasico' && in_array($forma, ['Rectangular', 'Ovalado'], true)) {
        $puntaje += 3;
    }
    if ($r['color_preferencia'] !== 'sin_preferencia' && $armazon['color_Armazon'] === $r['color_preferencia']) {
        $puntaje += 3;
    }

    return $puntaje;
}

function motivosArmazon(array $armazon, array $r): array
{
    $motivos = [];
    if ($r['graduacion_cristal'] === 'alta' && (int) $armazon['apto_graduacion_alta'] === 1) $motivos[] = 'Apto para graduación alta';
    if (in_array($r['tipo_cristal'], ['bifocal', 'progresivo'], true) && (int) $armazon['apto_bifocal_progresivo'] === 1) $motivos[] = 'Compatible con bifocales y progresivos';
    if ($r['practica_deporte'] === 'si' && (int) $armazon['apto_deporte'] === 1) $motivos[] = 'Preparado para actividad deportiva';
    if ($r['color_preferencia'] !== 'sin_preferencia' && $armazon['color_Armazon'] === $r['color_preferencia']) $motivos[] = 'Coincide con tu color preferido';
    if (!$motivos) $motivos[] = 'Buena combinación de forma, tamaño y uso diario';
    return array_slice($motivos, 0, 2);
}

$errores = [];
$recomendaciones = [];
$nombreCliente = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $campos = ['nombre', 'apellido', 'email', 'rango_edad', 'tipo_rostro', 'puente_nariz', 'separacion_ojos', 'forma_ojos', 'tamano_ojos', 'tipo_cristal', 'graduacion_cristal', 'actividad_principal', 'frecuencia_uso', 'practica_deporte', 'deporte_practicado', 'estilo_preferido', 'color_preferencia'];
    $r = [];
    foreach ($campos as $campo) $r[$campo] = trim((string) ($_POST[$campo] ?? ''));

    foreach ($campos as $campo) {
        if ($r[$campo] === '') $errores[] = 'Completá todos los campos obligatorios.';
    }
    if (!filter_var($r['email'], FILTER_VALIDATE_EMAIL)) $errores[] = 'Ingresá un correo electrónico válido.';

    if (!$errores) {
        try {
            mysqli_begin_transaction($conexion);
            $cliente = mysqli_prepare($conexion, 'INSERT INTO cliente (Nombre_Cliente, Apellido_Cliente, Gmail_Cliente) VALUES (?, ?, ?)');
            mysqli_stmt_bind_param($cliente, 'sss', $r['nombre'], $r['apellido'], $r['email']);
            mysqli_stmt_execute($cliente);
            $clienteId = mysqli_insert_id($conexion);

            $gradoAlto = $r['graduacion_cristal'] === 'alta' ? 1 : 0;
            $deporte = $r['practica_deporte'] === 'si' ? 1 : 0;
            $cuestionario = mysqli_prepare($conexion, 'INSERT INTO cuestionario (cliente_Id, rango_edad, tipo_rostro, puente_nariz, separacion_ojos, forma_ojos, tamano_ojos, tipo_cristal, graduacion_cristal, actividad_principal, frecuencia_uso, practica_deporte, deporte_practicado, estilo_preferido, color_preferencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $tipos = 'i' . str_repeat('s', 7) . 'i' . 'ss' . 'i' . 'sss';
            mysqli_stmt_bind_param($cuestionario, $tipos, $clienteId, $r['rango_edad'], $r['tipo_rostro'], $r['puente_nariz'], $r['separacion_ojos'], $r['forma_ojos'], $r['tamano_ojos'], $r['tipo_cristal'], $gradoAlto, $r['actividad_principal'], $r['frecuencia_uso'], $deporte, $r['deporte_practicado'], $r['estilo_preferido'], $r['color_preferencia']);
            mysqli_stmt_execute($cuestionario);
            $cuestionarioId = mysqli_insert_id($conexion);

            $consulta = mysqli_query($conexion, 'SELECT * FROM armazones');
            while ($armazon = mysqli_fetch_assoc($consulta)) {
                // Para usuarios que practican deporte, esta compatibilidad es obligatoria.
                // Así se evita recomendar un armazón que no fue diseñado para esa actividad.
                if ($r['practica_deporte'] === 'si' && (int) $armazon['apto_deporte'] !== 1) {
                    continue;
                }
                $armazon['puntaje'] = puntuarArmazon($armazon, $r);
                $recomendaciones[] = $armazon;
            }
            usort($recomendaciones, fn(array $a, array $b): int => $b['puntaje'] <=> $a['puntaje'] ?: $a['id_Armazon'] <=> $b['id_Armazon']);
            $recomendaciones = array_slice($recomendaciones, 0, 3);

            $guardarRecomendacion = mysqli_prepare($conexion, 'INSERT INTO recomendaciones_cuestionario (cuestionario_Id, armazon_Id, puntaje, posicion) VALUES (?, ?, ?, ?)');
            foreach ($recomendaciones as $posicion => $armazon) {
                $numero = $posicion + 1;
                $armazonId = (int) $armazon['id_Armazon'];
                $puntaje = (int) $armazon['puntaje'];
                mysqli_stmt_bind_param($guardarRecomendacion, 'iiii', $cuestionarioId, $armazonId, $puntaje, $numero);
                mysqli_stmt_execute($guardarRecomendacion);
            }
            mysqli_commit($conexion);
            $nombreCliente = $r['nombre'];
        } catch (Throwable $error) {
            mysqli_rollback($conexion);
            $errores[] = 'No se pudo guardar el cuestionario. Revisá la conexión e intentá nuevamente.';
            $recomendaciones = [];
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asistente de armazones | TAI</title>
    <link rel="stylesheet" href="cuestionario.css">
</head>
<body>
<header class="encabezado"><a href="TAI.php">← Volver al inicio</a><a class="catalogo-link" href="armazones.php">Ver catálogo</a><p>TAI · Óptica</p><h1>Encontrá tu armazón ideal</h1><span>Respondé el cuestionario y recibí tres recomendaciones.</span></header>
<main>
<?php if ($recomendaciones): ?>
    <section class="resultado" aria-live="polite">
        <p class="etiqueta">Resultado para <?= e($nombreCliente) ?></p>
        <h2>Tus 3 mejores opciones</h2>
        <p>El puntaje combina las necesidades seleccionadas con los atributos de cada armazón.</p>
        <div class="recomendaciones">
            <?php foreach ($recomendaciones as $indice => $armazon): ?>
                <article class="recomendacion">
                    <div class="imagen"><img src="<?= e($armazon['foto_Armazon']) ?>" alt="<?= e($armazon['nombre_Armazon']) ?>" onerror="this.style.display='none'"><b>Opción <?= $indice + 1 ?></b></div>
                    <div class="recomendacion-contenido"><span class="puntaje"><?= (int) $armazon['puntaje'] ?> puntos</span><h3><?= e($armazon['nombre_Armazon']) ?></h3><p><?= e($armazon['tipo_montura']) ?> · <?= e($armazon['material_Armazon']) ?> · <?= e($armazon['forma_Armazon']) ?></p><ul><?php foreach (motivosArmazon($armazon, $r) as $motivo): ?><li><?= e($motivo) ?></li><?php endforeach; ?></ul><small><?= e($armazon['cuidado_Armazon']) ?></small></div>
                </article>
            <?php endforeach; ?>
        </div>
        <a class="boton secundario" href="cuestionario.php">Hacer otro cuestionario</a>
    </section>
<?php else: ?>
    <section class="intro"><p class="etiqueta">Asistente basado en puntajes</p><h2>Contanos qué necesitás</h2><p>Las recomendaciones son orientativas y no reemplazan la evaluación de un profesional de óptica.</p></section>
    <?php if ($errores): ?><div class="errores"><?= e($errores[0]) ?></div><?php endif; ?>
    <form method="post" class="cuestionario">
        <fieldset><legend>1. Tus datos</legend><div class="campos tres"><label>Nombre<input name="nombre" required value="<?= e($_POST['nombre'] ?? '') ?>"></label><label>Apellido<input name="apellido" required value="<?= e($_POST['apellido'] ?? '') ?>"></label><label>Correo electrónico<input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>"></label></div></fieldset>
        <fieldset><legend>2. Rostro y ojos</legend><div class="campos tres"><label>Rango de edad<select name="rango_edad" required><option value="">Seleccionar</option><option>0-12</option><option>13-17</option><option>18-30</option><option>31-45</option><option>46-60</option><option>61 o más</option></select></label><label>Tipo de rostro<select name="tipo_rostro" required><option value="">Seleccionar</option><option value="redondo">Redondo</option><option value="ovalado">Ovalado</option><option value="diamante">Diamante</option><option value="cuadrado">Cuadrado</option><option value="triangulo">Triángulo</option><option value="triangulo_invertido">Triángulo invertido</option><option value="rectangular">Rectangular</option><option value="alargado">Alargado</option><option value="corazon">Corazón</option></select></label><label>Puente de nariz<select name="puente_nariz" required><option value="">Seleccionar</option><option value="estrecho">Estrecho</option><option value="normal">Normal</option><option value="ancho">Ancho</option></select></label><label>Separación de ojos<select name="separacion_ojos" required><option value="">Seleccionar</option><option value="juntos">Juntos</option><option value="normal">Normal</option><option value="separados">Separados</option></select></label><label>Forma de ojos<select name="forma_ojos" required><option value="">Seleccionar</option><option value="almendrados">Almendrados</option><option value="redondos">Redondos</option><option value="caidos">Caídos</option><option value="rasgados">Rasgados</option><option value="hundidos">Hundidos</option><option value="saltones">Saltones</option></select></label><label>Tamaño de ojos<select name="tamano_ojos" required><option value="">Seleccionar</option><option value="chicos">Chicos</option><option value="medianos">Medianos</option><option value="grandes">Grandes</option></select></label></div></fieldset>
        <fieldset><legend>3. Necesidades visuales y uso</legend><div class="campos tres"><label>Tipo de cristal<select name="tipo_cristal" required><option value="">Seleccionar</option><option value="monofocal">Monofocal</option><option value="bifocal">Bifocal</option><option value="progresivo">Progresivo</option></select></label><label>Graduación<select name="graduacion_cristal" required><option value="">Seleccionar</option><option value="baja_media">Baja o media</option><option value="alta">Alta</option></select></label><label>Actividad principal<select name="actividad_principal" required><option value="">Seleccionar</option><option value="trabajo_estudio">Trabajo o estudio</option><option value="hogar">Hogar</option><option value="aire_libre">Aire libre</option><option value="deporte">Deporte</option></select></label><label>Frecuencia de uso<select name="frecuencia_uso" required><option value="">Seleccionar</option><option value="diario">Todos los días</option><option value="frecuente">Varias veces por semana</option><option value="ocasional">Ocasional</option></select></label><label>¿Practicás deporte?<select name="practica_deporte" required><option value="">Seleccionar</option><option value="si">Sí</option><option value="no">No</option></select></label><label>Deporte practicado<select name="deporte_practicado" required><option value="Ninguno">Ninguno</option><option>Running</option><option>Ciclismo</option><option>Fútbol</option><option>Otro</option></select></label></div></fieldset>
        <fieldset><legend>4. Estilo</legend><div class="campos dos"><label>Estilo preferido<select name="estilo_preferido" required><option value="">Seleccionar</option><option value="clasico">Clásico</option><option value="moderno">Moderno</option><option value="minimalista">Minimalista</option><option value="retro">Retro</option><option value="deportivo">Deportivo</option></select></label><label>Color preferido<select name="color_preferencia" required><option value="sin_preferencia">Sin preferencia</option><option>Negro</option><option>Carey</option><option>Azul</option><option>Plata</option><option>Oro</option><option>Rosa</option><option>Verde</option></select></label></div></fieldset>
        <button class="boton" type="submit">Ver mis 3 recomendaciones</button>
    </form>
<?php endif; ?>
</main>
</body>
</html>
