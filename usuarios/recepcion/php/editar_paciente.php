<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../error1.php");
}
include('../../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==2){
     $url_logo="../../../cp/";
    //____________________________________________

$sql_usu="SELECT * FROM usuario where tipo=2 ORDER BY nom_usuario DESC";
$consulta_usu= $enlace->query($sql_usu);


$idp=$_GET['id'];
$sql_paciente="SELECT * FROM paciente WHERE id_paciente=$idp";
$consulta_paciente=$enlace->query($sql_paciente);
$reg_paciente=$consulta_paciente->fetch_object();

$sexo=$reg_paciente->sexo;
if($sexo=="Masculino"){
  $sexos='<label class="radio-inline"><input type="radio" name="sexo" value="Masculino" checked> masculino</label>     
         <label class="radio-inline"><input type="radio" name="sexo" value="Femenino"> femenino</label>
         <label class="radio-inline"><input type="radio" name="sexo" value="Otros"> otros</label>';
}elseif ($sexo=="Femenino") {
   $sexos='<label class="radio-inline"><input type="radio" name="sexo" value="Masculino"> masculino</label>     
         <label class="radio-inline"><input type="radio" name="sexo" value="Femenino" checked> femenino</label>
         <label class="radio-inline"><input type="radio" name="sexo" value="Otros"> otros</label>';
}else{ $sexos='<label class="radio-inline"><input type="radio" name="sexo" value="Masculino"> masculino</label>     
         <label class="radio-inline"><input type="radio" name="sexo" value="Femenino"> femenino</label>
         <label class="radio-inline"><input type="radio" name="sexo" value="Otros" checked> otros</label>';}


   $ffnac=$reg_paciente->ff_nac;
                            $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                            $nac=$enlace->query($nac);
                            $nac=$nac->fetch_object();
                            $age=  $nac->edad/365.25 ;

?>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Recepcion - Pacientes</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../../cp/responsive.boostrap.min.css">
<link href="../../../cp/dataTables.bootstrap.min.css">
<link href="../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/stilo.css">
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
  <li><a href="../">Recepcion</a></li><li>Editar-Usuario</li>
</ol>
</div>
<div class="row">
<div class="list-group col-md-12 hidden-xs " >




<div class="btn-group-lg botones">
<a type="button" title="Inicio" href="../" class="btn btn-success glyphicon glyphicon-user "></a>
<a type="button" title="Citas" href="../usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
<a type="button" title="Servicios" href="../cuentas.php" class="btn  btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
<a type="button" title="Doctores" href="../tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="../iconos/dr.png"></center></a> 
<a type="button" title="Examenes" href="../tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="../iconos/exa.png"></center></a> 
</div>
</div>
<!-- **** generador de cuentas -->


<div class="row debajo"><div class="col-md-2"></div>
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:#1B776D;">
                           <center class="bg-success"> <b>Editar Pacientes</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                
<div class="row col-md-12"> 
<div class="container col-md-12">
<form class="form-horizontal form-cita" action="insertarEditar_paciente.php" name="form1" id="" method="POST">
    <fieldset>

        <div class="form-group has-success">
        <label class="control-label col-md-3" for="cc" >Tipo Doc.</label> 
        <div class="col-md-3">
          <input type="hidden" value="<?php echo $idp; ?>" name="id">
        <select id="tdc" class="form-control" type="text" name="tdc">
            <option value="<?php echo $reg_paciente->tipo_dc; ?>"><?php echo $reg_paciente->tipo_dc; ?></option>
            <option value="CC">CC</option> 
            <option value="TI">TI</option>
            <option value="NIT">NIT</option>
            <option value="CE">CE</option>
        </select>
        </div>
        <label class="control-label col-md-1" for="ndc" >No.</label> 
        <div class="col-md-5">
        <input id="ndc" class="form-control" type="text" Value="<?php echo $reg_paciente->num_dc; ?>" name="ndc" ></input>
        </div>
    </div>

    <div class="form-group has-success">
        <label class="control-label  col-md-2" for="nombre1" >Nombre(1)</label> 
        <div class="col-md-4">
        <input id="nombre1" class="form-control nombre" type="text" Value="<?php echo $reg_paciente->nom_1; ?>"  name="nombre1" ></input>
         </div>
          <label class="control-label  col-md-2" for="nombre2" >Nombre(2)</label> 
        <div class="col-md-4">
        <input id="nombre2" class="form-control nombre2" type="text" Value="<?php echo $reg_paciente->nom_2; ?>"  name="nombre2" ></input>
         </div>
    </div>

        <div class="form-group has-success">
        <label class="control-label  col-md-2" for="apellido1" >Apellido(1)</label> 
        <div class="col-md-4">
        <input id="nombre3" class="form-control nombre" type="text" Value="<?php echo $reg_paciente->ape_1; ?>"  name="apellido1" ></input>
         </div>
          <label class="control-label  col-md-2" for="apellido2" >Apellido(2)</label> 
        <div class="col-md-4">
        <input id="nombre4" class="form-control nombre" type="text" Value="<?php echo $reg_paciente->ape_2; ?>"  name="apellido2" ></input>
         </div></div>

<div class="form-group  has-success">
          <label class="control-label  col-md-2" for="telefono" >Telefono</label> 
        <div class="col-md-3">
        <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo $reg_paciente->telefono; ?>"></input>
         </div>
        <label class="control-label col-md-2" for="correo" >Sexo: </label> 
   <?php echo $sexos; ?>
    </div>
      

        <div class="form-group has-success">
        <label class="control-label  col-md-4" for="ffnac" >Fecha de nacimiento</label> 
        <div class="col-md-5">
        <input id="ffnac2" class="form-control" type="date" Value="<?php echo $reg_paciente->ff_nac; ?>"  name="ffnac" required></input>
         </div>
         <div class="col-md-3" id="edad"><label class="control-label"><?php echo floor($age); ?></label></div>
        <br><div class="col-md-3"></div> 
</div>



<div class="form-group has-success">
    <center>
     <div class="col-md-9">
   <input type="reset" value="Borrar" onClick="resetForm()" class="btn btn-danger">
    <input type="submit" value="Ingresar" onClick="validarFormularios()" class="btn btn-primary citas">
  </div> </center>
    </div>

 <center id="resultados">
    <div class="container">
   <div id="respuesta"><div id="mensaje" name="mensaje" class="text-warning"></div>
    </div>
    </center>
  
    </fieldset>
</form></div>
</div>


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








</div>
<script src="../js/jquery.js"></script>
<script src="../../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/validar-formularios.js"></script>

      

</body>
</html>
<?php }else{
  header("Location:../../../error3.php");

}?>