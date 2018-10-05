<?php 
session_start();

if(empty($_SESSION['id']))
{

    header("Location:../../../../../error1.php");
}
header("Location: ../");
include('../../../../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();

if($reg->tipo=="1"){


      $nombre=$_POST['name'];
      $id2=$_POST["id"];
      $nick=$_POST["nick"];
      $clave=$_POST['clave'];
      $cargo=$_POST['cargo'];


 $sql2 =  "UPDATE Usuario SET nom_usuario='$nombre', tipo='$cargo', nick='$nick', clave='$clave' 
            WHERE id_usuario=$id2";              
     $actualizar = $enlace->query($sql2);

     if ($actualizar){
        echo $sql2;
        exit;

     }else{
       echo mysql_error();
            exit;
     }
      
}else{
    header("Location:../../../../../error2.php");

}?>
		