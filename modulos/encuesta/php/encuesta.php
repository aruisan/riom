<?php
session_start();
require_once('../../../cp/conexion.php');

if(isset($_POST['action']))
{
	$action = $_POST['action'];
}else{
	$action = $_GET['action'];
}


if($action == "store"){
	store($enlace, $_POST['questionOne'] , $_POST['flujo1'], $_POST['questionTwo'], $_POST['flujo2'], $_POST['questionThree'], $_POST['questionFour']);
}







 function store($enlace, $questionOne , $flujo1, $questionTwo, $flujo2, $questionThree, $questionFour)
 {
 	$create_at = date("Y-m-d");
 	$sql = "INSERT INTO `encuesta`(`questionOne`, `questionTwo`, `questionThree`, `questionFour`, `flujoOne`, `flujoTwo`, `create_at`) 
 							VALUES ($questionOne ,  $questionTwo, $questionThree, $questionFour, '$flujo1', '$flujo2', '$create_at')";

 	$insert = $enlace->query($sql);
 }


?>