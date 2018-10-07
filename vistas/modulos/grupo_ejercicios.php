<?php  include 'head.php'; ?>
<?php  include 'nav.php'; ?>
<br><br>
<form id="grupoEjercicio" name="grupoEjercicio">
<br>
<div class="container">
<div class="row">
<div class="col-lg-6 col-xl-6 col-sm-12">
<h4> Grupo de Trabajo</h4>



                <select id="grupoS" name="grupoS" class="form-control form-control-sm">
                <option selected>....</option>
                </select>


</div>

<div class="col-lg-6 col-xl-6 col-sm-12" id="selector" name="selector">
  <h4> Sesiones</h4>
  <select id="selectsesiones"name="selectsesiones" class="form-control form-control-sm" disabled>

  </select>
</div>

</div>




      </form>
      <center>
        <br><br>

<FORM method=GET action="http://www.youtube.com/results" target="_blank" >
<INPUT TYPE=text name="q" size="40" maxlength="255" class="col-lg-6 col-xl-6 col-sm-8">
<INPUT TYPE=hidden name=hl value=es>
<INPUT type=submit name=btnG VALUE="Buscar" type="submit" class="btn btn-success" >
</FORM>
</center>
<!--primer head-->
<form  id="ejercicios" name="ejercicios">


          <div class="row">
            <div class="col-lg-7">
              <div class="card">
                <div class="card-header">
                  <h4>Preparar Sesion de Hoy</h4>
                  <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-dark">
                      <thead>
                        <tr>
                          <th>SESION</th>
                          <th>MUSCULO</th>
                          <th>EJERCICIO</th>
                          <th>OBSERVACION</th>

                        </tr>
                      </thead>
                      <tbody id="tabla1" name="tabla1">


                      </tbody>
                    </table>
                  </div>

                </div>
 <div ><button type="submit" class="btn btn-danger">GUARDAR</button></div>
 <div id="label" name="label">

 </div>
              </div>
</form>

          </div>
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header">
                <h4>SESION ANTERIOR</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-dark">
                    <thead>
                    <tr>
                          <th>SESION</th>
                          <th>MUSCULO</th>
                          <th>EJERCICIO</th>
                          <th>OBSERVACION</th>
                          <th>FECHA</th>
                        </tr>
                      </thead>
                      <tbody id="tabla2" name="tabla2">

                    </tbody>
                  </table>
                </div>

              </div>

            </div>


        </div>

</div>
</div>
<script src="/./atlas/js/consultas.js"></script>

<script>

    $.ajax({
            type: "POST",
            dataType: "json",
            url: "/./atlas/backend/grupoBuscar1.php",
        })
        .done(function(data) {
            data.forEach(function(element) {
                console.log(element);

                var content = "";
                content += "<option value=" + element.id + ">" + element.nombre + "</option>";

                $("#grupoS").append(content);




            });

        });

</script>
<?php  include '/java.php'; ?>
