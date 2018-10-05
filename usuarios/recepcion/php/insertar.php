

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


$tdc=$_POST['tdc'];
$ndc=$_POST['ndc'];

$nombre1=$_POST['nombre1'];
$nombre2 = $_POST["nombre2"];
$apellido1=$_POST['apellido1'];
$apellido2 = $_POST["apellido2"];
$telefono = $_POST["telefono"];
$ffnac=$_POST['ffnac'];
$sexo=$_POST['sexo'];
$usu=$_SESSION['id'];
 
$sql_con="SELECT num_dc, id_paciente FROM paciente WHERE num_dc = $ndc";
$consulta= $enlace->query($sql_con);


  if($consulta->num_rows != 0)
  {
    $con = $consulta->fetch_object();
    $paciente=$con->id_paciente;
    $_SESSION['paciente']=$paciente;

    $sql =  "INSERT INTO cita (ff, hh_llegada, atendido, responsable, cita_paciente)
              VALUES ('$ffhh', '$hora', 'NO', '$usu', '$paciente')"; 
    $insertar = $enlace->query($sql);
    /*if($insertar)
    {
      echo $sql;
    }*/

  }else{
    $sql2 =  "INSERT INTO paciente (tipo_dc, num_dc, nom_1, nom_2, ape_1, ape_2, ff_nac, sexo, telefono)
              VALUES ('$tdc', '$ndc', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$ffnac', '$sexo','$telefono')"; 
    $insertar2 = $enlace->query($sql2);

    if($insertar2)
    {
      $sql_ultimo = "SELECT MAX(id_paciente) AS id FROM paciente";
      $consulta_ultimo=$enlace->query($sql_ultimo);
      $ultimo=$consulta_ultimo->fetch_object();
      $paciente=$ultimo->id;

      $sql3 =  "INSERT INTO cita (ff, hh_llegada, atendido, responsable, cita_paciente)
                VALUES ('$ffhh', '$hora', 'NO', '$usu', '$paciente')"; 
      $insertar3 = $enlace->query($sql3);

      $_SESSION['paciente']=$paciente;

      /*if($insertar3)
      {
        echo $sql3;
      }*/
    }else{
      echo $sql2;
    }

    
  }

  header("location:citas.php");
}else{
  header("Location:../../../error2.php");

}
      

?>
