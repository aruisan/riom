<script language="javascript">

  function imprSelec(nombre)

  {
  
  ////////
  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 

<style type="text/css" media="print">
#Imprime {
  height: auto;
  width: 310px;
  margin: 0px;
  padding: 0px;
  float: left;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 7px;
  font-style: normal;
  line-height: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  color: #000;
}
@page{
   margin: 0;
}
</style>

<div id="Imprime">
    <?php 
    date_default_timezone_set("America/Chihuahua"); 
    $fecha = date("Y/m/d H:i:s"); 
    $idSucursal = "oscar amortegui/Girardot"; //se obtiene la sucursal respecto al usuario que inicio sesion
    $totalV = 0;
    $totalCosto =0;
      $totalImporte=0;
    
  ?>
    --------------------------------
    nombre de la tienda<br>
    --------------------------------
    Sucursal: <?php echo $idSucursal; ?>   &nbsp;&nbsp;&nbsp;
    Fecha: <?php echo $fecha; ?><br>
    Vendedor: <?php  echo "oscar amortegui"; ?><br>
    Numero de pedido: <?php echo 12345678; ?><br>
    Nombre: <?php echo "camilo"; ?><br>
    Direccion: <?php echo "carrera 3 3j"; ?><br>
    Tel: <?php echo 313424512; ?><br>  
   
  <br>
    </div>


    <p><a href="javascript:imprSelec('Imprime')" ><img src="imagenes/printer.png" width="140" height="140" /></a></p>