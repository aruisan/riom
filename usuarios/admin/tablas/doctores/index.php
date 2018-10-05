
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../../error1.php");
}
include('../../../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();
//$_SESSION['cc']=$reg->id_datos

if($reg->tipo=="1"){

$url_logo="../../../../cp/";
//____________________________________


$sqlcc =" SELECT * FROM  dr  ";
$listarcc = $enlace->query($sqlcc);

?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



        <link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
         <link href="../../../../cp/responsive.boostrap.min.css">
        <link href="../../../../cp/dataTables.bootstrap.min.css">
        <link href="../../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">


  <title>RIOM/Doctores</title>
</head>
<body>
<div class="container">
  <header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
  


        <div></div>



      <ul class="navbar-nav nav">
         <li ><a href="../../php/editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../../../index.php' method='POST'>
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
  <li><a href="../../">Admin</a></li>
  <li>Doctores</li>
</ol>
</div>









<!--    menu -->

<div class="row">
<div class="list-group col-md-3 hidden-xs " >
<a class="list-group-item"  href="../../">Inicio</a>
<a class="list-group-item"  href="../usuarios">Usuarios</a>
<a class="list-group-item active"  href="">Doctores</a>
<a class="list-group-item"  href="../examenes" >Examenes</a>
<br>
</div>
<div class="col-md-2"></div>




<!--    tabla   -->
<div class="container-fluid">


      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
<table border="0" align="center" class="table table-responsive ">
        <tr>
            <td width="100"><a href="#ventana1"  class="btn btn-primary" data-toggle="modal">Nuevo Doctor</a></td>
                                                                                     
        </tr>
    </table>

            <div class="container-fluid">
           <table id="example" class="table table-condensed table-striped table-bordered dt-responsive table-hover nowrap " cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th>DOCTORES</th>
                        <th>DIRECCION</th>
                        <th>E-MAIL</th>
                        <th>TELEFONO</th>
                        <th>NIT</th>
                        <th>COD. SECRETARIA</th>
                       <th>OPCIONES</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php

                    while($regcc=$listarcc->fetch_object())

            
                   {?>

                        
                         <tr>
                  
                        
                          <td><?php echo mb_convert_encoding($regcc->nom_doctor, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($regcc->direccion, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($regcc->email, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($regcc->telefono, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($regcc->nit, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($regcc->cod_secretaria, "UTF-8")?></td>
                         <td><a href="php/editar.php?id=<?php echo $regcc->id_doctor; ?>"  class="glyphicon glyphicon-edit"></a> 
                             </tr>
                     
                        <?php } ?>
                </tbody>
            </table>
</div></select></div>


<!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
<div class="modal fade" id="ventana1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center><h3 class="modal-tittle">Ingreso de Doctor</h3></center>
      </div>
      <div class="modal-body">
         <form id="formulario" class="form-horizontal"  enctype="multipart/form-data" action="php/insertar.php" method="POST">
         <fieldset>
          <center>
           
           
                   <div class="form-group">
                       <label class="control-label col-md-2" for="nombre" >Nombre:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="text" name="name" id="name"></td>
                        </div></div>

                    <div class="form-group">
                       <label class="control-label col-md-2" for="direccion" >Direccion:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="text" name="direccion" id="direccion"></td>
                        </div></div>

                    <div class="form-group">
                       <label class="control-label col-md-2" for="email" >E-Mail:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="email" name="email" id="email"></td>
                        </div></div>  

                    <div class="form-group">
                       <label class="control-label col-md-2" for="telefono" >Telefono:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="tel" name="telefono" id="telefono"></td>
                        </div></div>  

                    <div class="form-group">
                       <label class="control-label col-md-2" for="nit" >Nit:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="text" name="nit" id="nit"></td>
                        </div></div>  

                     <div class="form-group">
                       <label class="control-label col-md-2" for="cod" >Cod. Secretaria:</label> 
                       <div class="col-md-5">
                       <input class="form-control" type="text" name="cod" id="cod"></td>
                        </div></div>  
                       
              </center>
              <fieldset>

            </div>
            <div class="modal-footer">
            <botton class="btn close_link btn-danger" data-dismiss="modal">cancelar</botton>
              <input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                
            </div>
            </form>
      </div>  
    </div>
  </div>

</div>




</div>
</div>
       <script type="text/javascript" src="../../../../cp/jquery.js"></script>
        <script type="text/javascript" src="../../../../cp/myjava.js"></script>
        <script src="../../../../cp/bootstrap/js/bootstrap.js"></script>
        <script src="../../../../cp/jquery.dataTables.min.js"></script>
        <script src="../../../../cp/dataTables.responsive.min.js"></script>
        <script src="../../../../cp/dataTables.bootstrap.min.js"></script>
        <script>

        $(document).ready(function() {
        $('#example').DataTable();
        } );
        </script>
</body>
</html>
<?php }else{
  header("Location:../../../../error2.php");

}?>