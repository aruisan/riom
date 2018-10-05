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
      $precio=$_POST["precio"];
      $cubs=$_POST['cubs'];


 $sql2 =  "UPDATE examen SET nom_examen='$nombre', precio='$precio', cubs='$cubs' 
            WHERE id_examen=$id2";              
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
		