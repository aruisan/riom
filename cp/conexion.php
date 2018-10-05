<?php
$db="riom";
$usuario="root";
$servidor="localhost";
$clave="";

 $enlace = new mysqli($servidor,$usuario,$clave,$db);
 //$enlace->set_charset("utf8");

if ($enlace){
	$enlazar = "si ";
}else{
  echo mysql_errno;

}

//hora

$hora="SELECT Date_format(now(),'%H:%i') AS hora";
$hora=$enlace->query($hora);
$hora=$hora->fetch_object();
$hora=$hora->hora;


 /*fecha y hora por mysql*/
 $sqlffhh="select curdate() AS ffhh";
 $consultaFfhh=$enlace->query($sqlffhh);
 $regFfhh=$consultaFfhh->fetch_object();
 $ffhh=$regFfhh->ffhh;


//ALTER TABLE `user` AUTO_INCREMENT=1 borrar el autoincremento delete from name-table

?>

