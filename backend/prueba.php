<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();
$grupo = $_POST['grupo'];
$conex->insertarGrupo($grupo);

// $s = "INSERT INTO grupos(nombre)VALUE( '".$grupo."')";
// $i = mysql_query($s);

$respuesta = json_encode(
        array(
            'err' => false,
            'grupo' => 'cargo correctamente el grupo '.$grupo,
        )
);

echo $respuesta;
