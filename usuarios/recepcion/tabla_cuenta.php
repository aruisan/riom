<?php

include('../../cp/conexion.php');

$fecha = $_POST['year'];

$sql="SELECT servicio.*, examen.nom_examen, dr.nom_doctor, cita.ff, paciente.*, usuario.nick 
      FROM servicio,examen,dr, cita, paciente,usuario WHERE servicio.examen=examen.id_examen 
      AND servicio.doctor=dr.id_doctor AND servicio.servicio_cita=cita.id_cita AND cita.cita_paciente=paciente.id_paciente 
      AND cita.responsable=usuario.id_usuario AND ff='$fecha' ";
$consulta = $enlace->query($sql);
?>

<div class="col-md-1"></div>
    <div class="col-lg-11">
      <div class="panel panel-default">
        <div class="panel-heading" style="background:#feb645;">
          <center class="bg-warning"> <b>Cuadro de Servicios</b>
        </div>
        <div class="panel-body">
          <div class="dataTable_wrapper">
            <div class="container-fluid">
              <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th style="width:40px;">No.</th>
                    <th style="width:40px;">#</th>
                    <th style="width:95px;">Fecha</th>
                    <th>Doctor</th>
                    <th>Examen</th>
                    <th>Cred.</th>
                    <th>Env.</th> 
                    <th style="width:85px;">Precio/cant.</th>
                    <th style="width:40px;"><label class=" glyphicon glyphicon-th"></label></th>
                    <th>Paciente</th>
                    <th style="width:40px;">Fac.</th>
                    <th>Usuario</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $contador=0;
                    while($reg = $consulta->fetch_object())
                   { 
                   	$contador=$contador+1;
                    if($contador==1){$indice="style='background:#FFD92E;'";}else{$indice="";}

                      $enviar=$reg->enviar;
                      $mensajero=$reg->mensajero;
                      if($enviar=="no"){$imagen="m.png"; $valor=0; 
                    }elseif($enviar=="si" && $mensajero==0){$imagen="m-no.png"; $valor=1; 
                  }else{$imagen="msi.png"; $valor=2; 
                }
            		?>
                          
                   <tr>
                 	<td class="items"><?php echo mb_convert_encoding($reg->id_servicio, "UTF-8")?></td> 
                 	<td <?php echo $indice; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
                 	<td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td> 
                	<td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->nom_doctor, "UTF-8")?></td>
               		<td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->nom_examen, "UTF-8") ?></td>
               		<td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->credito, "UTF-8")?></td>
               		<td><a href="javascript:enviar(<?php echo $reg->id_servicio; ?>)" class="btn btn-default" id="n<?php echo $reg->id_servicio; ?>">
                                  <img src="iconos/<?php echo $imagen; ?>" style="width:23px;" id="carta<?php echo $reg->id_servicio; ?>"></a></td>
                    <td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->precio."(".$reg->cantidad.")", "UTF-8")?></td>
                    <td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->repetir, "UTF-8")?></td>
                    <td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8")?></td>
                    <td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->servicio_cita, "UTF-8")?></td>
                    <td <?php echo $indice; ?>><?php echo mb_convert_encoding($reg->nick, "UTF-8")?></td>
                   </tr>
                     
                   <?php } ?>
            	</tbody>
           	</table>
     	</div><!-- /.table-responsive -->
    </div><!-- /.panel-bod y -->           
 </div><!-- /.panel -->     
</div><!-- /.col-lg-12-->
</div><!-- /.row-->
             
 <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
 </script>
