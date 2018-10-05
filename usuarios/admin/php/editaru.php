

<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../error1.php");
}
include('../../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();
//$_SESSION['cc']=$reg->id_datos;

if($reg->tipo=="1"){
$url_logo="../../../cp/";
//__________________________________________________________

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="with=device-with, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link type="text/css" href="../css/editar.css" rel="stylesheet" />
<link href="../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">

  <title>RIOM/Editar-Perfil</title>
</head>
<body>
<div class="container">
  <header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
  


        <div></div>



      <ul class="navbar-nav nav">
         <li ><a href="editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../../index.php' method='POST'>
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
  <li><a href="../index.php">Admin</a></li>
  <li>Editar Perfil</li>
</ol>
</div>

<div class="row">

<div>

<div>
<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
  <div class="col-md-3 col-lg-3"></div>
<form class="form-horizontal" action="actualizar_usu.php" method="POST">
  <fieldset>
    <div class="form-group">
    <label class="control-label col-md-2" for="nombre" >Nick:</label> 
    <div class="col-md-5">
    <input  class="form-control" type="text" value="<?php echo $reg->nick ?>" name="nick"></input>
    <input  class="form-control" type="hidden" value="<?php echo $reg->id_usuario ?>" name="id"></input>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label  col-md-2" for="nombre" >Clave:</label> 
    <div class="col-md-5">
    <input class="form-control" type="text" value="<?php echo $reg->clave ?>" name="clave"></input>
    </div>
  </div>


  
  <div class="form-group row">
    <div class="col-md-2 col-sm-1"></div>
     <div class="col-md-2 hidden-sm hidden-xs">
   <a class="btn btn-danger" href="../">Cancelar</a></div>

  <div class="col-md-1">
    <input type="submit" class="btn btn-success" value="Actualizar" >
  </div>  </div>

  </fieldset>
</form>

</div>










</div>



<script type="text/javascript" src="../../../cp/jquery.js"></script> 
<script type="text/javascript" src="../../../cp/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="../js/imagenes.js"></script> 
</body>
</html>
<?php }else{
  header("Location:../../../error1.php");

}?>