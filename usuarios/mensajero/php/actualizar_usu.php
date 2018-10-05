<?php
 require_once('../../../cp/conexion.php');


        $id= $_POST["id"];
        $nick= $_POST["nick"];
        $clave= $_POST["clave"];


 $sql =  "UPDATE usuario SET nick='$nick',clave='$clave' WHERE id_usuario=$id";
              
     $actualizar = $enlace->query($sql);

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

if($reg->tipo=="4"){


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="with=device-with, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale">
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
<H1 class="text-muted">SOFT-RIOM</H1>
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
<div class="list-group col-md-3 hidden-xs " >
<a class="list-group-item active">Inicio</a>
<a class="list-group-item"  href="../tablas/usuarios">Usuarios</a>
<a class="list-group-item"  href="../tablas/doctores">Doctores</a>
<a class="list-group-item"  href="../tablas/examenes">Examenes</a>
<br>
</div>

<div class="container-fluid">
<div class="col-xs-12 col-sm-9  col-md-9 col-lg-9 ">
<center><div class="alert alert-success">Se han actualizado con exito los datos</div></center>
</div>

<div class="col-xs-12 col-sm-9  col-md-9 col-lg-9 ">
  <div class="col-md-3"></div>
<div class="form-horizontal">
  <fieldset>
<div class="form-group">
    <label class="control-label col-md-2" for="nombre" >Nick:</label> 
    <div class="col-md-5">
    <input  class="form-control" type="text" value="<?php echo $reg->nick ?>" name="nick" disabled></input>
    <input  class="form-control" type="hidden" value="<?php echo $reg->cc ?>" name="id"></input>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label  col-md-2" for="nombre" >Clave:</label> 
    <div class="col-md-5">
    <input class="form-control" type="text" value="<?php echo $reg->clave ?>" name="clave" disabled></input>
    </div>
  </div>


  <div class="form-group">
    <div class="col-md-2"></div>
     <div class="col-md-2">
   <a class="btn btn-info" href="../">Inicio</a></div></div>

 </fieldset>
</div>

</div>

</div>










</div>



<script type="text/javascript" src="../../../cp/jquery.js"></script> 
<script type="text/javascript" src="../../../cp/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="../js/imagenes.js"></script> 
</body>
</html>
<?php }else{
  header("Location:../../../error2.php");

}
      

?>