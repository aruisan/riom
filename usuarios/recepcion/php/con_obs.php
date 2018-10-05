<?php
require_once('../../../cp/conexion.php');

$id=$_POST['cc'];

$sql="SELECT * FROM cita WHERE id_cita=$id";
$consulta= $enlace->query($sql);
$reg=$consulta->fetch_object();
$obs=$reg->obs;


  $valor= array(0=>$id, 1=>$obs);

        echo json_encode($valor);
?>