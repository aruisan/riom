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
  //_____________________________________________________________


$id=$_POST['id'];

$sql="SELECT enviar FROM servicio WHERE id_servicio=$id";
$consulta=$enlace->query($sql);
$reg=$consulta->fetch_object();
$cons=$reg->enviar;

if ($cons=="no"){$enviar="si";}else{$enviar="no";}

$edit="UPDATE servicio SET enviar='$enviar' where id_servicio=$id";
$editar=$enlace->query($edit);

if($enviar=="si"){$carta="m-no.png";}else{$carta="m.png";}
  $carta2= array(0=>$carta);

        echo json_encode($carta2);

 }else{
  header("Location:../../../error2.php");

}
      

?>