<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
 $conex->buscargrupo();

echo  json_encode($conex->buscargrupo($data));
