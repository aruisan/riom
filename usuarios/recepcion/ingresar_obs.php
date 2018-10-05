<?php
require_once('../../../cp/conexion.php');
header("Location:../usuarios.php");

$id=$_POST['id_obs'];
$obs=$_POST['obs'];

$ingresar="UPDATE cita SET obs='$obs' WHERE id_cita=$id ";
?>