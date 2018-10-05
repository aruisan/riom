

<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../error1.php");
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
//__________________________________________________________

$id=$_POST['id'];
$hhll=$_POST['hhll'];
$hhto=$_POST['hhto'];
$hhsa=$_POST['hhsa'];


$sql="UPDATE cita SET hh_llegada='$hhll', hh_toma='$hhto', hh_salida='$hhsa' WHERE id_cita = $id ";
$ingresar= $enlace->query($sql);
   
$sql="SELECT * FROM cita WHERE (TIME_TO_SEC(hh_salida)/60 - TIME_TO_SEC(hh_toma)/60)<0
                            or (TIME_TO_SEC(hh_toma)/60 - TIME_TO_SEC(hh_llegada)/60)<0
                            or (TIME_TO_SEC(hh_salida)/60 - TIME_TO_SEC(hh_toma)/60)>60 
                            or (TIME_TO_SEC(hh_toma)/60 - TIME_TO_SEC(hh_llegada)/60)>60
                            or hh_llegada='00:00:00'  or hh_toma='00:00:00'
                            or hh_salida='00:00:00'";
$consulta=$enlace->query($sql);

?>
<button style="button" class="close btn btn-danger ocultar" >&times;</button><br>
<div class="row debajo">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:#1B776D;">
                           <center class="bg-success"> <b>Descuadre de tiempos</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

            <div class="container-fluid table3">
           <table class="example2  table table-condensed table-striped  dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:40px;">No.</th>
                        <th>Fecha</th>
                        <th>Hora-llegada</th>
                        <th>Hora-toma</th>
                        <th>Hora-salida</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php
  
                          
                     while($reg=$consulta->fetch_object())

                        
            
                   {

                    ?>

                         <tr>
                            <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td> 
                            <td><input id="hhll<?php echo $reg->id_cita;?>" type="time" value='<?php echo mb_convert_encoding($reg->hh_llegada, "UTF-8")?>'></td> 
                            <td><input id="hhto<?php echo $reg->id_cita;?>" type="time" value='<?php echo mb_convert_encoding($reg->hh_toma, "UTF-8")?>'></td>
                            <td><input id="hhsa<?php echo $reg->id_cita;?>" type="time" value='<?php echo mb_convert_encoding($reg->hh_salida, "UTF-8")?>'><a href="javaScript:enviar(<?php echo $reg->id_cita; ?>)"><span class="glyphicon glyphicon-ok"></span></a></td>
                          </tr>
                        
                     
                        <?php } ?>
                          
                </tbody>
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
        //__________________________

        $(".ocultar").click(function(){
          $("#tiempos").hide("low");

        })
        //___________________________
        } );
        </script>

        <script type="text/javascript">
         //___________________________________
   function enviar(id){  
   var url = "php/editar_tiempos.php"; // El script a dónde se realizará la petición.
    var hhll = $("#hhll"+id).val();   
    var hhto = $("#hhto"+id).val();   
    var hhsa = $("#hhsa"+id).val();   
    $.ajax({

           type: "POST",

           url: url,

           data: {id:id, hhll:hhll, hhto:hhto, hhsa:hhsa}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#tiempos").html(data);

           }

  
   });
           

 

    return false; // Evitar ejecutar el submit del formulario.

   };

        </script>
    <!--  ___________________________________________________________________________________________________________     -->

<?php }else{
  header("Location:../../../error3.php");

}?>