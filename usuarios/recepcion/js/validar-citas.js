$(document).ready(function (){
  

 $("#examen").change(function(){

        var url = "precio.php"; // El script a dónde se realizará la petición.
        var examen2=$("#examen").val();
    $.ajax({
           type: "POST",

           url: url,

            data: 'examen='+examen2, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
                var datos = eval(data);
               $("#precio").val(datos[0]); // Mostrar la respuestas del script PHP.

           }

  
   });
            //LimpiarCampos();

 

    return false; // Evitar ejecutar el submit del formulario.



        });


//_______________________________ajax total___________________________________


$("#precio, #cantidad ").change(function(){

        var url = "total.php"; // El script a dónde se realizará la petición.
        var valor1=$("#cantidad").val();
        var valor2=$("#precio").val();
    $.ajax({

           type: "POST",

           url: url,

           data: {cantidad:valor1, precio:valor2}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {

               $("#total").html(data); // Mostrar la respuestas del script PHP.

           }

  
   });
           

 

    return false; // Evitar ejecutar el submit del formulario.



        });



  


//_______________________________enviar formulario___________________________
$("#enviar").click(function(){

       $("#citas").html("<p class='loading'><img src='../loading.gif'/><br>Cargando..</p>");

       var url = "ingresar_cita.php"; // El script a dónde se realizará la petición.

    $.ajax({

           type: "POST",

           url: url,

           data: $("#form1").serialize(), // Adjuntar los campos del formulario enviado.

           success: function(data)

           {

               $("#citas").html(data); // Mostrar la respuestas del script PHP.

           }

  
   });
            LimpiarCampos();

 

    return false; // Evitar ejecutar el submit del formulario.



    

 });
//___________________________

  
  //-------------------------------------
});


//_______________valor de precio por defecto_________________

$(document).ready(function (){
$("#precio").html("<p class='loading'><img src='../loading.gif'/><br>Cargando..</p>");

        var url = "precio.php"; // El script a dónde se realizará la petición.
        var examen2=$("#examen").val();
    $.ajax({
           type: "POST",

           url: url,

           data: 'examen='+examen2, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
                var datos = eval(data);
               $("#precio").val(datos[0]); // Mostrar la respuestas del script PHP.

           }

  
   });
            //LimpiarCampos();

 

    return false; // Evitar ejecutar el submit del formulario.



        });


//-------------------------------------------------------------
    /* var exprecc =/[0-9]+$/;
     var cc = document.form1.cc.value;   
    if(cc=="")
    {
        document.getElementById('error-cc').innerHTML = "Falta el # de la cedula";   
    }else if(!exprecc.test(cc)){
        document.getElementById('error-cc').innerHTML = "debe ir solo numeros";
        }else{
            document.getElementById('error-cc').innerHTML = "";
        }

//-------------------------------------------------------------
    var exprename =/^[\w]{5,8}$/i;
    var nombre = document.form1.nombre.value;   
    if(nombre=="")
    {
        document.getElementById('error-name').innerHTML = "Falta el Nombre";   
    }else if(!exprename.test(nombre)){
        document.getElementById('error-name').innerHTML = "el nombre debe tener entre 5 y 8 caracteres alfanumericos";
        }else{
            document.getElementById('error-name').innerHTML ="";
        }

//-------------------------------------------------------------
     var sexo = document.form1.sexo.value;
    if(sexo=="")
    {
        document.getElementById('error-sexo').innerHTML = "escoge el sexo";
        }else{
            document.getElementById('error-sexo').innerHTML ="";
        }


//-------------------------------------------------------------

    var expremail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var email = document.form1.email.value;
    if(email=="")
    {
        document.getElementById('error-mail').innerHTML = "Falta el E-mail";
    }else if(!expremail.test(email)){
        document.getElementById('error-mail').innerHTML = "no tiene formato de correo";
        }else{
            document.getElementById('error-mail').innerHTML ="";
        }



//-------------------------------------------------------------

    var exprepass =/^[\w]{8,12}$/i;
    var pass = document.form1.pass.value;
    if(pass=="")
    {
        document.getElementById('error-pass').innerHTML = "Falta el Passw";
    }else if(!exprepass.test(pass)){
        document.getElementById('error-pass').innerHTML = " la clave es de 8 a 12 caracteres";
        }else{ document.getElementById('error-pass').innerHTML = "";

        }

//-------------------------------------------------------------

    var expretel =/^[0-9]{7,10}$/i;
    var tel = document.form1.tel.value;
    if(tel=="")
    {
        document.getElementById('error-tel').innerHTML = "Falta el # de telefono";
    }else if(!expretel.test(tel)){
        document.getElementById('error-tel').innerHTML = "solo se admiten # de 7 y 10 caracteres";
        }else{
            document.getElementById('error-tel').innerHTML = "";
        }

//-------------------------------------------------------------

var dir = document.form1.dire.value;
    if(dir=="")
    {
        document.getElementById('error-dir').innerHTML = "Falta la direccion";
    }else{
        document.getElementById('error-dir').innerHTML = "";
        }


//-------------------------------------------------------------

    if(nombre !="" && email!="" && pass!="" && cc!="" && sexo!="" && tel!="" && dir!="" && exprecc.test(cc)
        && exprename.test(nombre) && exprepass.test(pass) && expremail.test(email) && expretel.test(tel)){*/
       


 function LimpiarCampos(){
  document.form1.doctor.value="";
  document.form1.examen.value="";
  document.form1.precio.value="";
  document.form1.cantidad.value="";
  document.form1.total.value="";
  document.form1.doctor.focus();
  document.getElementById('mensaje').innerHTML = "";
  }




/*----------------------------------fin-----------------------------------------*/
/*----------------------------------fin-----------------------------------------*/
/*----------------------------------fin-----------------------------------------*/