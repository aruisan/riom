 <?php
$id=$_POST['id'];
$factura=$_POST['factura'];


 ?>

 <button type="button" class="close btn btn-danger" id="ocultar-factura" >&times;</button><br>
  <input type="hidden" value="<?php echo $id; ?>" id="antiguaFactura"> 
  <input type="hidden" value="<?php echo $factura; ?>" id="factura"> 
  <label>se cambia factura:<?php echo $factura; ?> de cita:<?php echo $id; ?> por la cita numero:</label>
  <input id="nuevaFactura" type="text" value=0 style="width:60px;">
  <a id="enviarEditarFactura" class="btn btn-success">Cambiar</a>


<script type="text/javascript">
$(document).ready(function(){

$("#enviarEditarFactura").click(function(){
 var nueva = $("#nuevaFactura").val();
 var factura = $("#factura").val();
 var antigua = $("#antiguaFactura").val();
  var year = $("#year").val();
 var url = "php/ingresar_editarFactura.php"; // El script a dónde se realizará la petición.
    $.ajax({

           type: "POST",

           url: url,

           data: {nueva:nueva, factura:factura, antigua:antigua, year:year }, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#cuadro-citas").html(data);
               $("#cuadro-editarFactura").hide('low');

           }

  
   });


});
//_______________

$("#ocultar-factura").click(function(){
	$("#cuadro-editarFactura").hide("low");

});

//___________________________



});
//___________________________________


</script>