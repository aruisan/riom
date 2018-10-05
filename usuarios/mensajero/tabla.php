<?php

include('../../cp/conexion.php');

$fecha = $_POST['year'];

$sql_consulta="SELECT cita.*, servicio.*, examen.nom_examen, dr.nom_doctor, paciente.*, usuario.nick 
FROM servicio,examen,dr, cita, paciente,usuario WHERE servicio.examen=examen.id_examen 
AND servicio.doctor=dr.id_doctor AND servicio.servicio_cita=cita.id_cita AND cita.cita_paciente=paciente.id_paciente 
AND cita.responsable=usuario.id_usuario AND ff='$fecha' AND enviar='si'";
$consulta = $enlace->query($sql_consulta);  
?>

 <div class="col-md-12" id="citas">
    <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr><th>No.</th>
                        <th>Turno</th>
                        <th>Fecha</th>
                        <th >Paciente</th>
                        <th>Doctor</th>
                        <th>Examen</th>
                        <th>Responsable</th>
                        <th style="width:45px;"><center><img src="iconos/mail.png" style="width:30px;"></center></th> 
                    </tr>
                </thead>
                  <tbody>
                    <?php                    
                    $contador=0;

                    while($reg = $consulta->fetch_object())
            
                   { $contador=$contador+1;
                    $entregado=$reg->mensajero;
                     if($entregado>0){$entregado2="btn-success";}elseif($entregado==0){$entregado2="btn-danger";}
                     if($contador==1){$indice="style='background:#FFD92E;'";}else{$indice="";}
                      ?>

                         <tr>
                            <td class="items" style="width:40px;"><?php echo mb_convert_encoding($reg->id_servicio, "UTF-8")?></td> 
                            <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td> 
                            <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td> 
                           <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8")?></td>
                          <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nom_doctor, "UTF-8") ?></td>
                          <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nom_examen, "UTF-8")?></td>
                          <td <?php echo $indice; ?> ><?php echo mb_convert_encoding($reg->nick, "UTF-8")?></td>
                         <td><a href="javascript:enviado(<?php echo $reg->id_servicio; ?>);"  id="n<?php echo $reg->id_servicio; ?>" class="btn <?php echo $entregado2; ?>">
                          <img src="iconos/mail.png" style="width:23px;"></a></td>
  

                          </tr>
                     
                        <?php }?>
                </tbody>
            </table>
            </div>

<script>
        $(document).ready(function() {
 

        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });


//-------------------------final
        } );

</script>