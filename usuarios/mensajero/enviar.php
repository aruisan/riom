<?php
session_start();
require_once('../../cp/conexion.php');

$id=$_POST['id'];
$usu=$_SESSION['id'];

$sqlconsultar= "SELECT mensajero FROM servicio WHERE id_servicio=$id";
$consulta = $enlace->query("$sqlconsultar");
$reg = $consulta->fetch_object();
$estado=$reg->mensajero;

if($estado == 0){


  $sqlEditar =  "UPDATE servicio SET mensajero='$usu'
  			WHERE id_servicio=$id"; 
     $editar = $enlace->query($sqlEditar);

  $valor= array(0=>$id);

        echo json_encode($valor);
}else{

  $valor= array(0=>$id);

        echo json_encode($valor);
}
?>

