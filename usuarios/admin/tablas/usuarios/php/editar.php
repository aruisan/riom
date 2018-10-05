
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

if($reg->tipo=="1"){
   $url_logo="../../../../../cp/";
  //_______________________________


$idusu = $_GET['id'];

$sqlusu =" SELECT usuario.*, cargos.*  FROM  usuario, cargos WHERE usuario.id_usuario=$idusu AND usuario.tipo=cargos.id_cargo";
$consultausu = $enlace->query($sqlusu);
$regusu = $consultausu->fetch_object();

$sqlcc =" SELECT * FROM  cargos  
         ORDER BY id_cargo asc ";
$listarcc = $enlace->query($sqlcc);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



        <link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
         <link href="../../../../../cp/responsive.boostrap.min.css">
        <link href="../../../../../cp/dataTables.bootstrap.min.css">
        <link href="../../../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">


  <title>RIOM/Edita-Usuarios</title>
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
  <li><a href="../">Usuarios</a></li>
  <li>Editar Usuarios</li>
</ol>
</div>

<div class="row">
<div class="list-group col-md-3 hidden-xs " >
<a class="list-group-item" href="../../../">Inicio</a>
<a class="list-group-item"  href="../../usuarios">Usuarios</a>
<a class="list-group-item"  href="../../doctores">Doctores</a>
<a class="list-group-item"  href="../../examenes">Examenes</a>
<br>
</div>

<!--    general   -->

<div class="container-fluid">


  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
     <div class="panel-default panel ">
      <div class="panel-body">
        <div class="page-header">
          <h1 class="text-warning">Editando Usuario</h1>
        </div>  
        <form class="form-horizontal" role="form" action="actualizar_datos.php" method="POST">

           <div class="form-group">
            <label for="usu">Nombre</label>
            <div class="input-group">
              <span class="input-group-addon"><span class=" glyphicon glyphicon-tags"></span></span>
            <input class="form-control" name="name" value="<?php echo $regusu->nom_usuario?>">
          </div></div>

          <div class="form-group">
            <label for="usu">usuario</label>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input class="form-control" name="nick" value="<?php echo $regusu->nick?>">
            <input type="hidden" name="id" value="<?php echo $regusu->id_usuario?>">
          </div></div>

          <div class="form-group">
            <label for="usu">Clave</label>
            <div class="input-group">
              <span class="input-group-addon"><span class=" glyphicon glyphicon-lock"></span></span>
            <input class="form-control" name="clave" value="<?php echo $regusu->clave?>">
          </div></div>

          <div class="form-group">
            <label for="usu">Cargo</label>
            <div class="input-group">
              <span class="input-group-addon"><span class=" glyphicon glyphicon-briefcase"></span></span>

              <select class="form-control" name="cargo">
             
                                <option value="<?php echo $regusu->id_cargo; ?>"><?php echo $regusu->nom_cargo; ?></option>
                
                <?php
                                       while ($fil= $listarcc->fetch_object()){
                                        ?>

                                
                                       <option value="<?php echo $fil->id_cargo; ?>"><?php echo $fil->nom_cargo; ?></option>
                                      <?php }
                                       ?>
                
              </select>

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