<?php
require '/../../backend/conexion.php';
include 'head.php';

$conex = new conexion();
$conex->conectar();
?>
<?php  include 'nav.php'; ?>
<link rel="stylesheet" href="/./atlas/css/tablagruposgeneral.css">
<div class="container">
  <div  class="col-lg-12 col-xl-12 col-sm-12 ">


<div class="row">
  <form id="smuscular" name="smuscular">
  <br>
          <div class="col-lg-12 col-xl-12 col-sm-12 ">
          <h4>Crear Grupo</h4>
          <br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label>Sesion</label>
                <input type="number"name="sesion" class="form-control" id="sesion">
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
                <label>Grupo</label>
                <input type="text" name="g1" id="g1" autocomplete="off" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" >

              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <label >Musculo</label>
              <input type="text" class="form-control" id="musculo" name="musculo"  autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();">
            </div>
        </div>
  <br>
      <div ><button type="submit" class="btn btn-success">Crear </button></div>
      <br>
  </form>
</div>
<div class="col-lg-6 col-xl-6 col-sm-12" >
<br>
<table class="table table-striped table-sm table table-bordered table-dark" data-spy="scroll" id="tablamuscularS">
  <thead class="thead-dark">
    <tr>
       <th aling="center">SESION</th>
      <th  aling="center">GRUPO</th>
      <th  aling="center">MUSCULO</th>
    </tr>
  </thead>
  <tbody id="datosmuscularS" name="datosmuscularS" >
  </tbody>
  <tfoot>
<tr>
  <th>SESION</th>
 <th>GRUPO</th>
 <th>MUSCULO</th>
</tr>
</tfoot>
</table>
</div>
          <div class="col-lg-3 col-xl-3 col-sm-12" id="tgrupos">
<br>
                  <table class="table  table-sm" data-spy="scroll" id="tablamuscularc">
                    <thead class='bg-info'>
                      <tr>
                         <th>MUSCULO</th>
                        <th>SESION</th>
                        <th>GRUPO</th>
                      </tr>
                    </thead>
                    <tbody id="datosmuscular" name="datosmuscular" >
                    </tbody>
                    <tfoot class='bg-info'>
              <tr>
                <th>MUSCULO</th>
               <th>SESION</th>
               <th>GRUPO</th>
              </tr>
          </tfoot>
                  </table>
                </div>
</div>







</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {

   $.ajax({
          type: "POST",
          dataType: "json",
          url: "/./atlas/backend/musculoBuscar.php",
      })
.done(function(data){
data.forEach(function(element) {
  var content = "<tr><td>"+element.musculos+"</td><td>"+element.sesion+"</td><td>"+element.nombre+"</td> </tr>";

      $("#datosmuscular").append(content);



});

});

 });

 </script>
 <script type="text/JavaScript">
                  $(document).ready(function(){

                  $('#g1').typeahead({
                  source: function(query, result)
                  {
                  $.ajax({
                  url:"/./atlas/backend/grupoBuscar.php",
                  method:"POST",
                  data:{query:query},
                  dataType:"json",
                  success:function(data)
                  {
                  result($.map(data, function(item){
                  return item;


                  }));
                  }
                  })
                  }
                  });

                  $('#musculo').typeahead({
                  source: function(query, result)
                  {
                  $.ajax({
                  url:"/./atlas/backend/musculosBuscar.php",
                  method:"POST",
                  data:{query:query},
                  dataType:"json",
                  success:function(data)
                  {
                  result($.map(data, function(item){
                  return item;



                  }));
                  }
                  })
                  }
                  });
                  });

                  </script>








<script src="/./atlas/js/consultas.js"></script>
