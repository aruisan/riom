
<?php
sleep(1);
 require_once('../../../cp/conexion.php');


        $fecha=$_POST['ffnac'];

        $ff="SELECT DATEDIFF(curdate(),'$fecha') AS edad";
        $ff=$enlace->query($ff);
        $ff=$ff->fetch_object();

        $edad=  $ff->edad/365.25 ;
       
 ?>     
<label class="control-label text-warning edad" for="edad" ><?php echo floor($edad); ?> años</label> 
