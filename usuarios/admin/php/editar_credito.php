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

$sql_con="SELECT credito FROM servicio WHERE id_servicio=$id";
$consulta=$enlace->query($sql_con);
$reg=$consulta->fetch_object();
$credito=$reg->credito;

if($credito=="no"){$enviar="si"; $td_credito="cre-verde";}else{$enviar="no"; $td_credito="cre-rojo";}

$sql="UPDATE servicio SET credito='$enviar' WHERE id_servicio=$id";
$ingresar = $enlace->query($sql);
       
?>
<a href="javascript:editarCredito(<?php echo $id; ?>)"><img src="iconos/<?php echo $td_credito; ?>.png" style="width:20px;"></a>



<?php
 }else{
  header("Location:../../../error3.php");

}?>