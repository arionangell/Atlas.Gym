<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$conex->buscarmusculos();

echo  json_encode($conex->buscarmusculos($data));
