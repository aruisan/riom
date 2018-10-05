<?php 
session_start();

$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rips$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel="SELECT paciente.*, servicio.*, examen.cubs, cita.id_cita, cita.ff, cita.factura FROM paciente,servicio,cita,examen 
			WHERE MONTH(cita.ff)=$mes AND YEAR(cita.ff)=$year AND cita.cita_paciente=paciente.id_paciente 
      AND cita.id_cita=servicio.servicio_cita AND servicio.examen=examen.id_examen AND cita.anulado='NO' 
      AND cita.factura>0 order by id_servicio";
$consulta_excel=$enlace->query($sql_excel);


?>


<div >
<table style="color:#000099; width:60%" border="1" >
	<thead>
  <tr>
    <th  align="center">No.</th>
    <th  align="center">Fecha</th>
    <th  align="center">Tipo Doc.</th>
    <th  align="center">No. Doc.</th>
    <th  align="center">Nombre1</th>
    <th  align="center">Nombre2</th>
    <th  align="center">Apellido1</th>
    <th  align="center">Apellido2</th>
    <th  align="center">Fecha de Nacimiento</th>
    <th  align="center">Edad</th>
    <th  align="center">Sexo</th>
    <th  align="center">Cubs</th>
    <th  align="center">Nit</th>
    <th  align="center">No. secreto</th>
    <th  align="center">Cantidad</th>
    <th  align="center">Valor</th>
    <th  align="center">total</th>
    <th  align="center">#Factura</th>
  </tr>
  </thead>

  <tbody>
  	<?php while($reg=$consulta_excel->fetch_object()){ 


                            $ffnac=$reg->ff_nac;
                            $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                            $nac=$enlace->query($nac);
                            $nac=$nac->fetch_object();
                            $age=  $nac->edad/365.25 ;

                     $total=$reg->cantidad*$reg->precio;

  		?>
<tr><td><?php echo mb_convert_encoding($reg->id_servicio, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->tipo_dc, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->num_dc, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->nom_1, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->nom_2, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->ape_1, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->ape_2, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->ff_nac, "UTF-8")?></td>
	<td><?php echo floor($age);?></td>
	<td><?php echo mb_convert_encoding($reg->sexo, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->cubs, "UTF-8")?></td>
	<td>808003702-7</td>
	<td>253070026301</td>
	<td><?php echo mb_convert_encoding($reg->cantidad, "UTF-8")?></td>
	<td><?php echo mb_convert_encoding($reg->precio, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($total, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($reg->factura, "UTF-8")?></td>

</tr>

<?php } ?>
  </tbody>
</table >
</div>
