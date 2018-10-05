<?php 
	include('../../cp/conexion.php');

if(isset($_POST['action']))
{
	$action = $_POST['action'];
}else{
	$action = $_GET['action'];
}


if($action == "store"){
	store($enlace, $_POST['img_data']);
}elseif($action == "datosPaciente"){
	datosPaciente($enlace);
}elseif($action == "firmaLaboratorio"){
	firmaLaboratorio($enlace, $_POST['paciente_id'], $_POST['cita_id'], $_POST['nom_paciente'] );
}


function storeTotal()
{

}

 function store($enlace, $imagen)
 {
 	$reg = firma($enlace);

	$result = array();
	$imagedata = base64_decode($imagen);
	$filename = md5(date("dmYhisA"));
	$file_name = '../../imagenes/'.$reg->cita_id.'.png';

	file_put_contents($file_name,$imagedata);
	$result['status'] = 1;
	$result['file_name'] = $file_name;
	echo json_encode($result);
 }


function firma($enlace)
{
	$firma="SELECT * FROM firma ";
	$consulta = $enlace->query($firma);
	$reg = $consulta->fetch_object();
	return $reg;
}
	
//desde labratorios
function firmaLaboratorio($enlace, $paciente_id, $cita_id, $nom_paciente){
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
 		datosPaciente($enlace);
 	}
}

function datosPaciente($enlace)
{
	$firma = firma($enlace);
	$cita_id = $firma->cita_id;

	$datos="SELECT c.id_cita, p.nom_1, p.nom_2, p.ape_1, p.ape_2 
			FROM cita c, paciente p 
			WHERE c.id_cita = $cita_id
			AND c.cita_paciente = p.id_paciente";
	$consulta = $enlace->query($datos);
	$reg = $consulta->fetch_object();
	echo json_encode($reg);
}
?>