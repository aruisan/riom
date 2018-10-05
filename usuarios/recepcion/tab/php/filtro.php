<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../../error1.php");
}
include('../../../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==2){

//___________________________________________________________

$filtro=$_POST['filtro'];

$sqleditar="UPDATE tablas SET numero=$filtro WHERE nom_tablas='radiologo' ";
$editar = $enlace->query($sqleditar);

require("tabla.php");
?>

<?php }else{
  header("Location:../../../../error3.php");

}?>