<?php 
session_start();
$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Esterilizacion$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel ="SELECT e.*, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, e.ff_inicio, e.ff_final)) horas 
            FROM esterilizacion e
            WHERE MONTH(e.ff_inicio)= $mes 
            AND YEAR(e.ff_inicio)= $year";
$consulta_excel=$enlace->query($sql_excel);

?>


<div >
<table style="color:#000099; width:60%" border="1" >
	<thead>
  <tr><td align="center" colspan="6"> <center>Cuadro de Reportes de Elementos esterilizados del mes <?php echo $year.'/'.$mes; ?></center></td></tr>
  <tr>
    <th  align="center">No.</th>
    <th  align="center">Elemento</th>
    <th  align="center">Cantidad</th>
    <th  align="center">Inicio</th>
    <th  align="center">Final</th>
    <th  align="center">Tiempo esterilizado</th>
  </tr>
  </thead>

  <tbody>
  	<?php 
      if($consulta_excel->num_rows > 0)
      {
        $contador=1;
        while($reg=$consulta_excel->fetch_object()){ 
  		?>
        <tr>
          <td><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
        	<td><?php echo mb_convert_encoding($reg->elemento, "UTF-8")?></td>
          <td><?php echo mb_convert_encoding($reg->cant, "UTF-8")?></td>
        	<td><?php echo mb_convert_encoding($reg->ff_inicio, "UTF-8")?></td>
          <td><?php echo mb_convert_encoding($reg->ff_final, "UTF-8")?></td>
        	<td><?php echo mb_convert_encoding($reg->horas, "UTF-8")?></td>
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