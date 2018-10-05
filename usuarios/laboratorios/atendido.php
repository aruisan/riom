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

$sqlconsultacita="SELECT hh_toma FROM cita Where id_cita=$id";
$consultacita=$enlace->query($sqlconsultacita);
$concita=$consultacita->fetch_object();

//____________________________________

if($concita->hh_toma=="00:00:00"){

  $sqlEditar =  "UPDATE cita SET hh_toma='$hora' WHERE id_cita=$id"; 
     $editar = $enlace->query($sqlEditar);
      }
$sqlcon="SELECT servicio.*, examen.nom_examen, examen.id_examen, dr.id_doctor, dr.nom_doctor FROM servicio, examen, dr, cita WHERE servicio_cita=$id AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor AND servicio.servicio_cita=cita.id_cita";
$consulta2= $enlace->query($sqlcon);


    ?>

<button type="button" class="close btn btn-danger" id="ocultar-atendidoServicio" >&times;</button><br>
 <table class="table table-condensed table-striped table-bordered dt-responsive">
 <thead>
<tr><th>Examen</th><th>Doctor</th><th style="width:50px;">cant.</th><th style="width:80px;"></th></tr>
</thead>
<tbody>
 <?php while($con=$consulta2->fetch_object()){ 
                            $hhAtendido2=$con->atendido;
                            if($hhAtendido2==0){$hhAtendido="btn-danger";}
                            else if($hhAtendido2==1){ $hhAtendido="btn-success";}

  ?> 
<tr>
<td><?php echo $con->nom_examen; ?></td>
<td><?php echo $con->nom_doctor; ?></td>
<td><?php echo $con->cantidad; ?></td>
<td><a href="javascript:atendidoservicio(<?php echo $con->id_servicio; ?>)" class="btn <?php echo $hhAtendido; ?>">Enviar</a></td>






<?php } ?>
</tbody>





 </table>
<script type="text/javascript">
  function atendidoservicio(id){
           
             var url = 'atendidoservicio.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(data){
      $("#cuadro-citas").html(data);
       
    }
  });
  return false;

         };
   //      _______________________________________

</script>
<script type="text/javascript">
$(document).ready(function(){


//_______________

$("#ocultar-atendidoServicio").click(function(){
  $("#cuadro-servicio").hide("low");

});
});




 <?php }else{
  header("Location:../../error3.php");


/*
    
*/

} ?>

                        

