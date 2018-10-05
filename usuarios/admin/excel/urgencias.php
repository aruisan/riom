<?php 
session_start();
$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=urgencias$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel ="SELECT p.nom_1, p.nom_2, p.ape_1, p.ape_2, c.ff, c.urgencia, c.id_cita
            FROM paciente p, cita c
            WHERE MONTH(c.ff)= $mes 
            AND YEAR(c.ff)= $year
            AND urgencia <> ''
            AND c.cita_paciente = p.id_paciente";
$consulta_excel=$enlace->query($sql_excel);

?>


<div >
<table style="color:#000099; width:60%" border="1" >
	<thead>
  <tr><td align="center" colspan="8"> <center>Cuadro de Reportes de urgencias del mes <?php echo $year.'/'.$mes; ?></center></td></tr>
  <tr>
    <th  align="center">No.</th>
    <th  align="center">Fecha</th>
    <th  align="center">Paciente</th>
    <th  align="center" colspan="4">Examenes</th>
    <th  align="center">Urgencia</th>
  </tr>
  </thead>

  <tbody>
  	<?php 
      if($consulta_excel->num_rows > 0)
      {
        $contador=1;
        while($reg=$consulta_excel->fetch_object()){ 

                          $id_cita=$reg->id_cita;
                          $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                          WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                          $consulta_cita = $enlace->query($sql_cita);  
  		?>
        <tr>
          <td><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
        	<td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
        	 <td><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></td>
           <td colspan="4"><?php while($cita = $consulta_cita->fetch_object()){echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.')  '; } ?></td>
        	<td><?php echo mb_convert_encoding($reg->urgencia, "UTF-8")?></td>
        </tr>

<?php   $contador++; 

}}else{ ?>

        <tr>
          <td colspan="8" align="center" >no se encontraron resultados para esta fecha</td>
        </tr>

<?php } ?>
  </tbody>
</table >
</div>