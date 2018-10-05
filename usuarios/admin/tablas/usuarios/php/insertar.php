
<?php
header("Location: ../index.php");
 require_once('../../../../../cp/conexion.php');

    


        $name=$_POST['name'];
        $cargo=$_POST['cargo'];
        $nick= $_POST["nick"];
        $clave=$_POST['clave'];
       
       
  $sql =  "INSERT INTO usuario (nom_usuario,tipo,nick,clave)
              VALUES ('$name','$cargo','$nick','$clave')"; 
     $insertar = $enlace->query($sql);
     if ($insertar){
        echo $sql;
     }else{
        echo 'ya Registrada';
     }
      


	?>
		
	