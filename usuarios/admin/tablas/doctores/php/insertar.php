
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../../error1.php");
}
 require_once('../../../../../cp/conexion.php');

$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo=="1"){
//_________________________________________________

header("Location: ../index.php");


    


        $name=$_POST['name'];
         $direccion=$_POST['direccion'];
          $email=$_POST['email'];
           $telefono=$_POST['telefono'];
            $nit=$_POST['nit'];
             $cod=$_POST['cod'];
        
       
       
  $sql =  "INSERT INTO dr (nom_doctor,direccion,email,telefono,nit,cod_secretaria)
              VALUES ('$name','$direccion','$email','$telefono','$nit','$cod')"; 
     $insertar = $enlace->query($sql);
     if ($insertar){
        echo $sql;
     }else{
        echo 'ya Registrada';
     }
      

 }else{
  header("Location:../../../../error2.php");

}?>
        
    