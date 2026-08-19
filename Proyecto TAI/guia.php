<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guía de uso | TAI Óptica</title>
    <style>
        :root { --azul: #5f5174; --verde: #4f857d; --fondo: #faf6f1; --linea: #e5dce3; --texto: #403947; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--texto); background: var(--fondo); font: 16px/1.55 Arial, sans-serif; }
        header { padding: 44px max(8vw, 24px); color: white; background: linear-gradient(120deg, #705d85, #6a9d94); }
        header a { display: inline-block; margin-bottom: 20px; color: #f9eaf1; font-size: .9rem; font-weight: bold; text-decoration: none; } header a:hover { text-decoration: underline; }
        header p { margin: 0 0 7px; color: #f3dfe7; font-size: .8rem; font-weight: bold; letter-spacing: .1em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(2rem, 5vw, 3.2rem); } header span { display: block; margin-top: 8px; color: #edf6f2; }
        main { max-width: 900px; margin: 0 auto; padding: 32px 20px 60px; }
        section { margin-bottom: 20px; padding: 24px; border: 1px solid var(--linea); border-radius: 12px; background: #fffdfb; }
        h2 { margin-top: 0; color: var(--azul); font-size: 1.35rem; } h3 { margin-bottom: 6px; color: var(--verde); font-size: 1rem; }
        .pasos { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }.paso { padding: 15px; border-radius: 9px; background: #edf5f1; }.numero { display: grid; width: 28px; height: 28px; place-items: center; border-radius: 50%; color: white; background: var(--verde); font-weight: bold; }
        dl { display: grid; grid-template-columns: 210px 1fr; gap: 0; margin: 0; } dt, dd { margin: 0; padding: 12px; border-bottom: 1px solid var(--linea); } dt { color: var(--azul); background: #f8f1f3; font-weight: bold; } dd { color: #625b67; }
        .nota { padding: 14px; border-left: 4px solid var(--verde); border-radius: 4px; background: #eaf5f1; }.botones { display: flex; flex-wrap: wrap; gap: 12px; }.boton { padding: 11px 16px; border-radius: 7px; color: white; background: var(--verde); font-weight: bold; text-decoration: none; }.boton:hover { background: #41736c; }.boton.secundario { background: var(--azul); }.boton.secundario:hover { background: #4f4162; }
        @media (max-width: 650px) { .pasos { grid-template-columns: 1fr; } dl { grid-template-columns: 1fr; } dt { padding-bottom: 3px; border-bottom: 0; } dd { padding-top: 3px; } }
    </style>
</head>
<body>
    <header>
        <a href="TAI.php">← Volver al inicio</a>
        <p>TAI · Óptica</p>
        <h1>Guía de uso</h1>
        <span>Todo lo necesario para encontrar un armazón que se adapte a vos.</span>
    </header>
    <main>
        <section>
            <h2>¿Cómo funciona?</h2>
            <div class="pasos">
                <div class="paso"><div class="numero">1</div><h3>Respondé</h3><p>Completá el cuestionario con información sobre tus necesidades y preferencias.</p></div>
                <div class="paso"><div class="numero">2</div><h3>Compará</h3><p>El sistema asigna puntos a cada armazón según tus respuestas.</p></div>
                <div class="paso"><div class="numero">3</div><h3>Elegí</h3><p>Recibís tres opciones para revisar en detalle y conversar con la óptica.</p></div>
            </div>
        </section>

        <section>
            <h2>¿Qué podés hacer en la página?</h2>
            <dl>
                <dt>Página principal</dt><dd>Es el punto de inicio de TAI. Desde allí podés acceder al cuestionario, al catálogo y a esta guía.</dd>
                <dt>Catálogo de armazones</dt><dd>Permite ver los modelos disponibles con su foto, material, forma, tipo de montura, compatibilidades y consejos de cuidado.</dd>
                <dt>Asistente de recomendaciones</dt><dd>Analiza tus respuestas mediante un sistema de puntajes y presenta las tres alternativas que mejor coinciden con tu perfil.</dd>
                <dt>Resultados</dt><dd>Las recomendaciones se muestran ordenadas desde la mayor coincidencia hasta la menor, junto con una explicación breve de cada opción.</dd>
                <dt>Guía</dt><dd>Esta sección explica cómo navegar el sitio y aprovechar sus herramientas antes de tomar una decisión.</dd>
            </dl>
        </section>

        <section>
            <h2>Entender el resultado</h2>
            <p>Las tres opciones aparecen ordenadas por puntaje. Un puntaje mayor significa que el armazón coincide con más respuestas del cuestionario, por ejemplo compatibilidad con progresivos, deporte, forma de rostro o color.</p>
            <p>Cada opción también incluye una foto, sus características principales y una recomendación de cuidado.</p>
            <div class="nota"><strong>Importante:</strong> las recomendaciones son orientativas. La graduación, el centrado y el ajuste final deben ser revisados por un profesional de óptica.</div>
        </section>

        <section>
            <h2>Accesos rápidos</h2>
            <div class="botones"><a class="boton" href="cuestionario.php">Completar cuestionario</a><a class="boton secundario" href="armazones.php">Ver catálogo de armazones</a></div>
        </section>
    </main>
</body>
</html>
