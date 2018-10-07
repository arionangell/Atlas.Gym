<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$id = $_POST['id1'];
$detalles = $_POST['detalles1'];
$fecha = $_POST['fecha1'];
$resultado = $conex->detallesactualizar($id, $detalles,$fecha);

echo  json_encode($resultado);
