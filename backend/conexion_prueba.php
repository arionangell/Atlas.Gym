<?php

require 'conexion.php';
$conex = new conexion();
$conex->conectar();

$buscarUniversal = 'select t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'"';
$i = mysql_query($buscarUniversal);
$s = mysql_num_rows($i);
if ($s > 0) {
    while ($filau = mysql_fetch_assoc($i)) {
        $data1[] = array(
        s1 => $filau['sesion'],
        m1 => $filau['musculo'],
        g1 => $filau['nombre'],
    );
    }
}
$buscarGrupo = 'select t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t1.sesion="'.$sesion.'"and t3.nombre="'.$grupo.'" ';
$i2 = mysql_query($buscarGrupo);
$s2 = mysql_num_rows($i2);
if ($s2 > 0) {
    while ($fila2 = mysql_fetch_assoc($i2)) {
        $data2[] = array(
        s2 => $fila2['sesion'],
        m2 => $fila2['musculo'],
        g2 => $fila2['nombre'],
    );
    }
} else {
    $data2 = 'n/a';
}

$data[] = array('Universal' => $data1,
                'Grupo' => $data2,
);

echo json_encode($data);
