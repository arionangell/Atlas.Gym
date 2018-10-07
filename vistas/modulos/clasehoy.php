<?php  include 'head.php';

?>
<body>
  <div id="fechab" name="fechab">

  </div>

  <table class="table table-striped table-danger" data-spy="scroll" id="tabla1">
    <thead class='bg-dark'>
      <tr>
        <th>SESION</th>
        <th>MUSCULO</th>
        <th>EJERCICIO</th>
        <th>OBSERVACION</th>
        <th>FECHA</th>
      </tr>
    </thead>
    <tbody id="datostabla" name="datostabla" >


    </tbody>
    <tfoot class='bg-dark'>
  <tr>
    <th>SESION</th>
    <th>MUSCULO</th>
    <th>EJERCICIO</th>
    <th>OBSERVACION</th>
    <th>FECHA</th>
  </tr>
  </tfoot>
  </table>

</body>
<?php  include '/java.php'; ?>


<script >
$( document ).ready(function() {

  var hoy = new Date();
var  dia = hoy.getDate();
  var mes = hoy.getMonth () + 1;
  var anio= hoy.getFullYear();
var   fecha_actual = String(anio+"/"+mes+"/"+dia);
console.log(fecha_actual);
$.ajax({
        type: "POST",
        dataType: "json",
        url: "/./atlas/backend/tablahoy.php",
        data: { fecha: fecha_actual}
    })
    .done(function(data) {
        data.forEach(function(tabla){
console.log(tabla.error);
    if(tabla.error=="true"){

var sfecha='<input type="date" class="form-control" id="fecha1" name="fecha1"  onchange="fecha1(event)">';
      $("#fechab").append(sfecha);
    }
    else{
      var ejetabla="";
    ejetabla+= '<tr>';
    ejetabla+= '<th >'+tabla.sesion+'</th>';
    ejetabla+= '<td>'+tabla.musculo+'</td>';
    ejetabla+= '<td>'+tabla.ejercicio+'</td>';
    ejetabla+= '<td>'+tabla.detalles+'</td>';
    ejetabla+= '<td>'+tabla.fecha+'</td>';
    ejetabla+= '</tr>';
      $("#datostabla").append(ejetabla);


    }

        })
    })
})


</script>
<script type="text/javascript">
function fecha1(e){
var fecha_actual = document.getElementById("fecha1").value;

console.log(fecha_actual);
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "/./atlas/backend/tablahoy.php",
            data: { fecha: fecha_actual}
        })
          .done(function(data) {
            console.log(data);
  data.forEach(function(tabla){

    var ejetabla="";
  ejetabla+= '<tr>';
  ejetabla+= '<th >'+tabla.sesion+'</th>';
  ejetabla+= '<td>'+tabla.musculo+'</td>';
  ejetabla+= '<td>'+tabla.ejercicio+'</td>';
  ejetabla+= '<td>'+tabla.detalles+'</td>';
  ejetabla+= '<td>'+tabla.fecha+'</td>';
  ejetabla+= '</tr>';
    $("#datostabla").append(ejetabla);


  })


          })

  }
</script>
