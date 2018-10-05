<?php
session_start();
require_once('../../../cp/conexion.php');

/*$_POST['action'] = "indexMovimientos";
$_POST['id'] = 1;*/



if(isset($_POST['action']))
{
	$action = $_POST['action'];
}else{
	$action = $_GET['action'];
}


if($action == "edit"){
	edit($enlace, $_POST['id']);

}elseif($action == "create"){
	create($enlace, $_POST['id_elemento'] , $_POST['cantidad'], $_POST['ffhh'], $_POST['ff_vencimiento'], $_POST['lote']);

}elseif($action == "update"){
	update($enlace, $_POST['id_elemento'] , $_POST['cantidad'], $_POST['ffhh'], $_POST['ff_vencimiento'], $_POST['id'], $_POST['idM']);


}elseif($action == "delete"){
	delete($enlace, $_GET['id'] );

}elseif($action == "finalizar"){
	finalizar($enlace, $_GET['id'] );

}elseif($action == "movimientos"){
	movimientos($enlace, $_POST['id']);

}elseif($action == "salida"){
	salida($enlace, $_POST['id_inventario'], $_POST['cantidad'] );
}







 function create($enlace, $id_elemento , $cantidad, $ffhh, $ff_vencimiento, $lote)
 {
 	$sql = "INSERT INTO `inventario`(`ffhh`, `id_elemento`, `ff_vencimiento`, lote) 
 							VALUES ('$ffhh', $id_elemento, '$ff_vencimiento', '$lote')";
 	$insert = $enlace->query($sql);
 	echo $insert;

 	if($insert)
 	{
 		$id = $enlace->insert_id;
 		$sql2 = "INSERT INTO `movimientos`( `cantidad`, `id_inventario`, ffhh) VALUES ($cantidad, $id,'$ffhh')";
 		$insert2 = $enlace->query($sql2);

 		if($insert2)
 		{
 		header('location:../');
 		$_SESSION['success'] = "el registro a sido guardado";
	 	}else{
	 		echo "erro al crear movimiento";
	 	}
 	}else{

 		echo "erro al crear stock";
 	}

 }


 function edit($enlace, $id)
 {
 	$sql = "SELECT i.*, m.cantidad, m.id as idM, e.nombre
			FROM inventario i, movimientos m, elemento e 
			WHERE i.id = 5 
			AND i.id = m.id_inventario 
			AND e.id = i.id_elemento
			LIMIT 1";
 	$consulta = $enlace->query($sql);
 	$reg = $consulta->fetch_object();
 	echo json_encode($reg);
 }


function update($enlace, $id_elemento , $cantidad, $ffhh, $ff_vencimiento, $id, $idM)
{
  	$sql= "UPDATE `inventario` SET `ffhh`='$ffhh',`id_elemento`=$id_elemento,`ff_vencimiento`='$ff_vencimiento' WHERE id = $id";
  	$update = $enlace->query($sql);

  	if($update)
 	{
 		$sql2 = "UPDATE `movimientos` SET cantidad=$cantidad WHERE id = $idM";
 		$update2 = $enlace->query($sql2);

 		if($update2)
 		{
 		header('location:../');
 		$_SESSION['success'] = "el registro a sido Editado";
	 	}else{
	 		echo "erro al editar movimiento";
	 	}
 	}else{

 		echo "erro al editar stock";
 	}
}

function movimientos($enlace, $id)
{
	$sql ="SELECT m.*, DATE(i.ffhh) AS lote, DATE(m.ffhh) AS fecha
			from movimientos m, inventario i 
			where m.id_inventario = i.id 
			AND i.id = $id";
	$consulta = $enlace->query($sql);

	include_once('tabla_movimientos.php');
}

function salida($enlace, $id, $cantidad )
{
	$cant = $cantidad*-1;
	date_default_timezone_set('America/Bogota'); 
	$ffhh  =  date('Y-m-d H:m:s');
	$sql2 = "INSERT INTO `movimientos`( `cantidad`, `id_inventario`, ffhh) VALUES ($cant, $id,'$ffhh')";
 	$insert2 = $enlace->query($sql2);
 	if($insert2)
 	{
 		header('location:../movimientos.php?id_elemento='.$_SESSION['id_elemento']);
 		$_SESSION['success'] = "el registro a sido guardado";
	}else{
	 	echo "erro al crear movimiento";
	}
}

?>