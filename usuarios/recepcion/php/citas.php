
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
  $url_logo="../../../cp/";
  //_____________________________________



$id2=$_SESSION['paciente'];

$exa="SELECT * FROM examen ORDER BY nom_examen";
$consulta_exa = $enlace->query($exa);

$dr="SELECT * FROM dr ORDER BY nom_doctor";
$consulta_dr = $enlace->query($dr);



$pac_sql="SELECT * FROM paciente WHERE id_paciente=$id2";
$pac_consul = $enlace->query($pac_sql);


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ingresar - Citas</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../../cp/responsive.boostrap.min.css">
<link href="../../../cp/dataTables.bootstrap.min.css">
<link href="../../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/stilo.css">

</head>

<body>

<div class="container">
<header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
        <div></div>
       <ul class="navbar-nav nav">
         <li ><a href="editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../../index.php' method='POST'>
                  <a href="#" class="navbar-brand">
                    <center><button id='salir' name='salir' class="btn btn-link" value='1' >
                    <span class="glyphicon glyphicon-remove"></span> </button></center></a></form>
               ></li>
      </ul>
</div>
<center>
<?php require($url_logo.'nombre.php'); ?>
</center>

</nav></header>

<div class="container-fluid row">
<ol class="breadcrumb">
  <li><a href="../">Recepcion</a></li>
  <li>citas</li>
</ol>
</div>
<div class="row">
<div class="list-group col-md-12 hidden-xs " >

    <div class="target row col-md-7"> 
<div class="container col-md-12" id="form">
<button tyle="button" class="close btn btn-danger" id="ocultar">&times;</button>
<form class="form-horizontal form-cita" action="#" name="form1" id="form1" method="POST">
    <fieldset>

     <div class="form-group">
      <h4 class="num"><label id="num"></label></h4>
       <center> <h3 class="col-md-12" for="ffnac" >Ingreso de examenes</h3></center> 
    
    </div>

        <div class="form-group">
        <label class="control-label col-md-2" for="doctor" >Doctor</label> 
        <div class="col-md-4">
          <input type="hidden" id="id" name="id" value="<?php echo $id2; ?>" >
          <input type="hidden" id="num2" name="id2">
        <select id="doctor" class="form-control" name="doctor" >
          <?php while($reg_dr = $consulta_dr->fetch_object()){ ?>
            <option value="<?php echo $reg_dr->id_doctor;?>" ><?php  echo $reg_dr->nom_doctor; ?></option>
            <?php } ?>
        </select>
        </div>
           <label class="control-label col-md-2" for="cc" >Examen</label> 
        <div class="col-md-4">
        <select id="examen" class="form-control"  name="examen">
             <?php while($reg_exa = $consulta_exa->fetch_object()){ ?>
            <option value="<?php echo $reg_exa->id_examen; ?>"><?php echo $reg_exa->nom_examen; ?></option>
            <?php } ?>
        </select>
        </div>
    </div>

   <div class="form-group">
        <label class="control-label  col-md-2" for="precio" >Precio</label> 
        <div class="col-md-4" id="valor">
          <input id="precio" class="form-control" type="number" value="0" name="precio" >
         </div>
        <label class="control-label  col-md-2" for="precio" required>Cantidad</label> 
        <div class="col-md-4">
        <input id="cantidad" class="form-control" type="number"  name="cantidad" ></input>
         </div>
    </div>


    <div class="form-group row "><div id="total">
        <label class="control-label  col-md-4" for="precio" >00.oo</label>
    </div>
      
         <br><div class="col-md-3"></div>
    </div> 

<div class="form-group">
    <center>
     <div class="col-md-9">
    <input type="submit" value="Ingresar" class="btn btn-primary" id="enviar">
  </div> </center>
    </div>

 <center id="resultados">
    <div class="container">
   <div id="respuesta"><div id="mensaje" name="mensaje" class="text-warning"></div>
    </div>
    </center>
  
    </fieldset>
</form></div>
</div>

<div id="cuadro-tabla" class="row col-md-12 tabla col-sm-6 col-xs-4">
  
<div class="btn-group-lg botones">
<a type="button" href="../index.php" class="btn btn-success btn-success glyphicon glyphicon-user"></a>
<a type="button" href="../usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
<a type="button" href="../cuentas.php" class="btn btn-warning glyphicon glyphicon glyphicon-th-list active"></a>  
<a type="button" href="../tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="../iconos/dr.png"></center></a> 
<a type="button" href="../tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="../iconos/exa.png"></center></a> 
</div>  </div>


<!-- tabla y botoncito-->

<div class="row"><div class="col-md-1"></div>
                <div class="col-lg-11">
                  <h2><?php $pac = $pac_consul->fetch_object(); echo $pac->nom_1.' '.$pac->nom_2.' '.$pac->ape_1.' '.$pac->ape_2;?></h2> 
 
                    <div class="panel panel-success">
                        <div class="panel-heading" style="background:;">
                           <center class="bg-warning"> <b>Cuadro de citas</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                </table>

            <div class="container-fluid">
           <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:15px;"><i class="glyphicon glyphicon-heart-empty" aria-hidden="true"></i></th>
                        <th style="width:15px;"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></th>
                        <th style="width:15px;">PDF</th>
                        <th style="width:40px;">No.</th>
                        <th style="width:100px;"><center>Fecha</center></th>
                        <th><center>servicios</center></th>
                        <th style="width:100px;"><center>Efectivo</center></th>
                        <th style="width:100px;"><center>Creditos</center></th>
                        <th  style="width:60px;"><span class="glyphicon glyphicon-plus "></span><span class="glyphicon glyphicon-time"></span></th>
                    </tr>
                </thead>
                  <tbody>
                    <?php
                       
                          $sql="SELECT * FROM cita WHERE cita_paciente=$id2";
                          $consulta = $enlace->query($sql);   
                           while($reg = $consulta->fetch_object()){

                            $anular=$reg->anulado;
                            if($anular=="SI"){
                              $fondo="style='background:red;'";
                            }else{$fondo="";}

                    $id_cita=$reg->id_cita;
                    $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                    WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                    $consulta_cita = $enlace->query($sql_cita);  
                    
                    $sql_suma="SELECT SUM(precio*cantidad) AS total FROM servicio WHERE servicio_cita=$id_cita AND credito='no'";
                    $consulta_suma=$enlace->query($sql_suma);
                    $total=$consulta_suma->fetch_object();

                    $sql_credito="SELECT SUM(precio*cantidad) AS total_credito FROM servicio WHERE servicio_cita=$id_cita AND credito='si'";
                    $consulta_credito=$enlace->query($sql_credito);
                    $credito=$consulta_credito->fetch_object();

                    ?>

                         <tr>
                              <td>
                              <button id="<?php echo $reg->id_cita;?>" data-toggle="modal" data-target="#emergencia" class=" emergencia btn <?php 
                                  if($reg->urgencia == ''){ echo 'btn-warning'; }
                                  else{ echo 'btn-danger';} ?>">
                                  <i class="glyphicon glyphicon-heart-empty" aria-hidden="true">
                              </button></td>
                              <input type="hidden" id="u<?= $reg->id_cita; ?>" value="<?= $reg->urgencia; ?>">
                            </td>
                            <td>
                              
                                <form method="POST" action="firma.php">
                                  <input type="hidden" name="action" value="firma">
                                  <input type="hidden" name="paciente_id" value="<?= $pac->id_paciente; ?>">
                                  <input type="hidden" name="cita_id" value="<?= $reg->id_cita; ?>">
                                  <input type="hidden" name="nom_paciente" value="<?=$pac->nom_1.' '.$pac->nom_2.' '.$pac->ape_1.' '.$pac->ape_2;?>">
                                  <button class="btn btn-primary" type="submit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                  </button>
                                </form>
                            </td>
                              <td>
                                <?php if($reg->firma == 1){ ?>
                                  <a href="pdf.php?cita_id=<?= $reg->id_cita; ?>" target="_blank" class="btn btn-danger">pdf</a>
                                <?php } ?>
                              </td>
                            <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td> 
                           <td <?php echo $fondo; ?> ><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></td>
                          <td <?php echo $fondo; ?> ><?php while($cita = $consulta_cita->fetch_object()){
                            $enviar2=$cita->enviar;
                            if ($enviar2=="si"){ $enviar="enviar";}else{$enviar="no enviar";}

                           echo '('.$cita->cantidad.' '.$cita->nom_examen.' - '.$cita->nom_doctor.' - '.$enviar.')  '; } ?></td>
                           <td <?php echo $fondo; ?> ><?php echo mb_convert_encoding( $total->total, "UTF-8") ?></td>
                           <td <?php echo $fondo; ?> ><?php echo mb_convert_encoding( $credito->total_credito, "UTF-8") ?></td>
                           <td <?php echo $fondo; ?> ><a href="javascript:servicio(<?php echo $reg->id_cita; ?>);" class="glyphicon glyphicon-plus text-success"></a>
                                <a href="javascript:hhsalida(<?php echo $reg->id_cita; ?>);"  class="glyphicon <?php echo $reloj; ?> " id="n<?php echo $reg->id_cita; ?>"></a> </td>

                          
                       

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





<!-- Modal -->
<div id="emergencia" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="emergencia.php" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Cita con urgencia</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id_urgencia">
          <label class="label-control">Escribe un Motivo de urgencia</label>
          <textarea class="form-control text-left" name="mensaje" id="mensajeUrgencia" rows="4"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
      </form>
    </div>

  </div>
</div>









</div>
<script src="../js/jquery.js"></script>
<script src="../../../cp/bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/validar-citas.js"></script>
        <script src="../../../cp/jquery.dataTables.min.js"></script>
        <script src="../../../cp/dataTables.responsive.min.js"></script>
        <script src="../../../cp/dataTables.bootstrap.min.js"></script>
        <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>

<script type="text/javascript">
  $('.emergencia').on('click', function(){
    var mensaje = $('#u'+$(this).attr("id")).val();
    console.log('dadas'+mensaje);
      $('#id_urgencia').val($(this).attr("id"));
      $('#mensajeUrgencia').val(mensaje);
  });

  function servicio(id){

  var url = 'id.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        var datos = eval(valores);
        $('#num').text("Fact. No. "+datos[0]);
        $('#num2').val(datos[0]);
        $('#target').show(3000);
        $('.target').show("slow");
    }
  });
  return false;
}
  //_____________________

function hhsalida(id){

  var url = 'hhsalida.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        var datos = eval(valores);
        $('#n'+datos[0]).removeClass("glyphicon-time");
    }
  });
  return false;
}
  //________________________
  $(document).ready(function(){
        $("#ocultar").hover(function(){
            $('#target').hide(4000);
            $('.target').hide("slow");

});

         });
</script>

</body>
</html>
<?php }else{
  header("Location:../../../error3.php");

}?>