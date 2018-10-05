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


if($action == "firma"){
	firma($enlace, $_POST['cita_id'], $_POST['nom_paciente'], $_POST['paciente_id']);
}elseif($action == "datosPaciente"){
	datosPaciente($enlace);
}




 function firma($enlace, $cita_id, $nom_paciente, $paciente_id)
 {
 	$sql = "UPDATE `firma` SET `cita_id`= $cita_id,`nom_paciente`= '$nom_paciente', paciente_id = $paciente_id  WHERE id = 1";
 	$update = $enlace->query($sql);
 	if($update)
 	{
 		$userFirma = userFirma($enlace, $cita_id);
 	}
 }


function userFirma($enlace, $cita_id)
{

  	$sql= "UPDATE `cita` SET `firma`= 1 WHERE id_cita =  $cita_id";
  	$update = $enlace->query($sql);
  	if($update)
  	{
 		header('location:citas.php');
 	}else{
 		echo "erro al editar registro";
 	}
}










///////////////////////////////
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