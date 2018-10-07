<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$id = $_POST['id1'];
$ejercicio = $_POST['ejercicio'];
$fecha = $_POST['fecha1'];
$resultado = $conex->ejercicioinsertar($id, $ejercicio,$fecha);

echo  json_encode($resultado);
