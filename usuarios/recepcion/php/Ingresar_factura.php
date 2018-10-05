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
//_____________________________________________________________________



$sql="SELECT max(factura) as ultimo FROM cita";
$consulta= $enlace->query($sql);
$reg = $consulta->fetch_object();
$factura = $reg->ultimo+1;

$id=$_POST['id'];

$insertar="UPDATE  cita SET factura = '$factura' WHERE id_cita = $id";
$ingresar=$enlace->query($insertar);

       
 ?>   
<center><label class="text-warning"><?php echo $factura; ?></label></center>

<?php }else{
  header("Location:../../../error3.php");

}?>