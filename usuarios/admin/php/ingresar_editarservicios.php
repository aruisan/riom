<?php 
include('../../../cp/conexion.php');


$id=$_POST['id'];
$cita=$_POST['cita'];
$examen=$_POST['examen'];
$doctor=$_POST['doctor'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$year = $_POST['year'];

$sql_cambiar = "UPDATE servicio SET examen=$examen, doctor=$doctor, cantidad=$cantidad, precio=$precio, servicio_cita=$cita  WHERE id_servicio=$id";
$cambiar = $enlace->query($sql_cambiar);

$sql_dr= "SELECT * FROM dr";
$consulta_dr= $enlace->query($sql_dr);

$sql="SELECT paciente.*, cita.*,usuario.nick FROM paciente,cita,usuario
      WHERE paciente.id_paciente=cita.cita_paciente 
      AND usuario.id_usuario=cita.responsable AND ff='$year'";
$consulta = $enlace->query($sql);

?>
<div class="col-lg-10" >
      <div class="panel panel-default">
        <div class="panel-heading" style="background:#207ce5;">
          <center class="bg-info"> <b>Cuadro de Citas</b>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
          <div class="">
            <div class="container-fluid">
              <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width="40" >No.</th>
                    <th width="40"  >#</th>
                    <th>Fact.</th>
                    <th width="40" >Fecha</th>
                    <th>Nombre</th>
                    <th>Servicio</th>
                    <th>Efectivo</th>
                    <th>Credito</th>
                    <th>Total</th>
                    <th>Usuario</th>
                    <th><img src="iconos/borrar-blanco.png" style="width:20px;"></th>
                    <th><img src="iconos/cre-blanco.png" style="width:20px;"></th>
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


                    $cancelar=$reg->anulado;
                            if($cancelar=="NO"){
                              $td_cancelar="borrar-azul";
                            }else{$td_cancelar="borrar-rojo";}

                     

                    $factura= $reg->factura; 

                    ?>

                    <tr>
                        
                      <td class="items" ><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td> 
                      <td <?php echo $indice; ?> ><a href="javaScript:editarFactura(<?php echo $reg->id_cita; ?>)" id="factura<?php echo $reg->id_cita; ?>">
                            <?php echo mb_convert_encoding($factura, "UTF-8")?></a></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></td>
                      <td <?php echo $indice; ?> ><a href="javaScript:editarServicios(<?php echo $reg->id_cita; ?>)"><?php while($cita = $consulta_cita->fetch_object()){echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.')  '; } ?></a></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $efectivo->total, "UTF-8") ?></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $credito->total_credito, "UTF-8") ?></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $total->totales, "UTF-8") ?></td>
                      <td <?php echo $indice; ?> ><?php echo mb_convert_encoding( $reg->nick, "UTF-8") ?></td>
                      <td><div id="cancelar<?php echo $reg->id_cita; ?>"><a href="javascript:cancelar(<?php echo $reg->id_cita; ?>)"><img src="iconos/<?php echo $td_cancelar; ?>.png" style="width:20px;"></a></div></td>
                      <td><a href="javascript:credito(<?php echo $reg->id_cita; ?>)"><img src="iconos/cre-azul.png" style="width:20px;"></a></td>
                    </tr>
                     
                    <?php }//} ?>
                  </tbody>
                </table>
              </div>
            </div><!-- /dataTable_wrapper -->
          </div> <!-- /.panel-body   -->                    
        </div><!-- /.panel -->
      </div>
    </div>
 <script>

      $(document).ready(function() {
         $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
         //________________________________________
        $(".ocultar").click(function(){

        $("#cuadro-reportes").hide('low');
        $("#cuadro-editarFactura").hide('low');

        });
         //-------------------------------
        } );
     </script> 