











<?php
 require("conexion.php");
$mostrar = 5; //Registros a mostrar
$pagina = $_POST['partida'];
if (!isset($pagina)) {
    $inicio = 0;
    $pagina = 1;
}
else
    $inicio = ($pagina - 1) * $mostrar;
 
 
$sql = "SELECT id_paciente FROM paciente";
$rpta = mysql_query($sql) or die(mysql_error());
$reg_totales = mysql_num_rows($rpta);
 
#Segunda consulta para saber cuantos registros hay.
$resultado    = "SELECT id_paciente FROM paciente LIMIT $inicio, $mostrar";                          
$rs_resultado = mysql_query($resultado) or die(mysql_error());  
$pag_totales = ceil($reg_totales / $mostrar);       
 
if($reg_totales) {
                                    
#Primer registro de todos: Ir al primero
if($pagina!=1)
  $lista = $lista."<a href='pagina.php?pagina=1&url_categoria=".$_GET['url_categoria']."' class='previous'> <img src=\"images/previous.png\" border=\"0\" /> </a>";
 
echo 
if(($pagina - 1) > 0) {
 
#bucle para la numeracion de la pagina.
for ($i=1; $i<=$pag_totales; $i++)
{ 
    if ($pagina == $i) 
    {
?>
<a class='sel' href = 'javascript:void(0);'><?php echo $pagina; ?></a>
<?php
    } else {
?>
<a href="pagina.php?pagina=<?php echo $i; ?>" ><?php echo $i; ?></a>
<?php
 
    }   
}
 
if(($pagina + 1)<=$pag_totales) 
{
?>
<a href="pagina.php?pagina=<?php echo ($pagina+1); ?>" class="previous"> <img src="images/snext.png" border="0" /> </a>
<?php
 
}
 
//Ir al ultimo registro
if($pagina<=($pag_totales-1))
 echo "<a href='pagina.php?pagina=".($pag_totales)."' class=\"sprevious\"> <img src=\"images/next.png\" border=\"0\" /> </a>";      
 
}
 
}

if($pagina <= 1){

      $limit = 0;
      
    }else{
      $limit = ($mostrar*($pagina-1));
    }


    $registro = mysql_query("SELECT * FROM paciente order by id_paciente desc LIMIT $limit, $nroLotes ");

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                  <tr>
                      <th width="300">id</th>
                      <th width="300">cc</th>
                      <th width="200">nombre</th>
                      <th width="150">sexo</th>
                      <th width="150">telefono</th>
                  </tr>';
        
  while($registro2 = mysql_fetch_array($registro)){
    $tabla = $tabla.'<tr>
            <td>'.$registro2['id_paciente'].'</td>
              <td>'.$registro2['num_dc'].'</td>
              <td>'.$registro2['nom_1'].'</td>
              <td>S/. '.$registro2['sexo'].'</td>
              <td>S/. '.$registro2['telefono'].'</td>
              </tr>';   
  }
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
             1 => $lista);

    echo json_encode($array);
 
?>