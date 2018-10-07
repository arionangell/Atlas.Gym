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

///insertar ejericio
///insertar ejericio
  public function ejercicioinsertar($id, $ejercicio,$fecha)
  {
      $s = 'select*from ejercicios where  id_sesion_e ="'.$id.'" and fecha="'.$fecha.'"';
      $i = mysql_query($s);
      $coincidencias = mysql_num_rows($i);

      if ($coincidencias > 0) {
        //actualice
        $s2='update ejercicios set nombre_eje="'.$ejercicio.'" where fecha="'.$fecha.'" and id_sesion_e="'.$id.'"';
        $i2 = mysql_query($s2);
        $data[]= array(error =>'false' ,
                      respuesta  =>'los datos fueron actualizados',
         );
          }

      else{
$s2='insert into ejercicios (nombre_eje,id_sesion_e,fecha)values("'.$ejercicio.'","'.$id.'","'.$fecha.'")';
        $i2 = mysql_query($s2);
        $data[]= array(error =>'false' ,
                      respuesta  =>'los datos fueron guardados',
         );
                }

      return $data;
  }


///insertar ejericio
  /// detalles actualizar
  public function detallesactualizar($id, $detalles,$fecha)
  {
          //actualice
          $s2='update ejercicios set comentario="'.$detalles.'" where  id_sesion_e="'.$id.'" and fecha="'.$fecha.'"';
          $i2 = mysql_query($s2);
          $data[]= array(error =>'false' ,
                        detalles  => $detalles,
                        id  => $id,
                        fecha => $fecha,
);
        return $data;

  }
  public function tablahoy($fecha)
  {
          //actualice
          $s2='select * from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join ejercicios as t3 on t1.id_sesion=t3.id_sesion_e where t3.fecha="'.$fecha.'"';
          $i2 = mysql_query($s2);
          $coincidencias = mysql_num_rows($i2);

          if ($coincidencias > 0) {
              while ($fila = mysql_fetch_assoc($i2)) {

              $data[]= array(
                error => "false",
                id_sesion => $fila['id_sesion'],
                musculo => $fila['musculo'],
                sesion => $fila['sesion'],
                ejercicio => $fila['nombre_eje'],
                detalles => $fila['comentario'],
                fecha => $fila['fecha'],

              );

              }
          }
else{
  $data[]= array(
    error => "true");

}
              return $data;

  }

/// detalles actualizar
  ///insertar ejericio
    /// detalles actualizar
    public function sesionsiguiente($idgrupo,$sesion)
    {
            //verdicar si la ultima sesion es menor que la  d
            $s2='select * from sesion_e where id_grupos="'.$idgrupo.'" order by sesion desc limit 1';
            $i2 = mysql_query($s2);
            $coincidencias = mysql_num_rows($i2);
              while ($fila = mysql_fetch_assoc($i2)) {
              $ultimasesion=  $fila['sesion'];
              }

  if($ultimasesion>=$sesion){
  //tabla 1 si la sesion es menor al numero de sesiones
  $t1='select t1.id_sesion,t1.sesion, t2.musculo from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id where t1.sesion="'.$sesion.'" and t1.id_grupos="'.$idgrupo.'"';
  $r1 = mysql_query($t1);
  while ($fila = mysql_fetch_assoc($r1)) {
    $data1[]=array(
      id_sesion => $fila['id_sesion'],
      sesion => $fila['sesion'],
       musculo => $fila['musculo']
    );
  }
  //tabla 2 si la sesion es menor al numero de sesiones
  $t2='select * from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join ejercicios as t3 on t1.id_sesion=t3.id_sesion_e where t1.sesion="'.$sesion.'" and t1.id_grupos= "'.$idgrupo.'"  limit 8';
  $r2 = mysql_query($t2);
  $coincidencias = mysql_num_rows($r2);

  if ($coincidencias > 0) {
  while ($fila2 = mysql_fetch_assoc($r2)) {
    $data2[]=array(
      id_sesion => $fila2['id_sesion'],
      musculo => $fila2['musculo'],
      sesion => $fila2['sesion'],
      ejercicio => $fila2['nombre_eje'],
      detalles => $fila2['comentario'],
      fecha => $fila2['fecha'],
        );
  }
  }
  else{
    $data2[]=array(
      id_sesion => "n/a",
      musculo =>  "n/a",
      sesion =>  $sesion,
      ejercicio => "n/a",
      detalles =>  "n/a",
      fecha =>  "n/a",
        );
  }
  }
  else{
    $sesion=1;
    $t1='select t1.id_sesion,t1.sesion, t2.musculo from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id where t1.sesion="'.$sesion.'" and t1.id_grupos="'.$idgrupo.'"';
    $r1 = mysql_query($t1);
    while ($fila = mysql_fetch_assoc($r1)) {
      $data1[]=array(
        id_sesion => $fila['id_sesion'],
        sesion => $fila['sesion'],
         musculo => $fila['musculo']
      );
    }
    //tabla 2 si la sesion es menor al numero de sesiones
    $t2='select * from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join ejercicios as t3 on t1.id_sesion=t3.id_sesion_e where t1.sesion="'.$sesion.'" and t1.id_grupos= "'.$idgrupo.'"  limit 8';
    $r2 = mysql_query($t2);
    $coincidencias = mysql_num_rows($r2);

    if ($coincidencias > 0) {
    while ($fila2 = mysql_fetch_assoc($r2)) {
      $data2[]=array(
        id_sesion => $fila2['id_sesion'],
        musculo => $fila2['musculo'],
        sesion => $fila2['sesion'],
        ejercicio => $fila2['nombre_eje'],
        detalles => $fila2['comentario'],
        fecha => $fila2['fecha'],
          );
          }
    }
    else{
      $data2[]=array(
        id_sesion => "n/a",
        musculo =>  "n/a",
        sesion =>  $sesion,
        ejercicio => "n/a",
        detalles =>  "n/a",
        fecha =>  "n/a",
          );
    }

  }
  $data[]=array(

    tabla1 =>$data1 ,
    tabla2 =>$data2
  );
  return $data;

    }






  /// detalles actualizar
    ///verificar grupo
    public function grupoVerificar($id)
    {
        $s = 'select*from estado where id_grupo="'.$id.'"';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = array(
                    error => 'false',
                   contador => $fila['contador'],
                   id => $fila['id_grupo'],
                             );
            }
        } else {
            $data[] = array(
                 error => 'true',
                 des => 'Elemento no existe en la tabla',
             );
        }

        return $data;
    }

    ///verificar grupo

    ///verificar grupo
    public function sesionesVerificar($id)
    {
        $s = 'select * from sesion_e where id_grupos="'.$id.'" order by sesion desc limit 1';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = array(
                 error => 'false',
                contador => $fila['sesion'],
                id => $fila['id_grupos'],
                          );
            }
        } else {
            $data[] = array(
              error => 'true',
              des => 'Elemento no existe ',
          );
        }

        return $data;
    }

    public function buscargrupo1()
    {
        $s = 'select*from grupos';
        $i = mysql_query($s);
        $coincidencias = mysql_num_rows($i);

        if ($coincidencias > 0) {
            while ($fila = mysql_fetch_assoc($i)) {
                $data[] = array(
                   id => $fila['id_grupos'],
                    nombre => $fila['nombre'],
                );
            }
        }

        return $data;
    }
    public function estadotabla($grupo, $sesion)
    {
      $s = 'select * from estado where id_grupo="'.$grupo.'"';
      $i = mysql_query($s);
      $coincidencias = mysql_num_rows($i);

      if ($coincidencias > 0) {

        $s2 = 'update estado set contador="'.$sesion.'" where id_grupo="'.$grupo.'"';
        $i2 = mysql_query($s2);
        $data[]= array(
          error => "false",
          comentario => "se actualizo correctamente los datos en tabla estado"
      );
      }
      else{
        $s2 = 'insert into estado (id_grupo,contador)values("'.$grupo.'","'.$sesion.'")';
        $i2 = mysql_query($s2);
        $data[]= array(
          error => "false",
          comentario => "se inserto correctamente los datos en tabla estado"
      );
      }

return $data;
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
    public function ejetablas($grupo, $sesion)
    {

      $buscarGrupo = 'select t1.id_sesion,t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t1.sesion="'.$sesion.'"and t1.id_grupos="'.$grupo.'" ';
      $i2 = mysql_query($buscarGrupo);
      $s2 = mysql_num_rows($i2);
      if ($s2 > 0) {
          while ($fila2 = mysql_fetch_assoc($i2)) {
              $data[] = array(
      s2 => $fila2['sesion'],
      m2 => $fila2['musculo'],
      g2 => $fila2['nombre'],
      id2 => $fila2['id_sesion']
    );
          }
      }
  return $data;
    }
    //actualizar
    public function gtablas($grupo, $sesion)
    {
        $buscarUniversal = 'select t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t3.nombre="'.$grupo.'" ORDER BY t1.sesion asc';
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

        return $data;
    }

    //insertar
    public function insertarMuscular($musculo, $sesion, $grupo)
    {
        ///insertar grupo,musculo, sesion

        ///buscar grupo
        $buscarg = "select * from  grupos where nombre='".$grupo."'";

        ///buscar musculo
        $buscarm = "select * from  muscular where musculo='".$musculo."'";

        //querys
        $b1 = mysql_query($buscarg);
        $b2 = mysql_query($buscarm);

        //existe el grupo
        $coincidenciasg = mysql_num_rows($b1);
        if ($coincidenciasg > 0) {
            while ($fila1 = mysql_fetch_assoc($b1)) {
                $id_grupo = $fila1['id_grupos'];
            }
        } else {
            $insertg = "insert into grupos(nombre)value('".$grupo."')";
            $i1 = mysql_query($insertg);
            $buscarg2 = "select * from  grupos where nombre='".$grupo."'";
            $bg2 = mysql_query($buscarg2);
            $coincidenciasg2 = mysql_num_rows($bg2);
            if ($coincidenciasg2 > 0) {
                while ($fila1 = mysql_fetch_assoc($bg2)) {
                    $id_grupo = $fila1['id_grupos'];
                }
            }
        }
        //existe el musculo
        $coincidenciasm = mysql_num_rows($b2);
        if ($coincidenciasm > 0) {
            while ($fila2 = mysql_fetch_assoc($b2)) {
                $id_musculo = $fila2['id'];
            }
        } else {
            $insertm = "insert into muscular(musculo)value('".$musculo."')";
            $i2 = mysql_query($insertm);
            $buscarm2 = "select * from  muscular where musculo='".$musculo."'";
            $bm2 = mysql_query($buscarm2);
            $coincidenciasm2 = mysql_num_rows($bm2);
            if ($coincidenciasm2 > 0) {
                while ($fila2 = mysql_fetch_assoc($bm2)) {
                    $id_musculo = $fila2['id'];
                }
            }
        }
        //insercion de la sesion despues de verificar
        $inserts = "INSERT INTO sesion_e(sesion,id_grupos,id_muscular)VALUE( '".$sesion."','".$id_grupo."','".$id_musculo."')";
        $i3 = mysql_query($inserts);
        //connsulta tabla sesion universal
        $buscaru = 'select t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos';
        $bu = mysql_query($buscaru);
        $coincidenciasu = mysql_num_rows($bu);

        if ($coincidenciasu > 0) {
            while ($filau = mysql_fetch_assoc($bu)) {
                $data1[] = array(
                s1 => $filau['sesion'],
                m1 => $filau['musculo'],
                g1 => $filau['nombre'],
            );
            }
        }
        //connsulta tabla sesion grupo
        $buscarug = 'select t1.sesion,t2.musculo,t3.nombre from sesion_e as t1 inner join muscular as t2 on t1.id_muscular=t2.id inner join grupos as t3 on t1.id_grupos=t3.id_grupos where t1.sesion="'.$sesion.'"and t3.nombre="'.$grupo.'" ';
        $bug = mysql_query($buscarug);
        $coincidenciasug = mysql_num_rows($bug);

        if ($coincidenciasug > 0) {
            while ($filaug = mysql_fetch_assoc($bug)) {
                $data2[] = array(
                s => $filaug['sesion'],
                m => $filaug['musculo'],
                g => $filaug['nombre'],
            );
            }
        }
        $data[] = array(tablaUniversal => $data1,
                        tablaGrupos => $data2,
    );

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
