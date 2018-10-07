<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$id = $_POST['grupo'];
$resultado = $conex->grupoVerificar($id);

echo  json_encode($resultado);
