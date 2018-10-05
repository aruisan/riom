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
//_________________________________________________
        $id2=$_POST["id"];
        $name=$_POST['name'];
         $direccion=$_POST['direccion'];
          $email=$_POST['email'];
           $telefono=$_POST['telefono'];
            $nit=$_POST['nit'];
             $cod=$_POST['cod'];
     

 $sql2 =  "UPDATE dr SET nom_doctor='$name+


 ',direccion='$direccion',email='$email',
                        telefono='$telefono',nit='$nit',cod_secretaria='$cod' 
            WHERE id_doctor=$id2";              
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
    