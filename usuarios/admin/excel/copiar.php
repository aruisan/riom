<!-- CREADO POR GAMMAFP PARA HEROES DE LA WEB -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Español</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            margin-top: 200px;
            background-color: #34495e;
        }
    
    </style>
</head>
<body>
    <a href="javascript:copy1(1);" id="a1">
        Copiame
    </a>
    <br>
    <br>
    <td><label id="la1">buenisima</label></td>
    <input type="text" placeholder="pruebame, presiona CTL+V">

    <a href="javascript:copy2(1);" id="b1">
        Copiame
    </a>
    <br>
    <br>
    <td><label id="lb1">tambien</label></td>
    <input type="text" placeholder="pruebame, presiona CTL+V">

    <script>
        //Inicio del boton de copia
        function copy1(id){   // Acá se pone a escucha el evento click para el boton antes definido
          
     
        
      
          var v1 =  $("#la1").text();
        $("body").append("<input type='text' id='tempa'>"); // Acá se crea un input dinamicamente con un id para luego asignarle un valor sombreado
        $("#tempa").val(v1).select(); // Acá se obtiene el id del boton que hemos creado antes y se le agrega un valor y luego se le sombrea con select(). Para agregar lo que se quiere copiar editas val("EDITAESTOAQUÍ")
        document.execCommand("copy"); // document.execCommand("copy") manda a copiar el texto seleccionado en el documento
        $("#tempa").remove();
   };

      function copy2(id){   // Acá se pone a escucha el evento click para el boton antes definido
          
     
        
      
          var v2 =  $("#lb"+id).text();
        $("body").append("<input type='text' id='tempb'>"); // Acá se crea un input dinamicamente con un id para luego asignarle un valor sombreado
        $("#tempb").val(v2).select(); // Acá se obtiene el id del boton que hemos creado antes y se le agrega un valor y luego se le sombrea con select(). Para agregar lo que se quiere copiar editas val("EDITAESTOAQUÍ")
        document.execCommand("copy"); // document.execCommand("copy") manda a copiar el texto seleccionado en el documento
        $("#tempb").remove();
   };
  
    </script>
</body>
</html>