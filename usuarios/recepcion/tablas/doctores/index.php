
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


if($reg->tipo=="2"){
   $url_logo="../../../../cp/";
//_________________________________________________

$sqlcc =" SELECT * FROM  dr  
         ORDER BY id_doctor asc ";
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
        <link rel="stylesheet" type="text/css" href="../../css/stilo.css">


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
  <li><a href="../../">Recepcion</a></li>
  <li>Doctores</li>
</ol>
</div>









<!--    menu -->

<div class="col-md-2"></div>
<div class="btn-group-lg botones">
<a type="button" title="Inicio" href="../../index.php" class="btn  btn-success glyphicon glyphicon-user"></a>
<a type="button" title="Citas" href="../../usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
<a type="button" title="Servicios" href="../../cuentas.php" class="btn btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
<a type="button" title="Doctores" href="#" class="btn active"><center><img style="width:20px;" src="../../iconos/drb.png"></center></a> 
<a type="button" title="Examenes" href="../examenes" class="btn  btn-info"><center><img style="width:20px;" src="../../iconos/exa.png"></center></a> 
</div>  
<!--    tabla   -->

<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:#e73827;">
                           <center class="bg-danger"> <b>Cuadro de Doctores</b>
                            <a href="#ventana1"  class="btn btn-default ingresar2" data-toggle="modal">Nuevo Doctor</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
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
                         <td><a href="php/editar.php?id=<?php echo $regcc->id_doctor ?>"  class="glyphicon glyphicon-edit"></a> 
                             </tr>
                     
                        <?php } ?>
                </tbody>
            </table>
                            </div>
                            <!-- /.table-responsive -->
          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->




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