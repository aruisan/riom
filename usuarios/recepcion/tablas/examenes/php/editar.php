
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../../../error1.php");
}
include('../../../../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();
//$_SESSION['cc']=$reg->id_datos

if($reg->tipo=="2"){
  $url_logo="../../../../../cp/";


$idusu = $_GET['id'];

$sqlusu =" SELECT *  FROM  examen WHERE id_examen=$idusu ";
$consultausu = $enlace->query($sqlusu);
$regusu = $consultausu->fetch_object();


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



        <link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" /
         <link href="../../../../../cp/responsive.boostrap.min.css">
        <link href="../../../../../cp/dataTables.bootstrap.min.css">
        <link href="../../../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../../css/stilo.css">


  <title>RIOM/Editar-Examenes</title>
</head>
<body>
<div class="container">
  <header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
  


        <div></div>



      <ul class="navbar-nav nav">
         <li ><a href="../../../php/editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../../../../index.php' method='POST'>
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










<!--   migas de pan   -->


<div class="container-fluid row">
<ol class="breadcrumb">
  <li><a href="../../../">Admin</a></li>
  <li><a href="../">Examenes</a></li>
  <li>Editar Examenes</li>
</ol>
</div>

<div class="col-md-2"></div>

<div class="btn-group-lg botones">
<a type="button" title="Inicio" href="../../../index.php" class="btn  btn-success glyphicon glyphicon-user"></a>
<a type="button" title="Citas" href="../../../usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
<a type="button" title="Servicios" href="../../../cuentas.php" class="btn btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
<a type="button" title="Doctores" href="../../doctores" class="btn btn-danger"><center><img style="width:20px;" src="../../../iconos/dr.png"></center></a> 
<a type="button" title="Examenes" href="../" class="btn  btn-info"><center><img style="width:20px;" src="../../../iconos/exa.png"></center></a> 
</div>  

<div class="container-fluid">


  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
     <div class="panel-default panel ">
      <div class="panel-body">
        <div class="page-header">
          <h1 class="text-warning">Editando Examen</h1>
        </div>  
        <form class="form-horizontal" role="form" action="actualizar_datos.php" method="POST">

           <div class="form-group">
            <label for="usu">Examen</label>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
            <input class="form-control" name="name" value="<?php echo $regusu->nom_examen?>">
          </div></div>

          <div class="form-group">
            <label for="usu">precio</label>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
            <input class="form-control" name="precio" value="<?php echo $regusu->precio?>">
            <input type="hidden" name="id" value="<?php echo $regusu->id_examen?>">
          </div></div>

          <div class="form-group">
            <label for="usu">Cubs</label>
            <div class="input-group">
              <span class="input-group-addon"><span class=" glyphicon glyphicon-barcode"></span></span>
            <input class="form-control" name="cubs" value="<?php echo $regusu->cubs?>">
          </div></div>


          <input type="submit" value="Editar" class="btn btn-warning"  id="edi" style="width:80px; "/>
        </form>
      </div>  
     </div>
     </div>
  </div>


</div>










</div>









        <script type="text/javascript" src="../../../../../cp/jquery.js"></script>
        <script src="../../../../../cp/bootstrap/js/bootstrap.js"></script>
        <script src="../../../../../cp/jquery.dataTables.min.js"></script>
</body>
</html>
<?php }else{
  header("Location:../../../../../error3.php");

}?>