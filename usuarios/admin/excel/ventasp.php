<?php 
session_start();

$year=$_SESSION['year'];
$mes=$_SESSION['mes'];

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ventas$year/$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../../../cp/conexion.php');

$sql_excel="SELECT paciente.*, cita.*,usuario.nick FROM paciente,cita,usuario
      WHERE paciente.id_paciente=cita.cita_paciente 
      AND usuario.id_usuario=cita.responsable AND MONTH(cita.ff)=$mes AND YEAR(cita.ff)=$year AND cita.anulado='NO'";
$consulta_excel=$enlace->query($sql_excel);

$sql_gastos="SELECT gastos.*, precio*cantidad AS total_gasto, usuario.nick FROM gastos,usuario WHERE MONTH(gastos.fecha)=$mes AND YEAR(gastos.fecha)=$year  
              AND gastos.usuario=usuario.id_usuario";
$consulta_gastos=$enlace->query($sql_gastos);

?>
<div >
<table style="color:#000099; width:60%" border="1" >
  <thead>
    <tr><td colspan="11"> <center>Cuadro de Reportes de Entradas del dia <?php echo $year; ?></center></td></tr>
                    <tr>
                        <th style="width:40px;" >No.</th>
                        <th style="width:100px;">Fecha</th>
                        <th>Nombre</th>
                        <th colspan="4">Servicio</th>
                       <th>Efectivo</th>
                       <th>Credito</th>
                       <th>Total</th>
                       <th>Usuario</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php $contador=0; $contador1=0; $contador2=0; $numero=1;
                          
                    while($reg = $consulta_excel->fetch_object())


            
                   {   

                      $id_cita=$reg->id_cita;
                          $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                          WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                          $consulta_cita = $enlace->query($sql_cita);  
                       
                        $sql_suma="SELECT SUM(precio*cantidad) AS total FROM servicio WHERE servicio_cita=$id_cita AND credito='no'";
                    $consulta_suma=$enlace->query($sql_suma);
                    $efectivo=$consulta_suma->fetch_object();

                    $sql_credito="SELECT SUM(precio*cantidad) AS total_credito FROM servicio WHERE servicio_cita=$id_cita AND credito='si'";
                    $consulta_credito=$enlace->query($sql_credito);
                    $credito=$consulta_credito->fetch_object();
          
                    $sql_total="SELECT SUM(precio*cantidad) AS totales FROM servicio WHERE servicio_cita=$id_cita ";
                    $consulta_total=$enlace->query($sql_total);
                    $total=$consulta_total->fetch_object();


                     $hh_salida=$reg->hh_salida;
                            if($hh_salida=="00:00:00"){
                              $reloj="glyphicon-time";
                            }else{$reloj="";}
                    ?>

                         <tr>
                        
                          <td class="items"><?php echo mb_convert_encoding($numero, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></td>
                          <td colspan="4"><?php while($cita = $consulta_cita->fetch_object()){echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.')  '; } ?></td>
                          <td><?php echo mb_convert_encoding( $efectivo->total, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $credito->total_credito, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $total->totales, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $reg->nick, "UTF-8") ?></td>

                          </tr>
                     
                        <?php   
                    $numero=$numero+1; $contador=$contador+$efectivo->total; $contador1=$contador1+$credito->total_credito; $contador2=$contador2+$total->totales;}   ?>

<tr><td colspan="6"></td><td>Totales</td><td><?php echo mb_convert_encoding($contador, "UTF-8")?></td><td><?php echo mb_convert_encoding($contador1, "UTF-8")?></td><td><?php echo mb_convert_encoding($contador2, "UTF-8")?></td></tr>
  
                </tbody>
</table >
<br><br><br>
<table style="color:#000099; width:60%" border="1" >
  <thead>
    <tr><td colspan="7"> <center>Cuadro de Reportes de Gastos del dia <?php echo $year; ?></center> </td></tr>
                    <tr>
                        <th style="width:40px;" >No.</th>
                        <th style="width:100px;">Fecha</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                       <th>Precio</th>
                       <th>Total</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php $numero=1; $numero1=0; 
                          
                    while($gastos = $consulta_gastos->fetch_object()){      

                     
                    ?>

                         <tr>
                          <td class="items"><?php echo mb_convert_encoding($numero, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($gastos->fecha, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($gastos->articulo, "UTF-8") ?></td>
                          <td><?php echo mb_convert_encoding( $gastos->cantidad, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $gastos->precio, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $gastos->total_gasto, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $gastos->nick, "UTF-8") ?></td>

                          </tr>
                     
                        <?php    $numero=$numero+1; $numero1=$numero1+$gastos->total_gasto;}   ?>

<tr><td colspan="4"></td><td colspan="2">Total de gastos <?php echo mb_convert_encoding($numero1, "UTF-8")?></td><td></td></tr>
  
                </tbody>
</table >
<br><br><br>
<table style="color:#000099; width:60%" border="1" >
  <thead>
    <tr><td colspan="5"> <center>Cuadro de Reportes de totales del dia  <?php echo $year; ?></center> </td></tr>
                    <tr>
                        <th style="width:40px;" >Efectivo.</th>
                        <th style="width:100px;">Credito</th>
                        <th>Ingresos</th>
                        <th>Gastos</th>
                       <th>Neto</th>
                    </tr>
                </thead>
                  <tbody>

                         <tr>
                          <td><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
                          <td><?php echo mb_convert_encoding($contador1, "UTF-8") ?></td>
                          <td><?php echo mb_convert_encoding( $contador2, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $numero1, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $contador-$numero1, "UTF-8") ?></td>
                          </tr>
                     
                        <?php}   ?>
  
                </tbody>
</table >
</div>