<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$id = $_POST['grupo'];
$resultado = $conex->sesionesVerificar($id);

echo  json_encode($resultado);
