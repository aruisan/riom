
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

if($reg->tipo==1){
  $url_logo="../../cp/";
  //__________________________________

$sql_dr= "SELECT * FROM dr";
$consulta_dr= $enlace->query($sql_dr);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../../cp/bootstrap-datepicker.css" rel="stylesheet">
<style type="text/css">


.menu-horizontal{
 position: fixed;
}

#cuadro-editarFactura{
    margin-left: 400px;
    width: 650px;
    display:none;
     position:fixed; 
     z-index:2; 
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

#cuadro-editarServicios{
    margin-left: 250px;
    width: 800px;
    display:none;
     position:fixed; 
     z-index:2; 
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

#cuadro-reportes{
    width: 670px;
    display:none;
     position:fixed; 
     z-index:2; 
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

#cuadro-credito{
    width: 270px;
    display:none;
     position:fixed; 
     z-index:2; 
    border-radius: 10px;
box-shadow: rgba(0, 0, 0, 0.6) 8px 8px 2px 0px;
padding:15px;
margin-top: 30px;
margin-bottom: 30px;
background: rgba(255,255,255,1);
background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,0.94) 74%, rgba(237,237,237,0.93) 91%, rgba(237,237,237,0.93) 92%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(74%, rgba(246,246,246,0.94)), color-stop(91%, rgba(237,237,237,0.93)), color-stop(92%, rgba(237,237,237,0.93)));
background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,0.94) 74%, rgba(237,237,237,0.93) 91%, rgba(237,237,237,0.93) 92%);
background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,0.94) 74%, rgba(237,237,237,0.93) 91%, rgba(237,237,237,0.93) 92%);
background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,0.94) 74%, rgba(237,237,237,0.93) 91%, rgba(237,237,237,0.93) 92%);
background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(246,246,246,0.94) 74%, rgba(237,237,237,0.93) 91%, rgba(237,237,237,0.93) 92%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
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

th{background: #3399ff}
tr{height:10px;}
</style>

  <title>Riom-Admin</title>
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
  <li>Admin</a></li>
</ol>
 
</div>

<div class="row">
  <div class="list-group col-md-2 hidden-xs menu-horizontal">
    <a class="list-group-item active">Inicio</a>
    <a class="list-group-item"  href="tablas/usuarios">Usuarios</a>
    <a class="list-group-item"  href="tablas/doctores">Doctores</a>
    <a class="list-group-item"  href="tablas/examenes">Examenes</a>
    <input type="text" value='<?= date("Y-m-d"); ?>' id="year" class="form-control calendario alert alert-danger">
    <button id="reportes" class="btn btn-success">Reportes</button><br><br>
  </div>
  <div class="col-md-2">
  </div>

  <div id="cuadro-citas">
  </div>

  <div id="cuadro-credito">
  </div>
  <div id="cuadro-editarFactura">
  </div>
  <div id="cuadro-editarServicios">
  </div>

         <div id="cuadro-reportes">
              <button type="button" class="close btn btn-danger ocultar" >&times;</button><br>
               <!--- generador de reportes venta diaria -->

                  <div class="col-md-10 ">
                    <form class="row col-md-11" method="POST" action="excel/ventas.php">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <a href="php/backup.php" rol class="btn btn-info"><img src="iconos/bbdd.png" style="width:23px;"></a>
                          <button type="submit" class="btn btn-warning"><img src="iconos/ventas.png" style="width:23px;"></button> 
                        </div>
                        <input type="text" value="<?= date("Y-m-d"); ?>" name="year" class="form-control calendario" >
                      </div>
                    </form>
                  </div><br>

                    <!--- generador de diferentes reportes por mes y año  -->
                <div class="alert bg-warning col-md-12">
                  <form class="row col-md-12" method="POST" action="excel/informes.php">
                    <div class="col-md-3">
                      <input type="number" value="<?= date("Y"); ?>" name="year" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <select name="mes" class="form-control" >
                        <option value=1 >Enero</option><option value=2 >Febrero</option>
                        <option value=3 >Marzo</option><option value=4 >Abril</option>
                        <option value=5 >Mayo</option><option value=6 >Junio</option>
                        <option value=7 >Julio</option><option value=8 >Agosto</option>
                        <option value=9 >Septiembre</option><option value=10 >Octubre</option>
                        <option value=11 >Noviembre</option><option value=12 >Diciembre</option>
                      </select>
                    </div>
                    <div class="col-md-5">
                      <select name="informe" class="form-control" >
                        <option value="1">Reportes de Ventas</option>
                        <option value="2">Reportes de Rips</option>
                        <option value="3">Reportes de Tiempos</option>
                        <option value="4">Reportes de Repetidas</option>
                        <option value="5">Reportes de Urgencias</option>
                        <option value="6">Reportes de Esterilizacion</option>
                      </select>
                    </div>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-warning"><img src="iconos/ventas.png" style="width:23px;"></button>
                    </div>
                  </form>
                </div>
              
              <!--- generador de reportes de credito por doctor, mes y año  -->

                <div class="alert bg-info col-md-12">
                  <form class="row col-md-12" method="POST" action="excel/creditos.php">
                    <div class="col-md-3">
                      <input type="number" value="<?= date("Y"); ?>" name="year" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <select name="mes" class="form-control" >
                        <option value=1 >Enero</option>
                        <option value=2 >Febrero</option>
                        <option value=3 >Marzo</option>
                        <option value=4 >Abril</option>
                        <option value=5 >Mayo</option>
                        <option value=6 >Junio</option>
                        <option value=7 >Julio</option>
                        <option value=8 >Agosto</option>
                        <option value=9 >Septiembre</option>
                        <option value=10 >Octubre</option>
                        <option value=11 >Noviembre</option>
                        <option value=12 >Diciembre</option>
                      </select>
                    </div>
                    <div class="col-md-5">
                      <select name="dr" class="form-control" >
                      <?php while($reg= $consulta_dr->fetch_object()){ ?>
                        <option value="<?php echo $reg->id_doctor; ?>"><?php echo $reg->nom_doctor; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-1">
                    <button type="submit" class="btn btn-warning"><img src="iconos/ventas.png" style="width:23px;"></button>
                    </div>
                  </form>
                </div>

            </div>
          <!--fin de cuadro reportes-->



</div>





<script type="text/javascript" src="../../cp/jquery.js"></script> 
<script type="text/javascript" src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="../../cp/jquery.dataTables.min.js"></script>
<script src="../../cp/dataTables.responsive.min.js"></script>
<script src="../../cp/dataTables.bootstrap.min.js"></script>
<script src="../../cp/bootstrap-datepicker.js"></script>
<script src="../../cp/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#reportes").click(function()
    {
      $("#cuadro-reportes").show('low');

    });

    
    //--------------------------------
    tabla_inicial();
    calendario();

//----------------------------

$('#year').change(function(){
  tabla_inicial();
});
//-------------------------------
});
//----------------------------
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




function credito(id){
        var url = "php/credito.php"; // El script a dónde se realizará la petición.
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {

               $("#cuadro-credito").show("low").html(data);
              

           }

  
   });
           

}
//________________________________________
function cancelar(id){
        var url = "php/cancelar.php"; // El script a dónde se realizará la petición.
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#cancelar"+id).html(data);

           }

  
   });
           

}
//________________________________________
function editarFactura(id){
        var url = "php/editar_factura.php"; // El script a dónde se realizará la petición.
        var factura = $("#factura"+id).text();
       
        $.ajax({

           type: "POST",

           url: url,

           data: {id:id, factura:factura}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
              $("#cuadro-editarFactura").show("low").html(data);

           }

  
   });
     

}

//________________________________________
function editarServicios(id){
        var url = "php/editar_servicios.php"; // El script a dónde se realizará la petición.
        $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
              $("#cuadro-editarServicios").show("low").html(data);

           }

  
   });
     

}
</script>
</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>