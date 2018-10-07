<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$sesion = $_POST['sesion'];
$grupo = $_POST['grupo'];
$resultado = $conex->estadotabla($grupo, $sesion);

echo  json_encode($resultado);
