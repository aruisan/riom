
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../error1.php");
}
include('../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();

if($reg->tipo==2){

    $url_logo="../../cp/";
//__________________________________________________________
date_default_timezone_set('America/Bogota'); 
$fecha =  date('Y-m-d');
$sql="SELECT paciente.*, cita.*,usuario.nick FROM paciente,cita,usuario
        WHERE paciente.id_paciente=cita.cita_paciente 
        AND usuario.id_usuario=cita.responsable AND ff='$fecha'";
$consulta = $enlace->query($sql);

?>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Recepcion - Citas</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/stilo.css">
<link href="../../cp/bootstrap-datepicker.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <!--nav principal-->
    <?php require_once('cuerpo/encabezado.php'); ?>
  <!--fin nav principal-->
  <!--contenedor migas-->
    <div class="container-fluid row">
      <ol class="breadcrumb">
        <li>Recepcion</li>
      </ol>
    </div>
  <!--fin contenedor migas-->
   <!--- formulario ingreso -->
  <?php require_once('cuerpo/form_ingresar.php'); ?>
  <!--- fin formulario ingreso -->
  <!--- botones -->
  <div id="cuadro-tabla" class="row col-md-10 tabla col-sm-6 col-xs-4">
    <button id="mostrar" class="btn-success glyphicon glyphicon-paste botoncito-redondeado"></button>
    <div class="input-group  botones">
      <input type="text" value="<?= $fecha; ?>" id="year" class="calendario form-control alert calendario alert alert-danger">
      <div class="input-group-btn ">
        <div class="btn-group-lg">
          <a type="button" title="Inicio" href="index.php" class="btn  btn-success glyphicon glyphicon-user"></a>
          <a type="button" title="Citas" href="#" class="btn  active glyphicon glyphicon-list-alt"></a>
          <a type="button" title="Servicios" href="cuentas.php" class="btn  btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
          <a type="button" title="Doctor" href="tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="iconos/dr.png"></center></a> 
          <a type="button" title="Examenes" href="tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="iconos/exa.png"></center></a> 
          <a type="button" title="Tiempos" id="abrir-tiempos" class="btn  btn-default"><center><span class="glyphicon glyphicon-dashboard"></span></center></a>
        </div>
      </div>
    </div>
  </div>
      
<!-- fin botones-->



 <!--- generador de tiempos --> 
              <div id="tiempos">
                <button tyle="button" class="close btn btn-danger ocultar">&times;</button><br>
              </div>
 <!--- fin generador de tiempos -->
  <!--- generador de cuentas -->
              <div id="cuadro-horas">
                <center>
                    <button tyle="button" class="close btn btn-danger ocultar" >&times;</button><br>
                    <input id="id_hora" type="hidden" name="id">
                    <label   class="label-control">Hora de Llegada: </label> 
                    <input name="h1" class="form-control" id="h1" type="time"><br>
                    <label   class="label-control">Hora de Atencion: </label> 
                    <input name="h2" class="form-control" id="h2" type="time"><br>
                    <label   class="label-control">Hora de Salida: </label> 
                    <input name="h3" class="form-control" id="h3" type="time"><br><br>
                    <button class="btn btn-success" id="cambiar_hora" >Cambiar</button><br>
                </center>
                <div id="valores-balance">
                </div>
              </div>

              <div id="cuadro-observacion">
                <center>
                    <button tyle="button" class="close btn btn-danger ocultar" >&times;</button><br>
                    <input id="id_obs" type="hidden" name="id">
                    <label   class="label-control" id="lid_obs"></label> 
                    <textarea id="text_obs" class="form-control" rows="3" name="obs" placeholder="escribe aqui tu observacion"></textarea><br>
                    <button class="btn btn-success" id="enviar-obs">Ingresar<br>
                </center>

                <div id="valores-balance">
                </div>
              </div>











<div class="row" id="cuadro-citas">
  <?php require_once('cuerpo/tabla_usuarios.php'); ?>
</div>

<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>
<script src="../../cp/jquery.dataTables.min.js"></script>
<script src="../../cp/dataTables.responsive.min.js"></script>
<script src="../../cp/dataTables.bootstrap.min.js"></script>
<script src="../../cp/bootstrap-datepicker.js"></script>
<script src="../../cp/bootstrap-datepicker.es.min.js"></script>
        <script>

        $(document).ready(function() {
           calendario();
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });

        });
        </script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#mostrar").hover(function(){
            $('#target').show(3000);
            $('.target').show("slow");
           
//-------------------------
         });
        $(".ocultar").hover(function(){
            $('.target').hide("slow");
            $('#cuadro-horas').hide("slow");
            $('#cuadro-observacion').hide("slow");

});
//-------------------------
$("·citas").click(function(){

         var url = "factura.php"; // El script a dónde se realizará la petición.
        var valor1=$("#id").val();
    $.ajax({

           type: "POST",

           url: url,

           data: {cita:valor1}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
                var datos = eval(data);
               $("#num2").val(datos[0]);
               $("#num").text("Fact. No. "+datos[0]);

           }

  
   });
           

 

    return false; // Evitar ejecutar el submit del formulario.


});

//__________________________________________

$('#enviar-obs').click(function(){
    var url = "php/ingresar_obs.php";
    var id = $("#id_obs").val();
    var text = $("#text_obs").val();
    $.ajax
    ({
      type: "POST",
      url: url,
      data: {id:id, text:text}, 
      success: function()
      {
       $("#cuadro-observacion").hide('low');
      }

    });
});


//__________________________________________
$('#cambiar_hora').click(function(){
    var url = "php/ingresar_hora.php";
    var id = $("#id_hora").val();
    var h1 = $("#h1").val();
    var h2 = $("#h2").val();
    var h3 = $("#h3").val();
    var year = $("#year").val();

    $.ajax
    ({
      type: "POST",
      url: url,
      data: {id:id, h1:h1, h2:h2, h3:h3, year:year}, 
      success: function(data)
      {
       $("#cuadro-citas").show("low").html(data);
      }

    });
});


//__________________________________________
$("#abrir-tiempos").click(function(){

         var url = "php/tiempos.php"; 
    $.ajax({

           type: "POST",

           url: url,

           data: "", 

           success: function(data)

           {

              $("#tiempos").show("low").html(data);


           }

  
   });
           

 

    return false; // Evitar ejecutar el submit del formulario.


});

//----------------------------

$('#year').change(function(){
  tabla_inicial();
  });
//-------------------------final
 
  });
     //_____________________
function tabla_inicial(){
  var url = "tabla_usuario.php";
  var year = $("#year").val();
  $.ajax
  ({
    type: "POST",
    url: url,
    data: {year:year}, // Adjuntar los campos del formulario enviado.
    success: function(data)
    {
      console.log(data);
      $("#cuadro-citas").show("low").html(data);
    } 
  });

}
//-----------------------
function calendario()
       {
        $.fn.datepicker.defaults.format = "yyyy/mm/dd";
         $('.calendario').datepicker({
            format: "yyyy/mm/dd",
            language: "es",
            autoclose: true
    });
                    
       }
//-----------------------

function hhsalida(id){

  var url = 'php/hhsalida.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        var datos = eval(valores);
        $('#n'+datos[0]).removeClass("glyphicon-time");
    }
  });
  return false;
}
//_________________________________________________________
function ver(id){
    var url = "php/editar_hora.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id},

        success: function(data){
          var datos = eval(data);
          $("#h1").val(datos[0]);
          $("#h2").val(datos[1]);
          $("#h3").val(datos[2]);
          $("#id_hora").val(id);
          $("#cuadro-horas").show("slow");
        }
    });
}
  //________________________
  //_________________________________________________________
function obs(id){
    var url = "php/con_obs.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {cc:id},

        success: function(data){
          var datos = eval(data);
          $("#id_obs").val(datos[0]);
          $("#text_obs").val(datos[1]);
          $('#lid_obs').text("Observacion de cita "+datos[0]);
          $("#cuadro-observacion").show("slow");
        }
    });
}
  //________________________

function fact(id){
    var url = "php/Ingresar_factura.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id},

        success: function(data){
          
          $("#factura"+id).html(data);
        }
    });
}
  //________________________





</script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>