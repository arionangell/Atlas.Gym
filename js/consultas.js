// carga la tabla musculos sesion y grupo
(function() {
    $("#smuscular").on("submit", function(e) {
        e.preventDefault();

        var formulario = $(this);

        var dataSerializada = formulario.serialize();

        console.log(dataSerializada);

        $.ajax({
                type: "POST",
                dataType: "json",
                url: "/./atlas/backend/musculos.php",
                data: dataSerializada,
            })
            .done(function(data) {
                data.forEach(function(element) {
                    var content = "<tr><td>" + element.tablaUniversal.m1 + "</td><td>" + element.tablaUniversal.s1 + "</td><td>" + element.tablaUniversal.g1 + "</td> </tr>";
                    $("#datosmuscular").html("")
                    $("#datosmuscularS").html("");
                    var tablaUniversal = element.tablaUniversal;
                    var tablaGrupos = element.tablaGrupos;
                    tablaUniversal.forEach(function(element2) {
                        var content = "<tr><td>" + element2.m1 + "</td><td>" + element2.s1 + "</td><td>" + element2.g1 + "</td> </tr>";
                        $("#datosmuscular").append(content);
                    });
                    tablaGrupos.forEach(function(element3) {
                        var content1 = "<tr><td>" + element3.s + "</td><td>" + element3.g + "</td><td>" + element3.m + "</td> </tr>";
                        $("#datosmuscularS").append(content1);
                    });
                    // $("#datosmuscular").append(content);
                });
            });
    });
})();
//--------------------------------------------------guardar tabla ejercicos-----------------------------------------
(function() {
    $("#ejercicios").on("submit", function(e) {
      e.preventDefault();
        var formulario = $(this);
        var fecha=document.getElementById('fecha').value;
        var dataSerializada = formulario.serializeArray();
        //seperar el contenido de la data serializada para organizar envio de informmacion

        dataSerializada.forEach(function(element){
      var resp= element.name.split(".");
      if(resp[0]=="eje"){
      var id= resp[1];
      var eje= element.value;
      // insertar ejercicio fecha y id
      $.ajax({
              type: "POST",
              dataType: "json",
              url: "/./atlas/backend/ejercicioInsertar.php",
              data:{
                  id1: id,
                  ejercicio: eje,
                  fecha1:fecha
              }
          }).done(function(data){
          console.log(data);
          })
      }
      else if (resp[0]=="detalles") {

            var detalles= element.value;
            var id= resp[1];
              //actualizar los detalles
            $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/./atlas/backend/detallesActualizar.php",
                    data:{
                        id1: id,
                        detalles1: detalles,
                        fecha1:fecha
                    }
                }).done(function(data){
  console.log(data);
                })
      } else {
          console.log("fecha1");
      }
        });
        //aqui cierra el forEach de  que inserta los datos
$("#label").append("<h1>el elemento se guardo correctamente</h1>");
setTimeout(function() {
  $("#label").fadeOut(1500);
  },3000);

  var grupo=document.getElementById('grupoS').value;
  var sesion = document.getElementById('selectsesiones').value;
//verificar si existe grupo,si es asi actualiza, si no inserta la sesion y grupo  e la tabla $resultado
$.ajax({
        type: "POST",
        dataType: "json",
        url: "/./atlas/backend/estadotabla.php",
        data:{
            grupo: grupo,
            sesion: sesion}
    }).done(function(data){

console.log(data);
});
//verificar si existe grupo,si es asi actualiza, si no inserta la sesion y grupo  e la tabla $resultado final

//final de la funincional
})
})();
//--------------------------------------------------guardar tabla ejercicos-----------------------------------------
//--------------------------------------------------cargar ambas tablas-----------------------------------------
$("#g1").on('change', function() {
    var grupo = document.getElementById("g1");
    var sesion = document.getElementById('sesion');
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "/./atlas/backend/gruposmusTablas.php",
            data: {
                grupo: grupo.value,
                sesion: sesion.value
            }
        })
        .done(function(data) {
            data.forEach(function(element) {
                $("#datosmuscular").html("")
                $("#datosmuscularS").html("");
                var Universal = element.Universal;
                var Grupo = element.Grupo;
                Universal.forEach(function(element2) {
                    var content = "<tr><td>" + element2.m1 + "</td><td>" + element2.s1 + "</td><td>" + element2.g1 + "</td> </tr>";
                    $("#datosmuscular").append(content);
                });
                Grupo.forEach(function(element3) {
                    var content1 = "<tr><td>" + element3.s2 + "</td><td>" + element3.g2 + "</td><td>" + element3.m2 + "</td> </tr>";
                    $("#datosmuscularS").append(content1);
                });
            });
        });
})
//--------------------------------------------------cargar ambas tablas ejercicio-----------------
$("#selectsesiones").on('change', function() {
var grupo=document.getElementById('grupoS').value;
var sesion = document.getElementById('selectsesiones').value;
$("#tabla1").html("")
$.ajax({
        type: "POST",
        dataType: "json",
        url: "/./atlas/backend/ejercicioTabla.php",
        data: {
            grupo: grupo,
            sesion: sesion
        }
    })
    .done(function(data) {
      data.forEach(function(tabla){
            var ejetabla="";
          ejetabla+= '<tr>';
          ejetabla+= '<th >'+tabla.s2+'</th>';
          ejetabla+= '<td>'+tabla.m2+'</td>';
          ejetabla+= '<td><input type="text" id="eje.'+tabla.id2+'" name="eje.'+tabla.id2+'" placeholder="abs cortos"></input></td>';
          ejetabla+= '<td><input type="text" id="detalles.'+tabla.id2+'" name="detalles.'+tabla.id2+'" placeholder="detalles"></input></td>';
          ejetabla+= '</tr>';
            $("#tabla1").append(ejetabla);
      });
    })
});
//--------------------------------------------------cargar ambas tablas  ejercicio-----------------
$("#sesion").on('change', function() {
    var grupo = document.getElementById("g1");
    var sesion = document.getElementById('sesion');
    if (grupo.value) {
        $.ajax({
                type: "POST",
                dataType: "json",
                url: "/./atlas/backend/gruposmusTablas.php",
                data: {
                    grupo: grupo.value,
                    sesion: sesion.value
                }
            })
            .done(function(data) {
                data.forEach(function(element) {
                    $("#datosmuscular").html("")
                    $("#datosmuscularS").html("");
                    var Universal = element.Universal;
                    var Grupo = element.Grupo;
                    Universal.forEach(function(element2) {

                        var content = "<tr><td>" + element2.m1 + "</td><td>" + element2.s1 + "</td><td>" + element2.g1 + "</td> </tr>";
                        $("#datosmuscular").append(content);
                    });
                    Grupo.forEach(function(element3) {
                        var content1 = "<tr><td>" + element3.s2 + "</td><td>" + element3.g2 + "</td><td>" + element3.m2 + "</td> </tr>";
                        $("#datosmuscularS").append(content1);
                    });
                });
            });
    } else {
        console.log("no existe");
    }
});

$('#grupoS').on("change", function() {
  var nsesion="";
    var grupo = document.getElementById("grupoS");
    $("#tabla1").html("")
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "/./atlas/backend/grupoVerificar.php",
            data: { grupo: grupo.value }
        })
        .done(function(data) {
            data.forEach(function(element) {
              console.log(element.error);
                if (element.error == "true") {
                  //  console.log(grupo.value);
                    //pintar select
                    var boton = document.getElementById("selectsesiones");
                    boton.disabled=false;
                      $("#selectsesiones").html("");
                    $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "/./atlas/backend/sesionesVerificar.php",
                            data: { grupo: grupo.value }
                        })
                        .done(function(data2) {
                        data2.forEach(function(coleccion){
                        var b=  parseInt(coleccion.contador);
                          for (paso = 1; paso <= b; paso++) {
                          var selector="";
                          selector+='<option>...</option>';
                          selector+= '<option value='+ paso +'>'+paso+'</option>';
                            $("#selectsesiones").append(selector);
                          }
                        });
                        });
                    //pintar select
                }

                else {

  ///selector de sesi
                  var idsesion= parseInt(element.contador)+1;
                  var idgrupo= element.id;

///pintar tabla
//ajax consulta de siguiente sesiones
$.ajax({
        type: "POST",
        dataType: "json",
        url: "/./atlas/backend/sesionSiguiente.php",
        data: {
            grupo: idgrupo,
            sesion: idsesion
        }
    }).done(function(data3) {
////
  data3.forEach(function(tablas) {
var tabla1= tablas.tabla1
var tabla2=tablas.tabla2
//
tabla1.forEach(function(tablahoy) {

  var ejetabla="";
ejetabla+= '<tr>';
ejetabla+= '<th >'+tablahoy.sesion+'</th>';
ejetabla+= '<td>'+tablahoy.musculo+'</td>';
ejetabla+= '<td><input type="text" id="eje.'+tablahoy.id_sesion+'" name="eje.'+tablahoy.id_sesion+'" placeholder="abs cortos"></input></td>';
ejetabla+= '<td><input type="text" id="detalles.'+tablahoy.id_sesion+'" name="detalles.'+tablahoy.id_sesion+'" placeholder="detalles"></input></td>';
ejetabla+= '</tr>';
  $("#tabla1").append(ejetabla);

});

//////
tabla2.forEach(function(tablasesion) {
  var ejetabla="";
ejetabla+= '<tr>';
ejetabla+= '<th >'+tablasesion.sesion+'</th>';
ejetabla+= '<td>'+tablasesion.musculo+'</td>';
ejetabla+= '<td>'+tablasesion.ejercicio+'</td>';
ejetabla+= '<td>'+tablasesion.detalles+'</td>';
ejetabla+= '<td>'+tablasesion.fecha+'</td>';
ejetabla+= '</tr>';
  $("#tabla2").append(ejetabla);

  $("#selectsesiones").html("");
    var selector="";
  selector+= '<option value='+ tablasesion.sesion +'>'+tablasesion.sesion+'</option>';
    $("#selectsesiones").append(selector);
});
    });
});

//ajax consulta de siguiente sesiones

                }
            })

        });

});
