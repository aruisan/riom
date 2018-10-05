$(document).ready(function (){
  $("#ffnac").change(function(){

       $("#edad").html("<p class='loading'><img src='loading.gif'/><br>Cargando..</p>");

        var url = "php/fecha.php"; // El script a dónde se realizará la petición.
        var fecha=$("#ffnac").val();
    $.ajax({

           type: "POST",

           url: url,

           data:{ffnac:fecha},  // Adjuntar los campos del formulario enviado.

           success: function(data)

           {

               $("#edad").html(data); // Mostrar la respuestas del script PHP.

           }

  
   });
            //LimpiarCampos();

 

    return false; // Evitar ejecutar el submit del formulario.



        });

//_______________________________para que lo envie cada vez que se cambie___________________________________


 $("#ffnac2").change(function(){

       $("#edad").html("<p class='loading'><img src='../loading.gif'/><br>Cargando..</p>");

        var url = "fecha.php"; // El script a dónde se realizará la petición.
        var fecha=$("#ffnac2").val();
    $.ajax({

           type: "POST",

           url: url,

           data:{ffnac:fecha},  // Adjuntar los campos del formulario enviado.

           success: function(data)

           {

               $("#edad").html(data); // Mostrar la respuestas del script PHP.

           }

  
   });
            //LimpiarCampos();

 

    return false; // Evitar ejecutar el submit del formulario.



        });


  });