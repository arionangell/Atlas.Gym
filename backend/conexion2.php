<?php

class conexion
{
    private $user;
    private $pass;
    private $host;
    private $bd;

    public function conexion()
    {
        $this->user = 'root';
        $this->pass = 'arion5722';
        $this->host = 'localhost';
        $this->bd = 'funcional';
    }

    public function conectar()
    {
        $con = mysql_connect($this->host, $this->user, $this->pass);
        mysql_select_db($this->bd, $con);

        return $con;
    }

    public function stablas($grupo, $sesion)
    {
        $s = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'" and t1.sesion="'.$sesion.'"';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = array(sesion => $fila['sesion'],
                                 nombre => $fila['nombre'],
                                 musculos => $fila['musculo'],
            );
            }
        }

        return $data;
    }

    //actualizar
    public function gtablas($grupo, $sesion)
    {
        $s = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'"';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        $s2 = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'" and t1.sesion="'.$sesion.'"';
        $i2 = mysql_query($s2);
        $coincidencias2 = mysql_num_rows($i2);

        if (!$sesion) {
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $data1 = array(
                musculos => $fila['musculo'],
                sesion => $fila['sesion'],
                nombre => $fila['nombre'],
            );
                }
            }

            $data2 = array(
                musculos => 'NA',
                sesion => 'NA',
                nombre => 'NA',
                     );
        } else {
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $data1 = array(
                musculos => $fila['musculo'],
                sesion => $fila['sesion'],
                nombre => $fila['nombre'],
            );
                }
            }

            if ($coincidencias2 > 0) {
                while ($fila2 = mysql_fetch_assoc($i2)) {
                    $data2 = array(
                musculos => $fila2['musculo'],
                sesion => $fila2['sesion'],
                nombre => $fila2['nombre'],
            );
                }
            }
        }

        $data[] = array('tablageneral' => $data1,
                        'tablasesion' => $data2, );

        return $data;
    }

    //insertar

    public function insertarGrupo($grupo)
    {
        $s = "INSERT INTO grupos(nombre)VALUE( '".$grupo."')";
        $i = mysql_query($s);

        return $i;
    }

    public function insertarMuscular($musculo, $sesion, $grupo)
    {
        $b = "select * from  grupos where nombre='".$grupo."'";
        $i = mysql_query($b);
        $coincidencias = mysql_num_rows($i);
        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $id_grupo = $fila['id_grupos'];
            }
        } else {
            $g = "INSERT INTO grupos(nombre)value('".$grupo."')  ";
            $i = mysql_query($g);
            $s = 'select * from grupos order by id_grupos asc limit 1';
            $i = mysql_query($s);
            $coincidencias = mysql_num_rows($i);
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $id_grupo = $fila['id_grupos'];
                }
            }
        }

        $b = "select * from  muscular where musculo='".$musculo."'";
        $i = mysql_query($b);
        $coincidencias = mysql_num_rows($i);
        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $id_musculo = $fila['musculo'];
            }
        } else {
            $g = "INSERT INTO muscular(musculo)value('".$musculo."')  ";
            $i = mysql_query($g);
            $s = 'select * from muscular order by id asc limit 1';
            $i = mysql_query($s);
            $coincidencias = mysql_num_rows($i);
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $id_musculo = $fila['musculo'];
                }
            }
        }

        $s = "INSERT INTO sesion_e(sesion,id_grupos,id_muscular)VALUE( '".$sesion."','".$id_grupo."','".$id_musculo."')";
        $i = mysql_query($s);
        $s = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'"';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        $s2 = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'" and t1.sesion="'.$sesion.'"';
        $i2 = mysql_query($s2);
        $coincidencias2 = mysql_num_rows($i2);

        if (!$sesion) {
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $data1 = array(
                musculos => $fila['musculo'],
                sesion => $fila['sesion'],
                nombre => $fila['nombre'],
            );
                }
            }

            $data2 = array(
                musculos => 'NA',
                sesion => 'NA',
                nombre => 'NA',
                     );
        } else {
            if ($coincidencias > 0) {
                while ($fila = mysql_fetch_assoc($i)) {
                    $data1 = array(
                musculos => $fila['musculo'],
                sesion => $fila['sesion'],
                nombre => $fila['nombre'],
            );
                }
            }

            if ($coincidencias2 > 0) {
                while ($fila2 = mysql_fetch_assoc($i2)) {
                    $data2 = array(
                musculos => $fila2['musculo'],
                sesion => $fila2['sesion'],
                nombre => $fila2['nombre'],
            );
                }
            }
        }

        $data[] = array('tablageneral' => $data1,
                        'tablasesion' => $data2, );

        return $data;
    }

    //buscar
    public function buscargrupo()
    {
        $s = 'select*from grupos';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = $fila['nombre'];
            }
        }

        return $data;
    }

    public function buscarmusculo()
    {
        $s = 'select*from muscular';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = $fila['musculo'];
            }
        }

        return $data;
    }

    public function buscarmusculos()
    {
        $s = 'select t1.sesion, t3.nombre,t2.musculo from sesion_e  as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos ';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = array(
                  musculos => $fila['musculo'],
                sesion => $fila['sesion'],
                nombre => $fila['nombre'],
                );
            }
        }

        return $data;
    }
}

function gtablas2($grupo, $sesion)
{
}
