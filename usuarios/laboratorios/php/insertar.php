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





header("location:citas2.php");


$tdc=$_POST['tdc'];
$ndc=$_POST['ndc'];

$nombre1=$_POST['nombre1'];
$nombre2 = $_POST["nombre2"];
$apellido1=$_POST['apellido1'];
$apellido2 = $_POST["apellido2"];

$ffnac=$_POST['ffnac'];
$sexo=$_POST['sexo'];



  $sql =  "INSERT INTO paciente (tipo_dc, num_dc, nom_1, nom_2, ape_1, ape_2, ff_nac, sexo)
              VALUES ('$tdc', '$ndc', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$ffnac', '$sexo')"; 
     $insertar = $enlace->query($sql);

    $consulta_cc= "SELECT * FROM paciente WHERE num_dc=$ndc";
    $consulta= $enlace->query($consulta_cc);
    $cc= $consulta->fetch_object();

    $_SESSION['cc']=$cc->id_paciente;
   

 }else{
  header("Location:../../../error3.php");

}?>