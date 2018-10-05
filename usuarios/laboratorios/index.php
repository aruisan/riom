
<?php 
session_start();

if(empty($_SESSION['id']))
{

  header("Location:../../error1.php");
}
include('../../cp/conexion.php');
//datos de usuario en logueo
$id=$_SESSION['id'];
$sql =" SELECT * 
        FROM  usuario
        WHERE id_usuario=$id";
$consulta = $enlace->query($sql);
$reg = $consulta->fetch_object();


if($reg->tipo==3){
   $url_logo="../../cp/";

//___________________________________________________________

$sql_fecha="SELECT DISTINCT  ff FROM cita  ORDER BY id_cita DESC LIMIT 0,2";   
$consulta_fecha= $enlace->query($sql_fecha);

?>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<META HTTP-EQUIV="REFRESH" CONTENT="180;URL=index.php">
<title>Validar un formulario</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../../modulos/firma/css/jquery.signaturepad.css" rel="stylesheet">
<style type="text/css">

  .modal-dialog {
    margin: 20vh auto 0px auto;
  }

  .modal-backdrop{
     position: relative; 
    }

  a :hover {color: #131313;}
  a :active {color: green;}
  a label{color: #594d59;}

  .atendido{
  background: rgba(254,254,254,1);
  background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
  background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );
  }

  body{
      background:#f8f8f8;}

  #cuadro-servicio{
    margin-left: 200px;
      width: 600px;
      display:none;
       position:fixed; 
       z-index:2; 
      border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.6) 8px 8px 2px 0px;
  padding:15px;
  margin-top: 30px;
  margin-bottom: 30px;
  background: rgba(254,254,254,1);
  background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
  background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );
  }

  #repetir_servicios
  {  
  display:none;
   width: 530px;
      margin-left:350px;
      margin-top: 200px;
      position: absolute;
      z-index: 1;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.4) 8px 8px 2px 0px;
      padding:15px;
  background: rgba(254,254,254,1);
  background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
  background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );

    }

  #repetir_servicios td{background: white;

  }
  #repetir_servicios td:hover {background:rgba(190,228,180,0.50);

  }
  .edad{
    font-family: 'Oxygen', sans-serif;
    font-size: 1,5em;
    font: bold;
  }
  #form{
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.6) 8px 8px 2px 0px;
  padding:15px;
  margin-top: 30px;
  margin-bottom: 30px;
  background: rgba(254,254,254,1);
  background: -moz-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(254,254,254,1)), color-stop(15%, rgba(209,209,209,0.98)), color-stop(88%, rgba(219,219,219,0.88)), color-stop(90%, rgba(220,220,220,0.88)), color-stop(100%, rgba(226,226,226,0.88)));
  background: -webkit-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -o-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: -ms-linear-gradient(left, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  background: linear-gradient(to right, rgba(254,254,254,1) 0%, rgba(209,209,209,0.98) 15%, rgba(219,219,219,0.88) 88%, rgba(220,220,220,0.88) 90%, rgba(226,226,226,0.88) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e2e2e2', GradientType=1 );
  }
  #tabla{
      color: black;
  }
  .tabla{
      margin: 30px;
  }
  .items{
      background: rgba(235,233,249,1);
  background: -moz-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(235,233,249,1)), color-stop(8%, rgba(216,208,239,1)), color-stop(51%, rgba(206,199,236,1)), color-stop(100%, rgba(193,191,234,1)));
  background: -webkit-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
  background: -o-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
  background: -ms-linear-gradient(left, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
  background: linear-gradient(to right, rgba(235,233,249,1) 0%, rgba(216,208,239,1) 8%, rgba(206,199,236,1) 51%, rgba(193,191,234,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebe9f9', endColorstr='#c1bfea', GradientType=1 );
  }
  .lineas{border: 1px solid red}
  .boton-redondeado {
      
      }

  #cuadro-tabla{position:absolute; z-index:0;}
  .target{display:none; position:absolute; z-index:2; }
  th{background: #3399ff}
  tr{height:10px;}
</style>
</head>

<body>

<div class="container">
<header class="row"><nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header  navbar-right">
  


        <div></div>

       <ul class="navbar-nav nav">
         <li ><a href="php/editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
                <li><form action='../../index.php' method='POST'>
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
  <li>Radiologia</a></li>
</ol>
</div>
<div class="row">
<div class="list-group col-md-12 hidden-xs " >
  <div id="repetir_servicios"></div>

<div id="cuadro-citas">
<div id="cuadro-tabla" class="row col-md-12 tabla col-sm-6 col-xs-4">       
      <div class="col-md-12" id="citas">
    <table class="example table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th style="width:40px;" >No.</th>
                        <th style="width:40px;" >#</th>
                        <th style="width:15px;"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></th>
                        <th style="width:130px;">Fecha</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th style="width:115px;" >Edad</th>
                        <th>Servicio</th>
                       <th>Estado</th>
                       <th><label class=" glyphicon glyphicon-th"></label></th>
                    </tr>
                </thead>
                <div id="cuadro-servicio"></div>

                  <tbody>
                    <?php
                          
                    while($reg_consulta = $consulta_fecha->fetch_object()){ 
                    $contador=0;
                    $fecha=$reg_consulta->ff;
                 //_____________________________________________________________

                    $sql="SELECT paciente.*, cita.* FROM paciente,cita
                         WHERE paciente.id_paciente=cita.cita_paciente AND ff='$fecha'";
                    $consulta = $enlace->query($sql);  

                    while($reg = $consulta->fetch_object())       
                   {     
                          $contador=$contador+1;
                          if($contador==1){$indice="style='background:#FFD92E;'";}else{$indice="";}

                          $id_cita=$reg->id_cita;
                          $sql_cita="SELECT servicio.*, examen.nom_examen, dr.nom_doctor FROM servicio,examen,dr
                          WHERE servicio_cita=$id_cita AND servicio.examen=examen.id_examen AND servicio.doctor=dr.id_doctor";
                          $consulta_cita = $enlace->query($sql_cita);  

                            $ffnac=$reg->ff_nac;
                            $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                            $nac=$enlace->query($nac);
                            $nac=$nac->fetch_object();
                            $age=  $nac->edad/365.25 ;
                            
                            $sqlconsultar= "SELECT atendido FROM servicio WHERE servicio_cita=$id_cita";
                           $consulta2 = $enlace->query("$sqlconsultar");

                           $contadornumber=0;
                           $suma=0;

                           while($reg_ser = $consulta2->fetch_object()){
                           $estado=$reg_ser->atendido;

                           $contadornumber=$contadornumber+1;
                           $suma=$suma+$estado;
                           }

                           if($contadornumber==$suma){
                               $hhAtendido="btn-success";$colorAtendido='class="atendido"';
       
                                 }else{
                              $hhAtendido="btn-danger"; $colorAtendido='class="c'.$reg->id_cita.'"';
                                 }
                  


                    ?>

                         <tr class="<?php if($reg->urgencia != ''){echo 'alert-danger'; }?>">
                        
                          <td class="items"><?php echo mb_convert_encoding($reg->id_cita, "UTF-8")?></td>
                          <td <?php echo $indice." ".$colorAtendido; ?> ><?php echo mb_convert_encoding($contador, "UTF-8")?></td>
                           <td>
                                <form method="POST" action="firma.php" id="formUserFirma<?= $reg->id_cita ?>">
                                  <input type="hidden" name="action" value="firmaLaboratorio">
                                  <input type="hidden" name="paciente_id" value="<?= $reg->id_paciente; ?>">
                                  <input type="hidden" name="cita_id" value="<?= $reg->id_cita; ?>">
                                  <input type="hidden" name="nom_paciente" value="<?=$reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2;?>">
                                </form>
                                  <button id="<?= $reg->id_cita ?>" data-toggle="modal" data-target="#myFirma" class="btnModal btn <?php if($reg->firma == 1){ ?>btn-primary <?php }else{ ?> btn-danger <?php } ?>" type="submit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                  </button>
                            </td> 
                          <td id="tdff<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copyff(<?php echo $reg->id_cita; ?>);"><label id="la<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding($reg->ff, "UTF-8")?></label></a></td>
                          <td id="tdcc<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copycc(<?php echo $reg->id_cita; ?>);"><label id="lb<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding('ID:'.$reg->num_dc, "UTF-8")?></label></a></td>
                          <td id="tdnm<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copynm(<?php echo $reg->id_cita; ?>);"><label id="lc<?php echo $reg->id_cita; ?>"><?php echo mb_convert_encoding($reg->nom_1.' '.$reg->nom_2.' '.$reg->ape_1.' '.$reg->ape_2, "UTF-8") ?></label></a></td>
                          <td id="tdage<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><a href="javascript:copyage(<?php echo $reg->id_cita; ?>);"><label id="ld<?php echo $reg->id_cita; ?>"><?php echo floor($age).' años'; ?></label></a></td>
                          <td id="tddoc<?php echo $reg->id_cita; ?>" <?php echo $indice." ".$colorAtendido; ?> ><?php while($cita = $consulta_cita->fetch_object()){echo '<a href="javascript:copydoc('.$reg->id_cita.');">('.$cita->cantidad.' '.$cita->nom_examen.' - <label id="le'.$reg->id_cita.'">'.$cita->nom_doctor.'</label>)</a>  '; } ?></td>
                          <td><a href="javascript:atendido(<?php echo $reg->id_cita; ?>);"  id="n<?php echo $reg->id_cita; ?>" class="btn <?php echo $hhAtendido; ?>"><?php echo mb_convert_encoding($reg->atendido, "UTF-8")?></a href="javascript:hhsalida(<?php echo $reg->id_cita; ?>);" ></td>
                          <td><a href="javascript:repetir(<?php echo $reg->id_cita; ?>);" id="repetir"  class="glyphicon glyphicon-th"></a>  
                          </td>

                          </tr>
                     
                        <?php }} ?>
                </tbody>
            </table>
            </div>

    <?php include_once('modelFirma.php'); ?>
</div>
</div>
</div>
</div>










</div>
<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>


<script src="../../modulos/firma/js/numeric-1.2.6.min.js"></script> 
<script src="../../modulos/firma/js/bezier.js"></script>
<script src="../../modulos/firma/js/jquery.signaturepad.js"></script> 

<script type='text/javascript' src="../../modulos/firma/js/html2canvas.js"></script>
<script src="../../modulos/firma/js/json2.min.js"></script>

    <script src="../../cp/jquery.dataTables.min.js"></script>
        <script src="../../cp/dataTables.responsive.min.js"></script>
        <script src="../../cp/dataTables.bootstrap.min.js"></script>
        <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>

<script type="text/javascript">

    function atendido(id){
             
      var url = 'atendido.php';
      $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(data){
          $("#cuadro-servicio").show("low").html(data);
           
        }
      });
      return false;

    };


    function repetir(id){
               
      var url = 'php/repetir.php';
      $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            $('#repetir_servicios').html(valores).show(500);
        }
      });
      return false;

    };

    function copyff(id){   

      var v1 =  $("#la"+id).text();
      $("body").append("<input type='text' id='tempa'>"); 
      $("#tempa").val(v1).select(); 
      document.execCommand("copy"); 
      $("#tempa").remove();
      $("#tdff"+id).removeClass('atendido');
     };

     function copycc(id){   

          var v2 =  $("#lb"+id).text();
          $("body").append("<input type='text' id='tempb'>"); 
          $("#tempb").val(v2).select(); 
          document.execCommand("copy"); 
          $("#tempb").remove();
          $("#tdcc"+id).removeClass('atendido');
     };


      function copynm(id){   

          var v3 =  $("#lc"+id).text();
          $("body").append("<input type='text' id='tempc'>"); 
          $("#tempc").val(v3).select(); 
          document.execCommand("copy"); 
          $("#tempc").remove();
          $("#tdnm"+id).removeClass('atendido');
     };

      function copyage(id){   

          var v4 =  $("#ld"+id).text();
          $("body").append("<input type='text' id='tempd'>"); 
          $("#tempd").val(v4).select(); 
          document.execCommand("copy"); 
          $("#tempd").remove();
          $("#tdage"+id).removeClass('atendido');
     };

      function copydoc(id){   

          var v4 =  $("#le"+id).text();
          $("body").append("<input type='text' id='tempe'>"); 
          $("#tempe").val(v4).select(); 
          document.execCommand("copy"); 
          $("#tempe").remove();
          $("#tddoc"+id).removeClass('atendido');
     };

    $(document).ready(function(){
      $("#ocultar").click(function(){
        $('#repetir_servicios').text("si sirve");
      });

    });
        
</script>
<script>
      $(document).ready(function() {
        $('#signArea').signaturePad({penWidth: 2, penColour : '#000', drawOnly:true, drawBezierCurves:true, lineTop:300});
      });

      $('#resetfirma').click(function(){
        var api = $('#signArea').signaturePad();
        var sig = api.clearCanvas();
      });

      $('.btnModal').click(function(){
        var id = this.id;
         $(this).removeClass('btn-danger');
         $(this).addClass('btn-primary');
        $.ajax
        ({
          type: 'POST',
          url: '../../modulos/firma/save_sign.php',
          data: $('#formUserFirma'+id).serialize(),
          success: function (data) {
            datos = jQuery.parseJSON(data);

            console.log(datos);
            if(datos.nom_2){
              $('.modal-title').text('Firma Paciente: | '+datos.nom_1+' '+datos.nom_2+' '+datos.ape_1);
             }else{
              $('.modal-title').text('Firma Paciente: | '+datos.nom_1+' '+datos.ape_1);
             }
             $('#cita_id').val(datos.id_cita);
            }
        });
      });
      
      $("#btnSaveSign").click(function(e){
        html2canvas([document.getElementById('sign-pad')], {
          onrendered: function (canvas) {

            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
            //ajax call to save image inside folder
            $.ajax({
              url: '../../modulos/firma/save_sign.php',
              data: { img_data:img_data, action:'store' },
              type: 'post',
              dataType: 'json',
              success: function (response) {
                 window.location.reload();
              }
            });
          }
        });
      });
    </script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>