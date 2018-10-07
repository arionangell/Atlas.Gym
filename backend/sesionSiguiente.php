<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$sesion = $_POST['sesion'];
$idgrupo = $_POST['grupo'];
$resultado = $conex->sesionsiguiente($idgrupo,$sesion);

echo  json_encode($resultado);
