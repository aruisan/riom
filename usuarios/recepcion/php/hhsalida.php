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


  $sql =  "UPDATE cita SET hh_salida='$hora'
  			WHERE id_cita=$id"; 
     $editar = $enlace->query($sql);

  $valor= array(0=>$id);

        echo json_encode($valor);
}else{
  header("Location:../../../error2.php");

}
      

?>