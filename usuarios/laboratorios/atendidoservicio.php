<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../error1.php");
}
include('../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==3){

//___________________________________________________________


$id=$_POST['id'];



$sqlconsultar= "SELECT atendido, servicio_cita FROM servicio WHERE id_servicio=$id";
$consulta = $enlace->query("$sqlconsultar");
$reg = $consulta->fetch_object();
$estado=$reg->atendido;
$citaestado=$reg->servicio_cita;

//if($estado==0){

  $sqlEditar =  "UPDATE servicio SET  atendido=1 WHERE id_servicio=$id"; 
     $editar = $enlace->query($sqlEditar);

  $editarcita="UPDATE cita SET atendido='SI' WHERE id_cita=$citaestado";
    $editar2=$enlace->query($editarcita);
  //    }
      //___________________________________________
/*$sqlconsultarcitas="SELECT atendido, servicio_cita FROM servicio WHERE servicio_cita=$citaestado";
$consultarcitas =$enlace->query($sqlconsultarcitas);

$contadorestado=0;
$suma=0;

while($reg2 = $consultarcitas->fetch_object()){
$estado=$reg2->atendido;

$contadorestado=$contadorestado+1;
$suma=$suma+$estado;
$cita2=$reg2->servicio_cita;


if($contadorestado==$suma){
    
       
      }}*/
    //_________________________________________________ 
$sql_fecha="SELECT DISTINCT  ff FROM cita  ORDER BY id_cita DESC LIMIT 0,2";   
$consulta_fecha= $enlace->query($sql_fecha);   
?>

<div id="cuadro-tabla" class="row col-md-12 tabla col-sm-6 col-xs-4">       
      <div class="col-md-12" id="citas">
    <table class="example table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:40px;" >No.</th>
                        <th style="width:40px;" >#</th>
                        <th style="width:130px;">Fecha</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th style="width:115px;" >Edad</th>
                        <th>Servicio</th>
                       <th>Estado</th>
                       <th><label class=" glyphicon glyphicon-th"></label></th>
                    </tr>
                </thead>
                <div id="cuadro-servicio"></div>

                  <tbody>
                    <?php
                          
                    while($reg_consulta = $consulta_fecha->fetch_object()){ 
                    $contador=0;
                    $fecha=$reg_consulta->ff;
                 //_____________________________________________________________

                    $sql="SELECT paciente.*, cita.* FROM paciente,cita
                         WHERE paciente.id_paciente=cita.cita_paciente AND ff='$fecha'";
                    $consulta = $enlace->query($sql);  

                    while($reg = $consulta->fetch_object())


                          
                   {     
                          $contador=$contador+1;
                          if($contador==1){$indice="style='background:#FFD92E;'";}else{$indice="";}

                          $id_cita=$reg->id_cita;
                          $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                          WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                          $consulta_cita = $enlace->query($sql_cita);  

                            $ffnac=$reg->ff_nac;
                            $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                            $nac=$enlace->query($nac);
                            $nac=$nac->fetch_object();
                            $age=  $nac->edad/365.25 ;
                            
                            $sqlconsultar= "SELECT atendido FROM servicio WHERE servicio_cita=$id_cita";
                           $consulta2 = $enlace->query("$sqlconsultar");

                           $contadornumber=0;
                           $suma=0;

                           while($reg_ser = $consulta2->fetch_object()){
                           $estado=$reg_ser->atendido;

                           $contadornumber=$contadornumber+1;
                           $suma=$suma+$estado;
                           }

                           if($contadornumber==$suma){
                               $hhAtendido="btn-success";$colorAtendido='class="atendido"';
       
                                 }else{
                           
                              $hhAtendido="btn-danger"; $colorAtendido='class="c'.$reg->id_cita.'"';

                                 }
                  


                    ?>

                         <tr>
                        
                          <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td>
                          <td <?php echo $indice." ".$colorAtendido; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td> 
                          <td id="tdff<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copyff(<?php echo $reg->id_cita; ?>);"><label id="la<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></label></a></td>
                          <td id="tdcc<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copycc(<?php echo $reg->id_cita; ?>);"><label id="lb<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding('ID:'.$reg->num_dc, "UTF-8")?></label></a></td>
                          <td id="tdnm<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copynm(<?php echo $reg->id_cita; ?>);"><label id="lc<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></label></a></td>
                          <td id="tdage<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copyage(<?php echo $reg->id_cita; ?>);"><label id="ld<?php echo $reg->id_cita; ?>"><?php echo floor($age).' años'; ?></label></a></td>
                          <td id="tddoc<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><?php while($cita = $consulta_cita->fetch_object()){echo '<a href="javascript:copydoc('.$reg->id_cita.');">('.$cita->cantidad.' '.$cita->nom_examen.' - <label id="le'.$reg->id_cita.'">'.$cita->nom_doctor.'</label>)</a>  '; } ?></td>
                          <td><a href="javascript:atendido(<?php echo $reg->id_cita; ?>);"  id="n<?php echo $reg->id_cita; ?>" class="btn <?php echo $hhAtendido; ?>"><?php echo mb_convert_encoding($reg->atendido, "UTF-8")?></a href="javascript:hhsalida(<?php echo $reg->id_cita; ?>);" ></td>
                          <td><a href="javascript:repetir(<?php echo $reg->id_cita; ?>);" id="repetir"  class="glyphicon glyphicon-th"></a>  
                          </td>

                          </tr>
                     
                        <?php }} ?>
                </tbody>
            </table>
            </div>
</div>
 <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>




<?php 
 }else{
  header("Location:../../error3.php");

}?>