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


if($reg->tipo==1){
//_____________________________________________________________________

$id=$_POST['id'];

$sql_con="SELECT anulado FROM cita WHERE id_cita=$id";
$consulta=$enlace->query($sql_con);
$reg=$consulta->fetch_object();
$anular=$reg->anulado;

if($anular=="NO"){$anulado="SI"; $td_cancelar="borrar-rojo";}else{$anulado="NO"; $td_cancelar="borrar-azul";}

$sql="UPDATE cita SET anulado='$anulado' WHERE id_cita=$id";
$ingresar = $enlace->query($sql);
       
?>

<a href="javascript:cancelar(<?php echo $id; ?>)"><img src="iconos/<?php echo $td_cancelar; ?>.png" style="width:20px;"></a>


<?php
 }else{
  header("Location:../../../error3.php");

}?>