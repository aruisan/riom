<?php
include('../../../cp/conexion.php');
require_once  '../../../vendor/autoload.php';




$cita_id = $_GET['cita_id'];
$cita = "SELECT * FROM cita where id_cita = $cita_id";
$consultaCita = $enlace->query($cita);
$dataCita = $consultaCita->fetch_object();

$id_paciente = $dataCita->cita_paciente;

$paciente = "SELECT * FROM paciente where id_paciente = $id_paciente";
$consultaPaciente = $enlace->query($paciente);
$dataPaciente = $consultaPaciente->fetch_object();
/*
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('America/Bogota');
$ff_actual = strftime("%A %d de %B del %Y");*/
date_default_timezone_set('America/Bogota');
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$ff_actual = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');


$cabecera = cabecera($ff_actual);
$cuerpo = cuerpo($dataPaciente, $dataCita);
$pie = pie();


$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie);
$stylesheet = file_get_contents('../../../cp/bootstrap/css/bootstrap.min.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($cuerpo);
$mpdf->Output('Consentimiento de cita-'.$dataCita->id_cita.'.pdf', 'I');


function cabecera($ff_actual)
{
	return $cabecera = "<div class='text-center'>
								<img src='../../../imagenes/logo.png' width='200'>
								<br>
								<span style='font-weight: bold;'>
									GIRARDOT - CUNDINAMARCA
								</span>
						</div>
						<br>
						<br>
						Fecha: ".$ff_actual.".";
}


function pie()
{
	return $pie = "RADIOIMAGENES ODONTOMEDICAS ltda. ||  Telefono: (031) 835-1226  ||  Direccion: Calle 19 # 8-90 B/Granada Girardot-Cundinamarca ";
}


function cuerpo($dataPaciente, $dataCita)
{  
	return $cuerpo ="<br><br><br><br><br><br><br><br><br>
	<div style='font-size: 17px;'>
	<h5 style='font-weight: bold;' class='text-center'>CONSENTIMIENTO INFORMADO </h5>
	<p class='text-justify'>
		El objetivo principal de este examen es obtener una imagen
		radiográfica de la cavidad bucal o del área del maxilar (superior
		o inferior) utilizando radiación ionizante. Las radiaciones son
		una forma de energía que será depositada en una parte de su
		organismo.
	</p>
	<p class='text-justify'>
		Los pacientes que hayan estado en radioterapias o contacto
		con radiación, deben comunicarlo al personal técnico.
	</p>
	<p class='text-justify'>
		Para las mujeres embarazadas, deben avisar de su estado y es
		necesario traer autorización del médico obstetra para la toma
		de la radiografía.
	</p>
	<p class='text-justify'>
		En general, las dosis de radiación recibidas en este tipo de
		pruebas no representan ningún peligro significativo para la
		salud. Según los conocimientos actuales, las dosis utilizadas
		en las pruebas radiológicas están muy por debajo del umbral
		peligroso y añadiendo el uso de la debida radioprotección, no
		existe peligro grave para el paciente.
	</p>
	<p class='text-justify'>
		Para las radiografías intraorales es necesario introducir en la
		boca una placa de 3 x 4 cms. que en algunos casos puede
		producir nauseas. El chaleco cuenta con protector de tiroides.
	</p>
	<p class='text-justify'>
		Para la toma de cualquier radiografía es necesario retirar todo
		objeto removible de la boca (prótesis dental, pearsing,
		retenedores, etc.).
	</p>
	<p class='text-justify'>
		Leído lo anterior, doy mi consentimiento, de manera voluntaria,
		para que me efectúen los exámenes solicitados por mi
		profesional de la salud.
	</p>
	<br>
	<br>
	<br>
	<br>
	<img src='../../../imagenes/".$dataCita->id_cita.".png' width='300'>
	<br>
	<p>".$dataPaciente->nom_1." ".$dataPaciente->nom_2." ".$dataPaciente->ape_1." ".$dataPaciente->ape_2."</p>
	<p><span style='font-weight: bold;'>".$dataPaciente->tipo_dc."</span>: ". $dataPaciente->num_dc."</p>
	</div>";

				

}

?>


