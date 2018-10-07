<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$conex->buscarmusculo();

echo  json_encode($conex->buscarmusculo($data));
