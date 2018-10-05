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


header("location:citas.php");
$usu=$_SESSION['id'];
$paciente=$_GET['id'];
$_SESSION['paciente']=$paciente;




  $sql =  "INSERT INTO cita (ff, hh_llegada, atendido, responsable, cita_paciente)
              VALUES ('$ffhh', '$hora', 'NO', '$usu', '$paciente')"; 
     $insertar = $enlace->query($sql);

}else{
  header("Location:../../../error2.php");
}
      

?>
