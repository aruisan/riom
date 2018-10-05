
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
header("location:../index.php");

$id=$_POST['id'];
$tdc=$_POST['tdc'];
$ndc=$_POST['ndc'];

$nombre1=$_POST['nombre1'];
$nombre2 = $_POST["nombre2"];
$apellido1=$_POST['apellido1'];
$apellido2 = $_POST["apellido2"];
$telefono = $_POST["telefono"];
$ffnac=$_POST['ffnac'];
$sexo=$_POST['sexo'];





  $sql =  "UPDATE paciente SET tipo_dc='$tdc', num_dc= '$ndc', nom_1='$nombre1', nom_2='$nombre2', ape_1='$apellido1', ape_2='$apellido2',
  								 ff_nac='$ffnac', sexo='$sexo', telefono='$telefono' WHERE id_paciente=$id;"; 
     $insertar = $enlace->query($sql);
}else{
  header("Location:../../../error2.php");

}
      

?>