
<?php
header("Location: ../index.php");
 require_once('../../../../../cp/conexion.php');

    


        $name=$_POST['name'];
        $precio=$_POST['precio'];
        $cubs= $_POST["cubs"];
        
       
  $sql =  "INSERT INTO examen (nom_examen,precio,cubs)
              VALUES ('$name','$precio','$cubs')"; 
     $insertar = $enlace->query($sql);
     if ($insertar){
        echo $sql;
     }else{
        echo 'ya Registrada';
     }
      


	?>
		
	