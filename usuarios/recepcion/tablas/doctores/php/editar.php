
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


if($reg->tipo=="2"){

   $url_logo="../../../../../cp/";
//______________________________________________

$idreg = $_GET['id'];

$sqlusu =" SELECT *  FROM  dr WHERE id_doctor=$idreg";
$consultausu = $enlace->query($sqlusu);
$regusu = $consultausu->fetch_object();

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
        <link rel="stylesheet" type="text/css" href="../../../css/stilo.css">


  <title>RIOM/Editar-Doctores</title>
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
  <li><a href="../">Doctores</a></li>
  <li>Editar Doctor</li>
</ol>
</div>

<div class="col-md-2"></div>
<div class="btn-group-lg botones">
<a type="button" title="Inicio" href="../../../index.php" class="btn  btn-success glyphicon glyphicon-user"></a>
<a type="button" title="Citas" href="../../../usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
<a type="button" title="Servicios" href="../../../cuentas.php" class="btn btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
<a type="button" title="Doctores" href="../" class="btn btn-danger"><center><img style="width:20px;" src="../../../iconos/dr.png"></center></a> 
<a type="button" title="Examenes" href="../../examenes" class="btn  btn-info"><center><img style="width:20px;" src="../../../iconos/exa.png"></center></a> 
</div>   
<!--    tabla   -->

<div class="container-fluid">


  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
     <div class="panel-default panel ">
      <div class="panel-body">
        <div class="page-header">
          <h1 class="text-warning">Editando Doctor</h1>
        </div>  
        <form class="form-horizontal" role="form" action="actualizar_datos.php" method="POST">

           <div class="form-group">
            <label class="control-label col-md-4" for="usu">Nombre</label> 
            <div class="col-md-8">
            <input class="form-control" name="name" value="<?php echo $regusu->nom_doctor?>">
            <input type="hidden" name="id" value="<?php echo $regusu->id_doctor?>">
          </div></div>



                    <div class="form-group">
                       <label class="control-label col-md-4" for="direccion" >Direccion:</label> 
                       <div class="col-md-8">
                       <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo $regusu->direccion; ?>"></td>
                        </div></div>

                    <div class="form-group">
                       <label class="control-label col-md-4" for="email" >E-Mail:</label> 
                       <div class="col-md-8">
                       <input class="form-control" type="email" name="email" id="email" value="<?php echo $regusu->email; ?>"></td>
                        </div></div>  

                    <div class="form-group">
                       <label class="control-label col-md-4" for="telefono" >Telefono:</label> 
                       <div class="col-md-8">
                       <input class="form-control" type="tel" name="telefono" id="telefono" value="<?php echo $regusu->telefono; ?>"></td>
                        </div></div>  

                    <div class="form-group">
                       <label class="control-label col-md-4" for="nit" >Nit:</label> 
                       <div class="col-md-8">
                       <input class="form-control" type="text" name="nit" id="nit" value="<?php echo $regusu->nit; ?>"></td>
                        </div></div>  

                     <div class="form-group">
                       <label class="control-label col-md-4" for="cod" >Cod. Secretaria:</label> 
                       <div class="col-md-8">
                       <input class="form-control" type="text" name="cod" id="cod" value="<?php echo $regusu->cod_secretaria; ?>"></td>
                        </div></div>  

                        <center>
          <input type="submit" value="Editar" class="btn btn-warning"  id="edi" style="width:80px; "/>
          </center>
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