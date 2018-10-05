<?php 
session_start();
$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=repetidas$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel="SELECT paciente.*, servicio.*, cita.*, examen.nom_examen, dr.* FROM paciente,servicio,cita,examen,dr
           WHERE MONTH(cita.ff)=$mes AND YEAR(cita.ff)=$year AND cita.cita_paciente=paciente.id_paciente 
           AND cita.id_cita=servicio.servicio_cita AND servicio.examen=examen.id_examen AND servicio.repetir>0 AND servicio.doctor=dr.id_doctor AND cita.anulado='NO'";
$consulta_excel=$enlace->query($sql_excel);


?>


<div >
<table style="color:#000099; width:60%" border="1" >
	<thead>
  <tr>
    <th  align="center">No.</th>
    <th  align="center">Fecha</th>
    <th  align="center">Documento</th>
    <th  align="center">Nombre Completo</th>
    <th  align="center">Examen</th>
    <th  align="center">Repetidas</th>
    <th  align="center">Observacion</th>
    <th  align="center">Doctor</th>
  </tr>
  </thead>

  <tbody>
  	<?php $contador=1;
    while($reg=$consulta_excel->fetch_object()){ 


                  


  		?>
<tr><td><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->tipo_dc.' '.$reg->num_dc, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->nom_examen, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->repetir, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->obs_repetir, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->nom_doctor, "UTF-8")?></td>

</tr>

<?php   $contador++; } ?>
  </tbody>
</table >
</div>