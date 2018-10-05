<?php
 require_once('../../../cp/conexion.php');


        $examen=$_POST['examen'];

        $examen="SELECT * FROM examen WHERE id_examen=$examen";
        $examen=$enlace->query($examen);
        $examen=$examen->fetch_object();

        $total= array(0=>$examen->precio);

        echo json_encode($total);


       
 ?>     
