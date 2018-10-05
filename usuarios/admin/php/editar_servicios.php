 <?php

 include('../../../cp/conexion.php');
$id=$_POST['id'];

$sqlconsulta="SELECT servicio.*, examen.nom_examen, examen.id_examen, dr.id_doctor, dr.nom_doctor FROM servicio, examen, dr, cita WHERE servicio_cita=$id AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor AND servicio.servicio_cita=cita.id_cita";
$consulta= $enlace->query($sqlconsulta);



 ?>
<button type="button" class="close btn btn-danger" id="ocultar-edicionServicio" >&times;</button><br>
 <table class="table table-condensed table-striped table-bordered dt-responsive">
 <thead>
<tr><th>Cita</th><th>Examen</th><th>Doctor</th><th>cant.</th><th>precio</th><th></th></tr>
</thead>
<tbody>
 <?php while($con=$consulta->fetch_object()){ ?> 
<tr>
  <td><input class="form-control" id="cita<?php echo $con->id_servicio; ?>" value="<?php echo $con->servicio_cita; ?>" style="width:70px;"></td>
<td><select class="form-control examen" id="examen<?php echo $con->id_servicio; ?>"><option value="<?php echo $con->examen; ?>" ><?php echo $con->nom_examen; ?></option>
			<?php $sqlexamen="SELECT * FROM examen";$consultaexamen = $enlace->query($sqlexamen); while($conexamen=$consultaexamen->fetch_object()){ 

        ?>
			<option value="<?php echo $conexamen->id_examen; ?>"><?php echo $conexamen->nom_examen; ?></option><?php } ?>
</select></td>
<td><select class="form-control" id="doctor<?php echo $con->id_servicio; ?>"><option value="<?php echo $con->doctor; ?>"><?php echo $con->nom_doctor; ?></option>
			<?php $sqldoctor="SELECT * FROM dr";  $consultadoctor= $enlace->query($sqldoctor); while($condr=$consultadoctor->fetch_object()){ ?>
			<option value="<?php echo $condr->id_doctor; ?>"><?php echo $condr->nom_doctor; ?></option><?php } ?>
</select></td>
<td><input id="cantidad<?php echo $con->id_servicio; ?>" class="form-control" value="<?php echo $con->cantidad; ?>" style="width:40px;"></td>
<td><input id="precio<?php echo $con->id_servicio; ?>" class="precio form-control" value="<?php echo $con->precio; ?>" style="width:80px;"></td>
<td><a href="javascript:enviarEditarServicios(<?php echo $con->id_servicio; ?>)" class="btn btn-success">Editar</a></td>
</tr>
<?php } ?>
</tbody>





 </table>

 <script type="text/javascript">
function enviarEditarServicios(id){
        var url = "php/ingresar_editarservicios.php";
        var cita = $("#cita"+id).val();
        var examen = $("#examen"+id).val();
        var doctor = $("#doctor"+id).val();
        var cantidad = $("#cantidad"+id).val();
        var precio = $("#precio"+id).val();
        var year = $("#year").val();


        $.ajax({

           type: "POST",

           url: url,

           data: {id:id, examen:examen, doctor:doctor, cantidad:cantidad, precio:precio, cita:cita, year:year}, 

           success: function(data)

           {
              $("#cuadro-editarServicios").show;
              $("#cuadro-citas").html(data);

           }

  
   });
     

}

//________________________________________

</script>

 <script type="text/javascript">
$(document).ready(function(){


//_______________

$("#ocultar-edicionServicio").click(function(){
	$("#cuadro-editarServicios").hide("low");

});

//___________________________
$(".examen").change(function(){

        var url = "php/precio.php"; // El script a dónde se realizará la petición.
        var examen2=$(".examen").val();
    $.ajax({
           type: "POST",

           url: url,

            data: 'examen='+examen2, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
                var datos = eval(data);
               $(".precio").val(datos[0]); // Mostrar la respuestas del script PHP.

           }

  
   });
          



        });
//___________________________

});
</script>


 