<?php
session_start();
$responsable = $_SESSION['id'];
require_once('../../../cp/conexion.php');


if(isset($_POST['action']))
{
	$action = $_POST['action'];
}else{
	$action = $_GET['action'];
}


if($action == "edit"){
	edit($enlace, $_POST['id']);

}elseif($action == "create"){
	create($enlace, $responsable,  $_POST['elemento'], $_POST['cant'], $_POST['ff_inicio']);

}elseif($action == "update"){
	update($enlace, $responsable,  $_POST['elemento'], $_POST['cant'], $_POST['ff_inicio'], $_POST['ff_final'], $_POST['id']);


}elseif($action == "delete"){
	delete($enlace, $_GET['id'] );

}elseif($action == "finalizar"){
	finalizar($enlace, $_GET['id'] );
}







 function create($enlace, $responsable , $elemento, $cant, $ff_inicio)
 {
 	
 	$sql = "INSERT INTO `esterilizacion`(`ff_inicio`, `elemento`, `cant`, `responsable`) 
 								VALUES ('$ff_inicio', '$elemento', $cant, $responsable )";
 	$insert = $enlace->query($sql);

 	if($insert)
 	{
 		header('location:../');
 		$_SESSION['success'] = "el registro a sido guardado";
 	}else{
 		echo "erro al crear registro";
 	}
 }


 function edit($enlace, $id)
 {
 	$sql = "SELECT * FROM esterilizacion WHERE id = $id";
 	$consulta = $enlace->query($sql);
 	$reg = $consulta->fetch_object();
 	echo json_encode($reg);
 }


function update($enlace, $responsable , $elemento, $cant, $ff_inicio, $ff_final, $id)
{
  	$sql= "UPDATE `esterilizacion` SET `ff_inicio`='$ff_inicio',`ff_final`='$ff_final',`elemento`='$elemento',`cant`=$cant WHERE id= $id";
  	$update = $enlace->query($sql);
  	if($update)
  	{
 		header('location:../');
 		$_SESSION['success'] = "el registro a sido Editado";
 	}else{
 		echo "erro al editar registro";
 	}
}

function delete($enlace, $id )
{
	$sql = "DELETE FROM esterilizacion WHERE id = $id";
	$destroy = $enlace->query($sql);
	if($destroy)
  	{
 		header('location:../');
 		$_SESSION['success'] = "el registro a sido Eliminado";
 	}else{
 		echo "erro al borrar registro";
 	}
}

function finalizar($enlace, $id)
{
	$sql = "UPDATE  esterilizacion SET ff_final = NOW() WHERE id = $id";
	$finalizar = $enlace->query($sql);
	if($finalizar)
  	{
 		header('location:../');
 		$_SESSION['success'] = "ese ha dado hora de finalizacion de la esterilizacion";
 	}else{
 		echo "erro al borrar registro";
 	}
}
?>