<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$fecha = $_POST['fecha'];
$resultado = $conex->tablahoy($fecha);

echo  json_encode($resultado);
