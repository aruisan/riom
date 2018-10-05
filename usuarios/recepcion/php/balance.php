
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
  //_____________________________________________________________


$user=$_POST['user'];
$fecha=$_POST['fecha'];

if($user=='*'){

  $sql_usu="SELECT * FROM usuario where tipo=2";
  $consulta_usu= $enlace->query($sql_usu);

}else{
  $sql_usu="SELECT * FROM usuario WHERE id_usuario=$user";
  $consulta_usu= $enlace->query($sql_usu);}



 ?>


  <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>usuario</th>
                        <th>Efectivo</th>
                        <th>Credito</th>
                        <th>Ingreso</th>
                        <th class="bg-danger">Gastos</th>
                        <th>Neto Total</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php while($reg_usu=$consulta_usu->fetch_object()){

                      $id_usu=$reg_usu->id_usuario;

                       $sql_efe = " SELECT SUM(precio*cantidad) AS efectivo FROM servicio, cita WHERE servicio.servicio_cita=cita.id_cita AND responsable=$id_usu AND credito='no' AND cita.ff='$fecha'";
                      $consulta_efe = $enlace->query($sql_efe);
                      $reg_efe=$consulta_efe->fetch_object();

                      $sql_cre=" SELECT SUM(precio*cantidad) AS credito FROM servicio, cita WHERE servicio.servicio_cita=cita.id_cita AND responsable=$id_usu AND credito='si' AND cita.ff='$fecha'";
                      $consulta_cre = $enlace->query($sql_cre);
                      $reg_cre = $consulta_cre->fetch_object();

                   
                      $sql_total=" SELECT SUM(precio*cantidad) AS total FROM servicio, cita WHERE servicio.servicio_cita=cita.id_cita AND responsable=$id_usu AND cita.ff='$fecha'";
                    $consulta_total = $enlace->query($sql_total);
                    $reg_total=$consulta_total->fetch_object();
          
                      $sql_gastos="SELECT SUM(precio*cantidad) AS gastos FROM gastos WHERE fecha='$fecha' AND usuario=$id_usu";
                      $consulta_gastos= $enlace->query($sql_gastos);
                      $reg_gastos=$consulta_gastos->fetch_object();
                      $reg_gastos_gastos = $reg_gastos->gastos;

                      if($reg_gastos_gastos == '')
                      {
                        $reg_gastos_gastos = 0;
                      }

                      $neto=$reg_efe->efectivo-$reg_gastos_gastos;
                    ?>

                         <tr>
                           <td><?php echo mb_convert_encoding($fecha, "UTF-8")?></td>
                            <td><?php echo mb_convert_encoding($reg_usu->nick, "UTF-8")?></td> 
                            <td><?php echo mb_convert_encoding( $reg_efe->efectivo, "UTF-8") ?></td>
                          <td><?php echo mb_convert_encoding( $reg_cre->credito, "UTF-8") ?></td>
                           <td><?php echo mb_convert_encoding( $reg_total->total, "UTF-8") ?></td>
                           <td><label class="text-danger"><?php echo mb_convert_encoding( "-".$reg_gastos_gastos, "UTF-8") ?></label></td>
                           <td><label class="text-primary"><?php echo mb_convert_encoding( $neto, "UTF-8") ?></label></td>

                          
                       

                          </tr>
                     
                        <?php } ?>
                </tbody>
            </table>

            <?php }else{
  header("Location:../../../error2.php");

}
      

?>