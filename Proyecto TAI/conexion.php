<?php

    //declaro variables para la conexion a la BBDD
    $server="localhost";//servidor al q se va a conectar
    $user="root";//nombre del usuario para poder entrar al servidor
    $pass="";//clave del usuario
    $base="ProyectoTAI";//base de datos a la q me quiero conectar

    //establecer conexion con la BBDD
    $conexion=mysqli_connect('localhost', 'root', '', 'ProyectoTAI', 3307) or
     die("No se puede conectar: " . mysqli_connect_error());

?>