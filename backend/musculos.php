<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$sesion = $_POST['sesion'];
$grupo = $_POST['g1'];
$musculo = $_POST['musculo'];
$resultado = $conex->insertarMuscular($musculo, $sesion, $grupo);

 echo  json_encode($resultado);
