import json
import math
import sys
import hashlib
from pathlib import Path

import mediapipe as mp
from modelo_forma_rostro import ClasificadorFormaRostro

# PHP interpreta el JSON como UTF-8 aun en Windows, donde Python puede heredar
# una página de códigos local distinta.
sys.stdout.reconfigure(encoding="utf-8")

MODELO = Path(__file__).resolve().parent / "modelos" / "face_landmarker.task"
CLASIFICADOR_ENTRENADO = None


def distancia(a, b, ancho, alto):
    return math.hypot((a.x - b.x) * ancho, (a.y - b.y) * alto)


def clasificar_rostro(proporciones):
    """Devuelve el perfil geométrico más cercano y dos alternativas.

    No hay una condición que fuerce un resultado: se puntúan todos los perfiles
    con las proporciones obtenidas de los landmarks de esta fotografía.
    """
    caracteristicas = (
        proporciones["alto_sobre_pomulos"],
        proporciones["frente_sobre_pomulos"],
        proporciones["mandibula_sobre_pomulos"],
        proporciones["mandibula_sobre_frente"],
        proporciones["tercio_inferior_sobre_alto"],
    )
    perfiles = {
        "redondo": (1.18, 0.80, 0.78, 0.98, 0.36),
        "cuadrado": (1.18, 0.82, 0.88, 1.07, 0.35),
        "ovalado": (1.33, 0.82, 0.78, 0.95, 0.37),
        "rectangular": (1.47, 0.82, 0.88, 1.07, 0.36),
        "alargado": (1.56, 0.78, 0.74, 0.95, 0.39),
        "corazon": (1.28, 0.91, 0.70, 0.77, 0.35),
        "diamante": (1.31, 0.72, 0.70, 0.97, 0.37),
        "triangulo": (1.22, 0.72, 0.91, 1.26, 0.35),
        "triangulo_invertido": (1.22, 0.91, 0.80, 0.88, 0.35),
    }
    tolerancias = (0.16, 0.10, 0.10, 0.16, 0.09)

    def puntaje(perfil):
        return sum(
            ((medida - esperado) / tolerancia) ** 2
            for medida, esperado, tolerancia in zip(caracteristicas, perfil, tolerancias)
        )

    ordenados = sorted(((puntaje(perfil), tipo) for tipo, perfil in perfiles.items()))
    return {
        "tipo": ordenados[0][1],
        "alternativas": [tipo for _, tipo in ordenados[1:3]],
    }


def analizar_rostro(ruta_foto):
    ruta = Path(ruta_foto)
    if not ruta.is_file():
        return {"ok": False, "error": "No se pudo abrir la imagen."}
    if not MODELO.is_file():
        return {"ok": False, "error": "Falta el modelo de detección facial."}

    global CLASIFICADOR_ENTRENADO
    try:
        if CLASIFICADOR_ENTRENADO is None:
            CLASIFICADOR_ENTRENADO = ClasificadorFormaRostro()
        prediccion = CLASIFICADOR_ENTRENADO.predecir(ruta)
    except Exception as error:
        return {"ok": False, "error": f"No se pudo cargar el modelo de clasificación: {error}"}
    if not prediccion["ok"]:
        return {"ok": False, "error": prediccion["error"]}

    vision = mp.tasks.vision
    opciones = vision.FaceLandmarkerOptions(
        base_options=mp.tasks.BaseOptions(model_asset_path=str(MODELO)),
        running_mode=vision.RunningMode.IMAGE,
        num_faces=1,
    )

    try:
        imagen = mp.Image.create_from_file(str(ruta))
        with vision.FaceLandmarker.create_from_options(opciones) as detector:
            resultado = detector.detect(imagen)
    except Exception as error:
        return {"ok": False, "error": f"No se pudo analizar la imagen: {error}"}

    if not resultado.face_landmarks:
        return {"ok": False, "error": "No se detectó un rostro. Usá una foto frontal, nítida y bien iluminada."}

    rostro = resultado.face_landmarks[0]
    alto, ancho = imagen.height, imagen.width
    ojo_izq, ojo_der = rostro[33], rostro[263]
    nariz_izq, nariz_der = rostro[129], rostro[358]
    frente, menton = rostro[10], rostro[152]
    entrecejo, base_nariz = rostro[168], rostro[2]
    # 93 y 323 recorren la zona más ancha de los pómulos. Los puntos 109 y
    # 338 quedan dentro de la frente, por eso no se usan como sus extremos.
    pomulo_izq, pomulo_der = rostro[93], rostro[323]
    mandibula_izq, mandibula_der = rostro[172], rostro[397]
    frente_izq, frente_der = rostro[103], rostro[332]

    distancia_ojos = distancia(ojo_izq, ojo_der, ancho, alto)
    ancho_nariz = distancia(nariz_izq, nariz_der, ancho, alto)
    alto_rostro = distancia(frente, menton, ancho, alto)
    ancho_rostro = distancia(pomulo_izq, pomulo_der, ancho, alto)
    ancho_mandibula = distancia(mandibula_izq, mandibula_der, ancho, alto)
    ancho_frente = distancia(frente_izq, frente_der, ancho, alto)
    tercio_superior = distancia(frente, entrecejo, ancho, alto)
    tercio_medio = distancia(entrecejo, base_nariz, ancho, alto)
    tercio_inferior = distancia(base_nariz, menton, ancho, alto)
    simetria_ojos = abs(ojo_izq.y - ojo_der.y) * alto

    proporciones = {
        "alto_sobre_pomulos": alto_rostro / ancho_rostro,
        "frente_sobre_pomulos": ancho_frente / ancho_rostro,
        "mandibula_sobre_pomulos": ancho_mandibula / ancho_rostro,
        "mandibula_sobre_frente": ancho_mandibula / ancho_frente,
        "tercio_inferior_sobre_alto": tercio_inferior / alto_rostro,
    }
    clasificacion_geometrica = clasificar_rostro(proporciones)

    return {
        "ok": True,
        "rostro_detectado": True,
        "tipo_rostro": prediccion["tipo_rostro"],
        "alternativas_tipo_rostro": prediccion["alternativas_tipo_rostro"],
        "puntajes_modelo": prediccion["puntajes_modelo"],
        "metodo_clasificacion": "modelo de visión entrenado",
        "referencia_geometrica": clasificacion_geometrica["tipo"],
        "distancia_ojos_px": round(distancia_ojos, 2),
        "ancho_nariz_px": round(ancho_nariz, 2),
        "ancho_rostro_px": round(ancho_rostro, 2),
        "altura_rostro_px": round(alto_rostro, 2),
        "ancho_mandibula_px": round(ancho_mandibula, 2),
        "ancho_frente_px": round(ancho_frente, 2),
        "imagen_ancho": ancho,
        "imagen_alto": alto,
        "imagen_id": hashlib.sha256(ruta.read_bytes()).hexdigest()[:12],
        "medidas": {
            "ancho_frente_px": round(ancho_frente, 2),
            "ancho_pomulos_px": round(ancho_rostro, 2),
            "ancho_mandibula_px": round(ancho_mandibula, 2),
            "altura_rostro_px": round(alto_rostro, 2),
            "distancia_ojos_px": round(distancia_ojos, 2),
            "ancho_nariz_px": round(ancho_nariz, 2),
            "tercio_superior_px": round(tercio_superior, 2),
            "tercio_medio_px": round(tercio_medio, 2),
            "tercio_inferior_px": round(tercio_inferior, 2),
            "desnivel_ojos_px": round(simetria_ojos, 2),
            "proporciones": {nombre: round(valor, 3) for nombre, valor in proporciones.items()},
        },
    }


if __name__ == "__main__":
    if len(sys.argv) != 2:
        print(json.dumps({"ok": False, "error": "Indicá la ruta de una fotografía."}, ensure_ascii=False))
        raise SystemExit(1)
    print(json.dumps(analizar_rostro(sys.argv[1]), ensure_ascii=False))
