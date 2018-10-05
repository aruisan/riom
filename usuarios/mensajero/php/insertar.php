<?php
sleep(1);
session_start();
header("location:citas2.php");
require_once('../../../cp/conexion.php');


$tdc=$_POST['tdc'];
$ndc=$_POST['ndc'];

$nombre1=$_POST['nombre1'];
$nombre2 = $_POST["nombre2"];
$apellido1=$_POST['apellido1'];
$apellido2 = $_POST["apellido2"];

$ffnac=$_POST['ffnac'];
$sexo=$_POST['sexo'];


/*$doctor=$_POST['doctor'];
$examen=$_POST['examen'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];*/


  $sql =  "INSERT INTO paciente (tipo_dc, num_dc, nom_1, nom_2, ape_1, ape_2, ff_nac, sexo)
              VALUES ('$tdc', '$ndc', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$ffnac', '$sexo')"; 
     $insertar = $enlace->query($sql);

    $consulta_cc= "SELECT * FROM paciente WHERE num_dc=$ndc";
    $consulta= $enlace->query($consulta_cc);
    $cc= $consulta->fetch_object();

    $_SESSION['cc']=$cc->id_paciente;
   

?>
<br>
<?php /*<center>
<table width="600" class"table table-striped table-bordered table-hover" id="tabla">
	<thead>
	<th>tipo</th>	
	<th>Cedula</th>
	<th>nombre1</th>
	<th>Nombre2</th>
	<th>apellido1</th>
	<th>apellido2</th>
	<th>nacimiento</th>
	<th>Sexo</th>
	<th>doctor</th>
	<th>examen</th>
	<th>precio</th>
	<th>cantidad</th>
	</thead>
	<tbody>
     <tr>
     	<td><?php echo $tdc?></td>
     	<td><?php echo $ndc?></td>
     	<td><?php echo $nombre1?></td>
     	<td><?php echo $nombre2?></td>
     	<td><?php echo $apellido1?></td>
     	<td><?php echo $apellido2?></td>
     	<td><?php echo $ffnac?></td>
     	<td><?php echo $sexo?></td>
     	<td><?php echo $doctor?></td>
     	<td><?php echo $examen?></td>
     	<td><?php echo $precio?></td>
     	<td><?php echo $cantidad?></td>
     	<td><?php echo $credito?></td>
     	<td><?php echo $enviar?></td>
     </tr>
	</tbody>

</table>
</center>*/?>