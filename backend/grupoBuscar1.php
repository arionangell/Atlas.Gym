<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();

echo  json_encode($conex->buscargrupo1());
