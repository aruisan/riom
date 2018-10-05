
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../error1.php");
}
include('../../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==2){
  //_____________________________________________________________


if (empty($_POST['credito'])){
	$credito="no";
		}else{$credito="si";}


if (empty($_POST['enviar'])){
	$enviar="no";
		}else{$enviar="si";}

$id=$_POST['id'];
$id3=$_SESSION['paciente'];
$id2=$_POST['id2'];
$doctor=$_POST['doctor'];
$examen=$_POST['examen'];
$precio=$_POST['precio'];
$cantidad = $_POST["cantidad"];

$_SESSION['cc']=$id;
$idu=$_SESSION['id'];


echo $doctor.' - exa='.$examen.' -id='.$id.' -pre='.$precio.' -cant='.$cantidad.' -id2='.$id2;

  $sql =  "INSERT INTO servicio (doctor, examen, precio, cantidad,  credito, enviar, servicio_cita )
              VALUES ('$doctor', '$examen', '$precio', '$cantidad', '$credito', '$enviar', '$id2')"; 
     $insertar = $enlace->query($sql);

 ?>


  <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:40px;">No.</th>
                        <th style="width:100px;"><center>Fecha</center></th>
                        <th><center>servicios</center></th>
                        <th style="width:100px;"><center>Efectivo</center></th>
                        <th style="width:100px;"><center>Creditos</center></th>
                        <th  style="width:60px;"><label class="glyphicon glyphicon-plus "></label> <label class="glyphicon glyphicon-time"></label> </th>
                    </tr>
                </thead>
                  <tbody>
                    <?php
                       
                          $sql="SELECT * FROM cita WHERE cita_paciente=$id3";
                          $consulta = $enlace->query($sql);   
                           while($reg = $consulta->fetch_object()){

                            $hh_salida=$reg->hh_salida;
                            if($hh_salida=="00:00:00"){
                              $reloj="glyphicon-time";
                            }else{$reloj="";}

                    $id_cita=$reg->id_cita;
                    $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                    WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                    $consulta_cita = $enlace->query($sql_cita);  
                    
                    $sql_suma="SELECT SUM(precio*cantidad) AS total FROM servicio WHERE servicio_cita=$id_cita AND credito='no'";
                    $consulta_suma=$enlace->query($sql_suma);
                    $total=$consulta_suma->fetch_object();

                    $sql_credito="SELECT SUM(precio*cantidad) AS total_credito FROM servicio WHERE servicio_cita=$id_cita AND credito='si'";
                    $consulta_credito=$enlace->query($sql_credito);
                    $credito=$consulta_credito->fetch_object();

                    ?>

                         <tr>
                            <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td> 
                           <td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
                          <td><?php while($cita = $consulta_cita->fetch_object()){
                            $enviar2=$cita->enviar;
                            if ($enviar2=="si"){ $enviar="enviar";}else{$enviar="no enviar";}

                           echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.' - '.$enviar.')  '; } ?></td>
                           <td><?php echo mb_convert_encoding( $total->total, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $credito->total_credito, "UTF-8") ?></td>
                           <td><a href="javascript:servicio(<?php echo $reg->id_cita; ?>);" class="glyphicon glyphicon-plus text-success"></a>
                                <a href="javascript:hhsalida(<?php echo $reg->id_cita; ?>);"  class="glyphicon <?php echo $reloj; ?> " id="n<?php echo $reg->id_cita; ?>"></a> </td>

                          
                       

                          </tr>
                     
                        <?php } ?>
                </tbody>
            </table>
            <?php }else{
  header("Location:../../../error2.php");

}
      

?>