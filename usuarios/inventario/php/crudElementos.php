<?php
session_start();
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
	create($enlace, $_POST['nombre'] , $_POST['codigo'], $_POST['marca'], $_POST['medida'], $_POST['stock']);

}elseif($action == "update"){
	update($enlace, $_POST['nombre'] , $_POST['codigo'], $_POST['marca'], $_POST['medida'], $_POST['stock'], $_POST['id']);


}elseif($action == "delete"){
	delete($enlace, $_GET['id'] );

}elseif($action == "finalizar"){
	finalizar($enlace, $_GET['id'] );
}







 function create($enlace, $nombre , $codigo, $marca, $medida, $minimo)
 {
 	
 	$sql = "INSERT INTO `elemento`(`nombre`, `codigo`, `marca`, `medida`, `minimo`) 
 							VALUES ('$nombre' , '$codigo', '$marca', '$medida', $minimo)";
 	$insert = $enlace->query($sql);

 	if($insert)
 	{
 		header('location:../elementos.php');
 		$_SESSION['success'] = "el registro a sido guardado";
 	}else{
 		echo "erro al crear registro";
 	}
 }


 function edit($enlace, $id)
 {
 	$sql = "SELECT * FROM elemento WHERE id = $id";
 	$consulta = $enlace->query($sql);
 	$reg = $consulta->fetch_object();
 	echo json_encode($reg);
 }


function update($enlace, $nombre , $codigo, $marca, $medida, $minimo, $id)
{
  	$sql= "UPDATE `elemento` SET `nombre`='$nombre',`codigo`='$codigo',`marca`='$marca',`medida`='$medida',`minimo`= $minimo WHERE id=$id";
  	$update = $enlace->query($sql);
  	if($update)
  	{
 		header('location:../elementos.php');
 		$_SESSION['success'] = "el registro a sido Editado";
 	}else{
 		echo "erro al editar registro";
 	}
}

function delete($enlace, $id )
{
	$sql = "UPDATE `elemento` SET `anulado`=1 WHERE  id = $id";
	$destroy = $enlace->query($sql);
	if($destroy)
  	{
 		header('location:../elementos.php');
 		$_SESSION['success'] = "el registro a sido Eliminado";
 	}else{
 		echo "erro al borrar registro";
 	}
}
?>