<?php 
require("../../../cp/conexion.php");
$id=$_POST['id'];

$sql="SELECT * FROM cita WHERE id_cita=$id";
$consulta= $enlace->query($sql);
$reg= $consulta->fetch_object();

$h1=$reg->hh_llegada;
$h2=$reg->hh_toma;
$h3=$reg->hh_salida;


  $hora= array(0=>$h1, 1=>$h2, 2=>$h3);

        echo json_encode($hora);
?>