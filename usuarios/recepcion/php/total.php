<?php

 require_once('../../../cp/conexion.php');


        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];

 		$total=$precio*$cantidad;

       
       
 ?>     
<label class="control-label text-success edad col-md-4" for="edad" >$<?php echo $total; ?>.oo</label>
<label class="col-md-3 control-label">Credito: <input name="credito" type="checkbox"> </label>
<label class="col-md-3 control-label">Enviar: <input  name="enviar" type="checkbox"> </label>

