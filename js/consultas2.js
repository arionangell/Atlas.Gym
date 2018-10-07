// carga la tabla musculos sesion y grupo

// carga la tabla musculos sesion y grupo
(function() {

    $("#smuscular").on("submit", function(e) {
        $("#datosmuscular").html("");
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
                    $("#datosmuscular").html("");
                    $("#datosmuscularS").html("");
                    var content = "<tr><td class='bg-info'>" + element.tablageneral.musculos + "</td><td class='bg-info'>" + element.tablageneral.sesion + "</td><td class='bg-info'>" + element.tablageneral.nombre + "</td> </tr>";
                    var content1 = "<tr><td>" + element.tablasesion.sesion + "</td><td>" + element.tablasesion.nombre + "</td><td>" + element.tablasesion.musculos + "</td> </tr>";
                    $("#datosmuscular").append(content);
                    $("#datosmuscularS").append(content1);
                    console.log(element.tablageneral);
                    console.log(element.tablasesion);

                });

            });



    });
})();


//             $.ajax({
//                 data: dataSerializada,
//                 type: "POST",
//                 dataType: "json",
//                 url: "/./atlas/backend/musculos.php"
//             })




//-------------------------------------------------------------------------------------------
// listar


function destino(musculo) {
    $.ajax({
        type: 'POST',
        url: 'BuscarMusculos.php',
        data: { musculo: musculo }

    }).done(function(respuesta) {
        if (respuesta == "nada") {
            console.log("nada");
        } else {
            var resul = respuesta.split(",");
            $('#nombre').val(resul[0]);
            $('#cel').val(resul[1]);
            $('#email').val(resul[2]);
        }



    })
};
//-------------------------------------------------------------------------------------------
// listar en el  select de los musculos

$('#g1').on("click", function() {
    var c = document.smuscular.g1.length
    console.log(c);



    $.ajax({
            type: "POST",
            dataType: "json",
            url: "/./atlas/backend/grupoBuscar.php",
        })
        .done(
            function(data) {

                data.forEach(function(element) {
                    console.log(element);

                    var content = "<option value=" + element.id_grupos + ">" + element.nombre + "</option>";
                    if (c == "1") {
                        $("#g1").append(content);

                    }


                });

                data.forEach(function(grupo, index) {
                    var content = "";
                    conten += " <option value=" + grupo.grupos_id + ">" + grupo.nombre + "</option>"
                    $("#g1").append(content);
                });

            })

    .fail(
        function() {
            console.log("problema");
        })

});

// typeahead grupos




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
                $("#datosmuscular").html("");
                $("#datosmuscularS").html("");
                var content = "<tr><td class='bg-info'>" + element.tablageneral.musculos + "</td><td class='bg-info'>" + element.tablageneral.sesion + "</td><td class='bg-info'>" + element.tablageneral.nombre + "</td> </tr>";
                var content1 = "<tr><td>" + element.tablasesion.sesion + "</td><td>" + element.tablasesion.nombre + "</td><td>" + element.tablasesion.musculos + "</td> </tr>";
                $("#datosmuscular").append(content);
                $("#datosmuscularS").append(content1);
                console.log(element.tablageneral);
                console.log(element.tablasesion);

            });

        });

});

$("#sesion").on('change', function() {
    var grupo = document.getElementById("g1").value;
    var sesion = document.getElementById('sesion');


    if (grupo) {
        $.ajax({
                type: "POST",
                dataType: "json",
                url: "/./atlas/backend/sesionTabla.php",
                data: {
                    grupo: grupo.value,
                    sesion: sesion.value
                }
            })
            .done(function(data) {
                data.forEach(function(element) {

                    $("#datosmuscularS").html("");

                    var content1 = "<tr><td>" + element.sesion + "</td><td>" + element.nombre + "</td><td>" + element.musculos + "</td> </tr>";
                    $("#datosmuscularS").append(content1);
                    console.log(element.sesion);


                });

            });


    }
});
//     $.ajax({
//         type: 'POST',
//         url: '/./atlas/backend/gruposmusTablas.php',
//         data: {
//             grupo: grupo.value,
//             sesion: sesion.value
//         }

//     }).done(function(data) {
//         data.forEach(function(element) {


//         });

//     });

// });