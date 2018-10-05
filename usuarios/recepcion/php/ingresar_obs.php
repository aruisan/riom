
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
header("Location:../usuarios.php");

$id=$_POST['id'];
$obs=$_POST['text'];

$ingresar="UPDATE cita SET obs='$obs' WHERE id_cita=$id ";
$ing=$enlace->query($ingresar);

}else{
  header("Location:../../../error2.php");

}
      

?>