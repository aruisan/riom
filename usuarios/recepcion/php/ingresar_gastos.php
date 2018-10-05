<?php

 session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../../error1.php");
}
include('../../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==2){
//_____________________________________________________________________


$gastos=$_POST['gastos'];
$cant=$_POST['cant'];
$valor=$_POST['valor'];
$insertar="INSERT INTO gastos (articulo, cantidad, precio, fecha, hora, usuario) VALUES ('$gastos', '$cant', '$valor', '$ffhh', '$hora', '$id')";
$ingresar=$enlace->query($insertar);

$sql="SELECT * FROM gastos WHERE fecha = '$ffhh'";
$consulta=$enlace->query($sql);

       
 ?>   

<div class="row debajo">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:#1B776D;">
                           <center class="bg-success"> <b>Gastos del dia <?php echo $ffhh; ?></b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

            <div class="container-fluid table2">
           <table class="example2  table table-condensed table-striped  dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:40px;">No.</th>
                        <th style="width:120px;">Fecha</th>
                        <th style="width:100px;">Hora</th>
                        <th style="width:200px;">Gasto</th>
                        <th style="width:100px;">Cantidad</th>
                        <th style="width:100px;">Precio</th>
                        <th style="width:120px;">Total</th> 
                        <th style="width:80px;">User</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                    </tr>
                </thead>
                  <tbody>
                    <?php
                    $contador=0;
                          
                     while($reg=$consulta->fetch_object())

                        
            
                   {


                     $total= $reg->cantidad*$reg->precio;

                     $contador=$total+$contador;

                    ?>

                         <tr>
                            <td class="items"><?php echo mb_convert_encoding($reg->id_gastos, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->fecha, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->hora, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->articulo, "UTF-8")?></td>
                            <td><?php echo mb_convert_encoding($reg->cantidad, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->precio, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($total, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->usuario, "UTF-8")?></td> 
                           
                          <td><a href="javascript:editar_gastos(<?php echo $reg->id_gastos; ?>)" class=" glyphicon glyphicon-edit"></a></td>

                          </tr>
                        
                     
                        <?php } ?>
                          
                </tbody>
                <tfoot><tr></tr> <tr><td></td><td></td><td></td><td></td><td></td><td><b>Total</b></td><td><?php echo $contador; ?></td></tr>   </tfoot>
            </table>

                            </div>
                            <!-- /.table-responsive -->
          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

   <script>

        $(document).ready(function() {
        $('.example2').DataTable({
        "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>

       <script type="text/javascript">
         //___________________________________
   function editar_gastos(id){  
   var url = "php/editar_gastos.php"; // El script a dónde se realizará la petición.
        
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#resultados-editar_gastos").html(data);
                 $('#resultados-editar_gastos').show("slow");

           }

  
   });
           

 

    return false; // Evitar ejecutar el submit del formulario.

   };

        </script>
    <!--  ___________________________________________________________________________________________________________     -->
<?php }else{
  header("Location:../../../error3.php");

}?>