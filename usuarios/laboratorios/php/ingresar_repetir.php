
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

 <?php }else{
  header("Location:../../../error3.php");

}?>