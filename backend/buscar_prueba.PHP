
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PRUEBA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<link rel="stylesheet" href="/./atlas/vendor/bootstrap/css/bootstrap.min.css">




  
  
 
  
 
 

  </head>
  <body>
    <div class="">
      <input type="text" name="g1" id="g1" autocomplete="off">
    </div>

  </body>
</html>
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

                  });

                  </script>
