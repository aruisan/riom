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
//_____________________________________________________________________


$id=$_POST['id'];
   
$sql="SELECT * FROM gastos WHERE id_gastos = '$id'";
$consulta=$enlace->query($sql);
$reg=$consulta->fetch_object();



       
       
 ?>   


<div class="bg-success">
<center>
<label class="label-control">Gasto: </label><input id="articulo_editar"  placeholder="Articulo o servicio" class="input-control" value="<?php echo $reg->articulo; ?>"><input id="id-gastos" type="hidden" value="<?php echo $id; ?>">
<label class="label-control">Cantidad: </label><input id="cant_editar" style="width:80px;" type="number" class="input-control" placeholder="Cantidad" value="<?php echo $reg->cantidad; ?>">
<label class="label-control">Valor $: </label><input id="valor_editar" style="width:160px;" type="number" class="input-control" placeholder="precio" value="<?php echo $reg->precio; ?>">
<button id="editar-gastos" class="btn btn-info">Editar</button><span> </span>
<a class="btn btn-danger" id="ocultar-gastos_editar"><span class="glyphicon glyphicon-remove"></span></a>
</center>

</div>


<script type="text/javascript">
$(document).ready(function(){
     $("#ocultar-gastos_editar").click(function(){
            $('#resultados-editar_gastos').hide("slow");

});

     $("#editar-gastos").click(function(){
            var url = "php/ingresar-editar_gastos.php"; // El script a dónde se realizará la petición.
            var var1 = $("#articulo_editar").val();
            var var2 = $("#cant_editar").val();
            var var3 = $("#valor_editar").val();
            var id = $("#id-gastos").val();
    $.ajax({

           type: "POST",

           url: url,

           data: {gastos:var1, cant:var2, valor:var3, id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#resultado-gastos").html(data);
                 $('#resultados-editar_gastos').hide("slow");

           }

  
   });
     })

});
//__________________________________________________

</script>
    <!--  ___________________________________________________________________________________________________________     -->
<?php }else{
  header("Location:../../../error3.php");

}?>
