
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../error1.php");
}
include('../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();

if($reg->tipo==2){
$url_logo="../../cp/";


date_default_timezone_set('America/Bogota'); 
$fecha =  date('Y-m-d');
$sql="SELECT servicio.*, examen.nom_examen, dr.nom_doctor, cita.ff, paciente.*, usuario.nick 
      FROM servicio,examen,dr, cita, paciente,usuario WHERE servicio.examen=examen.id_examen 
      AND servicio.doctor=dr.id_doctor AND servicio.servicio_cita=cita.id_cita AND cita.cita_paciente=paciente.id_paciente 
      AND cita.responsable=usuario.id_usuario AND ff='$fecha' ";
$consulta = $enlace->query($sql);


?>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Recepcion - Servicios</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<meta http-equiv="refresh" content="180" />
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

  <?php require_once('cuerpo/form_ingresar.php'); ?>

      <div id="cuadro-tabla" class="row col-md-10 tabla col-sm-6 col-xs-4">
        <button id="mostrar" class="btn-success glyphicon glyphicon-paste botoncito-redondeado"></button>
        <div class="input-group  botones">
          <input type="text" value="<?= $fecha; ?>" id="year" class="calendario form-control alert calendario alert alert-danger">
          <div class="input-group-btn ">
            <div class="btn-group-lg">
              <a type="button" title="Inicio" href="index.php" class="btn  btn-success glyphicon glyphicon-user"></a>
              <a type="button" title="Citas" href="usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
              <a type="button" title="Servicios" href="#" class="btn glyphicon glyphicon glyphicon-th-list active"></a>  
              <a type="button" title="Doctores" href="tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="iconos/dr.png"></center></a> 
              <a type="button" title="Examenes" href="tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="iconos/exa.png"></center></a>
            </div>
          </div>
        </div>
      </div>

<!-- tabla y botoncito-->

      <div class="row" id="cuadro-citas">
         <?php require('cuerpo/tabla_cuentas.php'); ?>
      </div>
  </div>



<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>
<script src="../../cp/jquery.dataTables.min.js"></script>
<script src="../../cp/dataTables.responsive.min.js"></script>
<script src="../../cp/dataTables.bootstrap.min.js"></script>
<script src="../../cp/bootstrap-datepicker.js"></script>
<script src="../../cp/bootstrap-datepicker.es.min.js"></script>
       
<script type="text/javascript">
    $(document).ready(function(){
        calendario();

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } ); 

        $("#mostrar").hover(function(){
            $('#target').show(3000);
            $('.target').show("slow");
         });  

        $("#ocultar").hover(function(){
            $('#target').hide(4000);
            $('.target').hide("slow");

          });

        $(".ocultar").hover(function(){
            $('.target').hide("slow");
        });

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

       
//----------------------------

$('#year').change(function(){
  tabla_inicial();
  });
//-------------------------final



  });
//----------------------------
function tabla_inicial(){
  var url = "tabla_cuenta.php";
  var year = $("#year").val();
  $.ajax
  ({
    type: "POST",
    url: url,
    data: {year:year}, // Adjuntar los campos del formulario enviado.
    success: function(data)
    {
      console.log(data);
      $("#cuadro-citas").html(data);
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
 function enviar(id){
            var url = "php/enviar.php"; // El script a dónde se realizará la petición.
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
             var datos = eval(data);
               $("#carta"+id).attr("src","iconos/"+datos[0]);
           }

  
   });
          

 

    return false; // Evitar ejecutar el submit del formulario.

};

//-------------------------

</script>
</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>