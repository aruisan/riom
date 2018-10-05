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
$mensaje = $_POST['mensaje'];

  $sqlEdit =  "UPDATE cita SET urgencia = '$mensaje'
  			WHERE id_cita=$id"; 
  $editar = $enlace->query($sqlEdit);

  if($editar)
  {
    header('location:citas.php');
  }else{
    echo "error"; 
  }

}else{
  header("Location:../../../error2.php");
}
      

?>