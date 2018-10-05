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


if($reg->tipo==3){

//___________________________________________________________

$id=$_POST['id'];


  $sqlMostrar =  "SELECT servicio.*, examen.nom_examen FROM servicio,examen
  				WHERE servicio_cita=$id AND examen.id_examen=servicio.examen"; 
     $Mostrar = $enlace->query($sqlMostrar);

?>
<center> 
<button tyle="button" class="close btn btn-danger" id="ocultar">&times;</button>
<table class="table table-condensed  table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%"><thead>
<tr><th><center>Examen</center></th> 
    <th style="width:30px;"><center><label class="glyphicon glyphicon-th"></label></center></th>
    <th>Observacion</th></tr>
</thead>
<tbody>
<?php while($reg = $Mostrar->fetch_object()){ ?>  


<tr>
<td><?php echo mb_convert_encoding($reg->nom_examen, "UTF-8")?></td>
<td><input type="number" id="rep<?php echo $reg->id_servicio; ?>" value="<?php echo $reg->repetir; ?>" style="width:30px;"></td>
<td  style="width:80px;"><input type="text" id="obs<?php echo $reg->id_servicio; ?>" value="<?php echo $reg->obs_repetir; ?>"></td>
<td style="width:50px;"><a href="javascript:enviarRepetir(<?php echo $reg->id_servicio; ?>);" id="enviarRepetir">Enviar</a></td>
</tr>


<?php } ?>


</tbody>
 </table></center>
 <div id="repetirConfirmacion"></div>

 <script src="js/jquery.js"></script>
 <script type="text/javascript">

 function enviarRepetir(id){
              var obs = $('#obs'+id).val();
             var rep = $('#rep'+id).val();
             var url = 'php/ingresar_repetir.php';
    $.ajax({
    type:'POST',
    url:url,
    data:{id:id, rep:rep, obs:obs },
    success: function(valores){
        $('#repetir_servicios').html(valores).show(500);
    }
  });
  return false;

         };
 //_____________________________
  $(document).ready(function(){
        $("#ocultar").click(function(){
            $('#repetir_servicios').hide("slow");

});

         });
  
   
 </script>
 <?php
 }else{
  header("Location:../../../error3.php");

}?>