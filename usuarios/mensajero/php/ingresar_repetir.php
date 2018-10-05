<?php
require_once('../../../cp/conexion.php');

$id=$_POST['id'];
$rep=$_POST['rep'];
$obs=$_POST['obs'];


$sqlEditar = "UPDATE servicio SET repetir='$rep', obs_repetir='$obs' WHERE id_servicio=$id";

     $Editar = $enlace->query($sqlEditar);

?>
<button tyle="button" class="close btn btn-danger" id="ocultar">&times;</button>
<label class="text-success">se repitieron <?php echo $rep; ?> por <?php echo $obs; ?></label>

 <script src="js/jquery.js"></script>
 <script type="text/javascript">


 //_____________________________
  $(document).ready(function(){
        $("#ocultar").click(function(){
            $('#repetir_servicios').hide("slow");

});

         });
  
   
 </script>