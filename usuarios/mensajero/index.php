


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

//$_SESSION['cc']=$reg->id_datos;

if($reg->tipo==4){
   $url_logo="../../cp/";

$sql_ffhh_actual = "SELECT curdate() as fecha";
$ffhh_actual = $enlace->query($sql_ffhh_actual);
$ff= $ffhh_actual->fetch_object();
$fecha = $ff->fecha
?>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Validar un formulario</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../../cp/bootstrap-datepicker.css" rel="stylesheet">
<style type="text/css">
body{
    background:#f8f8f8;}

#repetir_servicios
{  
display:none;
 width: 530px;
    margin-left:350px;
    margin-top: 200px;
    position: absolute;
    z-index: 1;
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.4) 8px 8px 2px 0px;
    padding:15px;
background: rgba(254,254,254,1);
background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );

  }

.botones{  width: 140px;
             position: fixed; z-index: 1;
             left:800px; top: 85px;}
.botones input{
    padding: 22px; 
}

#repetir_servicios td{background: white;

}
#repetir_servicios td:hover {background:rgba(190,228,180,0.50);

}
.edad{
  font-family: 'Oxygen', sans-serif;
  font-size: 1,5em;
  font: bold;
}
#form{
border-radius: 10px;
box-shadow: rgba(0, 0, 0, 0.6) 8px 8px 2px 0px;
padding:15px;
margin-top: 30px;
margin-bottom: 30px;
background: rgba(254,254,254,1);
background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );
}
#tabla{
    color: black;
}
.tabla{
    margin: 30px;
}
.items{
    background: rgba(235,233,249,1);
background: -moz-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(235,233,249,1)), color-stop(8%, rgba(216,208,239,1)), color-stop(51%, rgba(206,199,236,1)), color-stop(100%, rgba(193,191,234,1)));
background: -webkit-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
background: -o-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
background: -ms-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
background: linear-gradient(to right, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebe9f9', endColorstr='#c1bfea', GradientType=1 );
}
.lineas{border: 1px solid red}
.boton-redondeado {
    
    }

#cuadro-tabla{position:absolute; z-index:0;}
.target{display:none; position:absolute; z-index:2; }
th{background: #3399ff}
tr{height:10px;}
</style>
</head>

<body>

<div class="container">
<header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
  


        <div></div>

       <ul class="navbar-nav nav">
         <li ><a href="php/editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../index.php' method='POST'>
                  <a href="#" class="navbar-brand">
                    <center><button id='salir' name='salir' class="btn btn-link" value='1' >
                    <span class="glyphicon glyphicon-remove"></span> </button></center></a></form>
               ></li>
    

      </ul>

</div>
<center>
<?php require($url_logo.'nombre.php'); ?>
</center>

</nav></header>

<div class="container-fluid row">
<ol class="breadcrumb">
  <li>Radiologia</a></li>
</ol>
</div>
<div class="row">
<div class="list-group col-md-12 hidden-xs " >
<div id="repetir_servicios"></div>



<div id="cuadro-tabla" class="row col-md-10 tabla col-sm-6 col-xs-4">
        <div class="input-group  botones">
          <input type="text" value="<?php echo $ff->fecha; ?>" id="year" class="calendario form-control alert calendario alert alert-danger">
        </div>
    </div>







<div id="cuadro-citas" class="row col-md-12 tabla col-sm-6 col-xs-4">       
     
</div>

</div>
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
<script>
        $(document).ready(function() {
          tabla_inicial();
          calendario();

        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });

  //----------------------------

$('#year').change(function(){
  tabla_inicial();
  });
//-------------------------final
        } );
//-------------------------------
function tabla_inicial(){
  var url = "tabla.php";
  var year = $("#year").val();
  $.ajax
  ({
    type: "POST",
    url: url,
    data: {year:year}, // Adjuntar los campos del formulario enviado.
    success: function(data)
    {
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

</script>

<script type="text/javascript">
        function enviado(id){
           
             var url = 'enviar.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        var datos= eval(valores);
        $('#n'+datos[0]).removeClass("btn-danger").addClass("btn-success");
    }
  });
  return false;

         };

  //___________________________________

</script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>