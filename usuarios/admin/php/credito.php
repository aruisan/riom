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


if($reg->tipo==1){
//_____________________________________________________________________

$id=$_POST['id'];

$sql_con="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM cita,servicio,examen,dr WHERE id_cita=$id AND cita.id_cita=servicio.servicio_cita AND dr.id_doctor=servicio.doctor AND examen.id_examen=servicio.examen";
$consulta=$enlace->query($sql_con);

       
?>
<center> 
<button tyle="button" class="close btn btn-danger" id="ocultar">&times;</button>
<table class="table table-condensed  table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%"><thead>
<tr><th><center>Examen</center></th> 
    <th><img src="iconos/cre-blanco.png" style="width:20px;"></th></tr>
</thead>
<tbody>
<?php while($reg=$consulta->fetch_object()){ 

 $credito=$reg->credito;
                            if($credito=="no"){
                              $td_credito="cre-rojo";
                            }else{$td_credito="cre-verde";}
 ?>

<tr>
<td><?php echo mb_convert_encoding($reg->nom_examen, "UTF-8")?></td>
<td  style="width:50px;"><div id="credito<?php echo $reg->id_servicio; ?>"><a href="javascript:editarCredito(<?php echo $reg->id_servicio; ?>)"><img src="iconos/<?php echo $td_credito; ?>.png" style="width:20px;"></a></div></td>
</tr>


<?php } ?>


</tbody>
 </table>
<label style="margin-left:10px;">Credito <img src="iconos/cre-verde.png" style="width:20px;"> </label> <label> No Credito <img src="iconos/cre-rojo.png" style="width:20px;"></label>
</center>
<script type="text/javascript">
$(document).ready(function(){
$("#ocultar").click(function(){
	$("#cuadro-credito").hide("low");

});

});

//________________________________________
function editarCredito(id){
        var url = "php/editar_credito.php"; // El script a dónde se realizará la petición.
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#credito"+id).html(data);

           }

  
   });
           

}
</script>

<?php
//cierre de el while
 }else{
  header("Location:../../../error3.php");

}?>