<?php

//conexion a la base de datos
$servidor="localhost";
$usuario="root";
$clave="";
$db="riom2";
$tabla="paciente";

//conectamos con la base de datos


 $enlace = new mysqli($servidor,$usuario,$clave,$db);

if ($enlace){
}else{
  echo mysqli_errno;

}

$buscar = $_POST['buscar'];

$sql_registros="SELECT numero FROM tablas";
$con_registros = $enlace->query($sql_registros);
$registros = $con_registros->fetch_object();

//establecemos condiciones de paginacion
$registros = $registros->numero;
 






//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$sqlTabla = "SELECT paciente.*, cita.* FROM paciente,cita WHERE paciente.id_paciente=cita.cita_paciente 
			AND id_cita LIKE '%$buscar%' OR  ff LIKE '%$buscar%' OR num_dc LIKE '%$buscar%' OR nom_1 LIKE '%$buscar%' 
      OR nom_2 LIKE '%$buscar%' OR  ape_1 LIKE '%$buscar%' OR ape_2 LIKE '%$buscar%' OR atendido LIKE '%$buscar%' 
			order by ff desc, id_cita desc";
$contabla = $enlace->query($sqlTabla) or die ( 'error al listar, $pegar' . mysqli_error($enlace));


//calculamos las paginas a mostrar

$contar = "SELECT id_cita FROM paciente,cita WHERE paciente.id_paciente=cita.cita_paciente ";
$contarok = $enlace->query($contar);
$total_registros = mysqli_num_rows($contarok);
$total_paginas = ceil($total_registros / $registros);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

/*echo '<table class="table table-striped table-condensed table-hover">
            <tr>
			                <th width="300">cc</th>
			                <th width="200">nombre</th>
			                <th width="150">sexo</th>
			                <th width="150">telefono</th>
			            </tr>';
if(mysqli_num_rows($sqlTabla)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
			<td>'.$registro2['num_dc'].'</td>
							<td>'.$registro2['nom_1'].'</td>
							<td>S/. '.$registro2['sexo'].'</td>
							<td>S/. '.$registro2['telefono'].'</td>
						  </tr>';	
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';*/
?>

<table align="center" class="table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%"><thead>

<tr><th width="40" align="center">No.</th>
<th width="40" align="center">#</th>
<th width="130" align="center">FECHA</th>
<th 			align="center">CEDULA</th>
<th 			align="center">NOMBRE</th>
<th width="115" align="center">EDAD</th>
<th 			align="center">SERVICIO</th>
<th 			align="center">ESTADO</th>
<th><label class=" glyphicon glyphicon-th"></label></th>                    
</tr><thead>
<tbody>
<?php 
echo $total_registros;
if($total_registros>0){

$contador=0; $fecha="";
while ($tabla = $contabla->fetch_object()){ 

$ffnac=$tabla->ff_nac;
                            $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                            $nac=$enlace->query($nac);
                            $nac=$nac->fetch_object();
                            $age=  $nac->edad/365.25 ;

                            $id_cita=$tabla->id_cita;
                          $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                          WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                          $consulta_cita = $enlace->query($sql_cita);  	


                          $sql_fecha = "SELECT count(id_cita) as conteo from cita where ff='$tabla->ff'";
                          $con_fecha = $enlace->query($sql_fecha);
                          $ff = $con_fecha->fetch_object();


                         if($fecha==$tabla->ff){
                         
                         	$contador=$contador+1;
                         }else{
                         	$contador=0;
                        
                         }
                         $conteo=$ff->conteo-$contador;

                         if($conteo==$ff->conteo){
                          $color="background:red;";
                        }else{
                           $color="";
                        }
?>


<tr style="<?php echo $color; ?>">
                        
<td class="items"><?php echo mb_convert_encoding($tabla->id_cita, "UTF-8")?></td>
<td  ><?php echo mb_convert_encoding($conteo, "UTF-8")?></td> 
<td id="tdff<?php echo $tabla->id_cita; ?>"  ><a href="javascript:copyff(<?php echo $tabla->id_cita; ?>);"><label id="la<?php echo $tabla->id_cita; ?>"><?php echo mb_convert_encoding($tabla->ff, "UTF-8")?></label</a></td>
<td id="tdcc<?php echo $tabla->id_cita; ?>"  ><a href="javascript:copycc(<?php echo $tabla->id_cita; ?>);"><label id="lb<?php echo $tabla->id_cita; ?>"><?php echo mb_convert_encoding('ID:'.$tabla->num_dc, "UTF-8")?></label></a></td>
<td id="tdnm<?php echo $tabla->id_cita; ?>"  ><a href="javascript:copynm(<?php echo $tabla->id_cita; ?>);"><label id="lc<?php echo $tabla->id_cita; ?>"><?php echo mb_convert_encoding($tabla->nom_1.' '.$tabla->nom_2.' '.$tabla->ape_1.' '.$tabla->ape_2, "UTF-8") ?></label></a></td>
<td id="tdage<?php echo $tabla->id_cita; ?>"  ><a href="javascript:copyage(<?php echo $tabla->id_cita; ?>);"><label id="ld<?php echo $tabla->id_cita; ?>"><?php echo floor($age).' años'; ?></label></a></td>
<td id="tddoc<?php echo $tabla->id_cita; ?>"  ><?php while($cita = $consulta_cita->fetch_object()){echo '<a href="javascript:copydoc('.$tabla->id_cita.');">('.$cita->cantidad.' '.$cita->nom_examen.' - <label id="le'.$tabla->id_cita.'">'.$cita->nom_doctor.'</label>)</a>  '; } ?></td>
<td><a href="javascript:atendido(<?php echo $tabla->id_cita; ?>);"  id="n<?php echo $tabla->id_cita; ?>" class="btn <?php echo $hhAtendido; ?>"><?php echo mb_convert_encoding($tabla->atendido, "UTF-8")?></a href="javascript:hhsalida(<?php echo $tabla->id_cita; ?>);" ></td>
<td><a href="javascript:repetir(<?php echo $tabla->id_cita; ?>);" id="repetir"  class="glyphicon glyphicon-th"></a></td>

</tr>




<?php  $fecha=$tabla->ff; }
$desde = $total_registros-($registros);

 ?>

<tbody></table>
<center><p><br>

<script src="../js/jquery.js"></script>
<script type="text/javascript" src="js/tabla.js"></script>






<?php }else{
 	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
 } ?>