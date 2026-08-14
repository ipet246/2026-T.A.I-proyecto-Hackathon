<?php

include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T.A.I</title>
    <label>Nombre/s</label>
     <input type="text" name="nombre_Cliente">
     <br>
     <br>
     <label>Apellido/s</label>
     <input type="text" name="apellido_Cliente">
     <br>
     <br>
     <label>Gmail</label>
     <input type="text" name="email_Cliente">
     <br>
     <br>
     <label>Edad</label>
     <div>
          <input type="radio" name="rostro_Cliente" value="1">
          <label>0-5</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="2">
          <label>5-10</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="3">
          <label>10-15</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="4">
          <label>15-20</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="5">
          <label>20-30</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="6">
          <label>30-40</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="7">
          <label>40-50</label>
     </div>

     <div>
          <input type="radio" name="rostro_Cliente" value="8">
          <label>50-60</label>
     </div>

     <div>
          <input type="radio" name="rostro_Cliente" value="9">
          <label>60 o más</label>
     </div>
     <br>
     <br>
     <label>Tipo de rostro</label>
     <div>
          <input type="radio" name="rostro_Cliente" value="1">
          <label>Redondo</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="2">
          <label>Ovalado</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="3">
          <label>Diamante</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="4">
          <label>Cuadrado</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="5">
          <label>Triángulo</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="6">
          <label>Triángulo Invertido</label>
     </div>
     <div>
          <input type="radio" name="rostro_Cliente" value="7">
          <label>Rectangular</label>
     </div>

     <div>
          <input type="radio" name="rostro_Cliente" value="8">
          <label>Alargado</label>
     </div>

     <div>
          <input type="radio" name="rostro_Cliente" value="9">
          <label>Corazón</label>
     </div>
     <br>
     <br>
     <label>Distancia del Puente de la Nariz</label><!-- solo deberia poder agregar numeros -->
     <input type="number" name="puente_Cliente">
     <br>
     <br>
     <label>Tipo de ojos</label>
     <div>
          <input type="radio" name="ojo_Cliente" value="1">
          <label>Hundidos</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="2">
          <label>Saltones</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="3">
          <label>Juntos</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="4">
          <label>Separados</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="5">
          <label>Redondos</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="6">
          <label>Caidos</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="7">
          <label>Almendrados</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="8">
          <label>Chicos</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="9">
          <label>Grandes</label>
     </div>
     <div>
          <input type="radio" name="ojo_Cliente" value="10">
          <label>Rasgados</label>
     </div>
     <br>
     <br>
     <label>¿Tiene alguna preferencia en el color del lente? (Opcional)</label>
     <div>
         <input type="radio" name="color_lente_Cliente" value="1">
         <label>Negro</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="2">
         <label>Morado</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="3">
         <label>Verde</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="4">
         <label>Azul</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="5">
         <label>Rosa</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="6">
         <label>Nude</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="7">
         <label>Crema</label>
     </div>
     <div>
         <input type="radio" name="color_lente_Cliente" value="8">
         <label>Sin Color</label>
     </div>

</body>
</html>