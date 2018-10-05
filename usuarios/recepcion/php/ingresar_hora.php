
<?php 
include('../../../cp/conexion.php');

$id=$_POST['id'];
$h1=$_POST['h1'];
$h2=$_POST['h2'];
$h3=$_POST['h3'];
$fecha = $_POST['year'];

$sql="UPDATE cita SET hh_llegada='$h1', hh_toma='$h2', hh_salida='$h3' where id_cita=$id";
$ingresar= $enlace->query($sql);
/*
echo $id."<br>";
echo $h1."<br>";
echo $h2."<br>";
echo $h3."<br>";
echo $ffhh;   */  

$sql="SELECT paciente.*, cita.*,usuario.nick FROM paciente,cita,usuario
        WHERE paciente.id_paciente=cita.cita_paciente 
        AND usuario.id_usuario=cita.responsable AND ff='$fecha'";
$consulta = $enlace->query($sql);
?>

<div class="col-lg-11">
    <div class="panel panel-default">
      <div class="panel-heading" style="background:#207ce5;">
        <center class="bg-info"> <b>Cuadro de Citas</b>
        </center>
      </div>
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <div class="container-fluid">
            <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style="width:40px;" >No.</th>
                  <th style="width:40px;" >#</th>
                  <th style="width:100px;">Fecha</th>
                  <th>Nombre</th>
                  <th>Servicio</th>
                  <th>Efectivo</th>
                  <th>Credito</th>
                  <th>Total</th>
                  <th>Usuario</th>
                  <th><label class="glyphicon glyphicon-time"></label></th>
                  <th><label class="glyphicon glyphicon-tasks"></label></th>
                  <th><img src="iconos/obs.png" style="width:20px;"></th>
                  <th>Fact.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      $contador=0;
                      while($reg = $consulta->fetch_object())
                      {     
                        $contador=$contador+1;
                        if($contador==1){$indice="style='background:#FFD92E;'";}else{$indice="";}

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
                          if($hh_salida=="00:00:00")
                          {
                            $reloj="glyphicon-time";
                          }else{$reloj="";}

                        $factura= $reg->factura;
                          if($factura==0){$td_factura='<div id="factura'.$reg->id_cita .'"><a href="javascript:fact('.$reg->id_cita.' )"><img src="iconos/fact.png" style="width:20px;"></a></div>';
                          }elseif($factura>0){$td_factura='<center><label class="text-warning">'.$factura.'</label></center>';}  
                ?>
                <tr>     
                  <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td> 
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></td>
                  <td <?php echo $indice; ?> ><?php while($cita = $consulta_cita->fetch_object()){echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.')  '; } ?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $efectivo->total, "UTF-8") ?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $credito->total_credito, "UTF-8") ?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $total->totales, "UTF-8") ?></td>
                  <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $reg->nick, "UTF-8") ?></td>
                  <td><a href="javascript:hhsalida(<?php echo $reg->id_cita; ?>);"  class="glyphicon <?php echo $reloj; ?> " id="n<?php echo $reg->id_cita; ?>"></a></td>
                  <td><a href="javascript:ver(<?php echo $reg->id_cita; ?>)"  class="glyphicon glyphicon-tasks"></a></td>
                  <td><a href="javascript:obs(<?php echo $reg->id_cita; ?>)"><img src="iconos/obsa.png" style="width:20px;"></a></td>
                  <td><?php echo $td_factura; ?></td>
                </tr>
                     
            <?php } ?>
            </tbody>
          </table>
        </div><!-- /.table-responsive -->
      </div><!-- /.panel-body -->       
     </div><!-- /.panel -->           
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->

  <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>