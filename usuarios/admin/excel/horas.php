<?php 
session_start();
$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Tiempos$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel="SELECT cita.*,paciente.* FROM cita,paciente WHERE MONTH(cita.ff)=$mes AND YEAR(cita.ff)=$year 
            AND cita.cita_paciente=paciente.id_paciente AND cita.anulado='NO'";
$consulta_excel=$enlace->query($sql_excel);

$sql_cifra="SELECT count(id_cita) AS cifra FROM cita,paciente WHERE MONTH(cita.ff)=$mes AND YEAR(cita.ff)=$year AND cita.cita_paciente=paciente.id_paciente AND cita.anulado='NO'";
$consulta_cifra=$enlace->query($sql_cifra);
$reg_cifra=$consulta_cifra->fetch_object();




?>


<div >
<table style="color:#000099; width:60%" border="1" >
  <thead>
  <tr>
    <th  align="center">Cita.</th>
    <th  align="center">Fecha</th>
    <th  align="center">Nombre Completo</th>
    <th  align="center">hToma - hLlegada</th>
    <th  align="center">hSalida - hToma</th>
    <th  align="center">hSalida - hLlegada</th>
  </tr>
  </thead>

  <tbody>
    <?php $contador=0; $contador1=0; $contador2=0;

    $cifra=$reg_cifra->cifra;

    while($reg=$consulta_excel->fetch_object()){ 
      $cita=$reg->id_cita;
      

      $sql_h1="SELECT TIME_TO_SEC(hh_toma) - TIME_TO_SEC(hh_llegada)  as hora1 from cita where id_cita=$cita";
      $consulta_h1=$enlace->query($sql_h1);
      $reg_h1=$consulta_h1->fetch_object();
      $hora1=$reg_h1->hora1/60;

         $sql_h2="SELECT TIME_TO_SEC(hh_salida) - TIME_TO_SEC(hh_toma)  as hora2 from cita where id_cita=$cita";
      $consulta_h2=$enlace->query($sql_h2);
      $reg_h2=$consulta_h2->fetch_object();
      $hora2=$reg_h2->hora2/60;

         $sql_h3="SELECT TIME_TO_SEC(hh_salida) - TIME_TO_SEC(hh_llegada)  as hora3 from cita where id_cita=$cita";
      $consulta_h3=$enlace->query($sql_h3);
      $reg_h3=$consulta_h3->fetch_object();
      $hora3=$reg_h3->hora3/60;            


      ?>
<tr><td><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($hora1, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($hora2, "UTF-8")?></td>
  <td><?php echo mb_convert_encoding($hora3, "UTF-8")?></td>

</tr>


<?php   $contador=$contador+$hora1; $contador1=$contador1+$hora2; $contador2=$contador2+$hora3;}    

      $sql_p1=" SELECT AVG(TIME_TO_SEC(hh_toma) - TIME_TO_SEC(hh_llegada))  as phora1 from cita";
      $consulta_p1=$enlace->query($sql_p1);
      $reg_p1=$consulta_p1->fetch_object();
      $pro1=$reg_p1->phora1/60; ?>

<tr><td></td><td></td><td>Promedios</td><td><?php echo floor($contador/$cifra)?></td><td><?php echo floor($contador1/$cifra)?></td><td><?php echo floor($contador2/$cifra)?></td></tr>
  </tbody>

</table >
</div>




