
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


if($reg->tipo==5){
   $url_logo="../../cp/";
//___________________________________________________________
$sql = "SELECT id, DATE(ff_inicio) as inicial, DATE(ff_final) as final, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, ff_inicio, ff_final )) horas, elemento, cant 
      FROM esterilizacion
      where responsable = $id";
$consulta = $enlace->query($sql);

?>
<style type="text/css">
  .ocultar {
    display: none;  
  }

  #cuadro-tabla{
    padding-top: 20px;
    -webkit-box-shadow: 6px -9px 25px 1px rgba(0,0,0,0.75);
    -moz-box-shadow: 6px -9px 25px 1px rgba(0,0,0,0.75);
    box-shadow: 6px -9px 25px 1px rgba(0,0,0,0.75);
  }


  #div-create,  #div-update{
    -webkit-box-shadow: 10px 10px 31px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 10px 10px 31px 0px rgba(0,0,0,0.75);
    box-shadow: 10px 10px 31px 0px rgba(0,0,0,0.75);
  }

  .cerrar
  {
    right: 5px;
    margin:5px 5px 0px 0px;
  }
</style>






<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Validar un formulario</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../cp/datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="../../cp/font-awesome/css/font-awesome.min.css">

</head>
<body>

  <div class="container">
    <!--nav principal-->
    <?php require_once('../recepcion/cuerpo/encabezado.php'); ?>
    <!--fin nav principal-->
    <!--contenedor migas-->
    <div class="container-fluid row">
      <ol class="breadcrumb">
        <li>Esterilizacion</li>
      </ol>
    </div>
  <!--fin contenedor migas-->

  <div class="container">

    <?php if( $_SESSION['success'] != ""){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="buton" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      <center id="success"><?= $_SESSION['success']; ?></center>  
    </div>
    <?php } $_SESSION['success'] = ""; ?>

    <div class="list-group col-md-8 col-md-offset-2 " >
      <button class="btn btn-primary" id="create-esterilizacion">Nueva Esterilizacion</button>
      <div class="row ocultar" id="div-create">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crud.php" method="POST">
          <input type="hidden" name="action" id="action" value="create">
          <center><h3>Crear Esterilizacion de Elementos</h3></center>
          <div class="col-md-4 form-group has-primary">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="elemento">
              <option>Abrebocas</option>
              <option>Espejos</option>
              <option>Cubetas Plasticas</option>
              <option>Cubetas Metalicas</option>
            </select>
          </div>
          <div class="col-md-3 form-group has-primary">
            <label class="label-control">Cantidad</label>
            <input type="number" name="cant" placeholder="cantidad" class="form-control col-md-4" required>
          </div>
          <div class="col-md-5 form-group has-primary">
            <label class="label-control">Fecha Inicial</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ff_inicio" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
      </div>

      <div class="row ocultar" id="div-update">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crud.php" method="POST">
          <input type="hidden" name="action" id="action" value="update">
          <input type="hidden" name="id" id="id">
          <center><h3>Editar Esterilizacion de Elementos</h3></center>
          <div class="col-md-7 form-group has-success">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="elemento" id="elemento">
              <option>Abrebocas</option>
              <option>Espejos</option>
              <option>Cubetas Plasticas</option>
              <option>Cubetas Metalicas</option>
            </select>
          </div>
          <div class="col-md-5 form-group has-success">
            <label class="label-control">Cantidad</label>
            <input type="number" name="cant" placeholder="cantidad" class="form-control col-md-4" id="cant" required>
          </div>
          <div class="col-md-6 form-group has-success">
            <label class="label-control">Fecha Inicial</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ff_inicio" id="ff_inicio" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="col-md-6 form-group has-success">
            <label class="label-control">Fecha Final</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ff_final" id="ff_final" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <input type="submit" value="Enviar" class="btn btn-success">
        </form>
      </div>
    </div>

    </div>
      <br><br>
      <div id="cuadro-citas">
        <div id="cuadro-tabla" class="row col-md-12 tabla col-sm-6 col-xs-4">       
          <div class="col-md-12" id="citas">
            <table class="example table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Lote</th>
                  <th>Elemento</th>
                  <th>Cantidad</th>
                  <th>Horas</th>
                  <th>Fecha Final</th>
                  <th> <i class="fa fa-pencil" aria-hidden="true"></i> <i class="fa fa-trash" aria-hidden="true"></i> </th>
                </tr>
              </thead>
              <tbody>  
                <?php while($reg = $consulta->fetch_object()){ ?>
                <tr>
                  <td><?= $reg->id; ?></td>
                  <td><?php $fecha_actual = new DateTime($reg->inicial); echo  $fecha_actual->format("Ymd").'-'.$reg->id; ?></td>
                  <td><?= $reg->elemento; ?></td>
                  <td><?= $reg->cant; ?></td>
                  <td><?= $reg->horas; ?></td>
                  <td>
                    <?php  if($reg->final == "0000-00-00")
                    { 
                      echo '<center><a href="php/crud.php?action=finalizar&id='. $reg->id .'" class="btn btn-warning"><i class="fa fa-clock-o" aria-hidden="true"></i></a></center>'; 
                    }else{ echo $reg->final; 
                    } ?>
                  </td>
                  <td>
                    <button class="btn btn-success edit btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <a href="php/crud.php?action=delete&id=<?= $reg->id ?>" class="btn btn-danger  btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



</div>
<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>
    <script src="../../cp/jquery.dataTables.min.js"></script>
        <script src="../../cp/dataTables.responsive.min.js"></script>
        <script src="../../cp/dataTables.bootstrap.min.js"></script>
        <script src="../../cp/moment/moment.js"></script>
        <script src="../../cp/datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script>

        $(document).ready(function() {
        $('.example').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
        </script>

<script type="text/javascript">
    //-----------------------
    $(function () {
            $('.calendario').datetimepicker({
                format: 'YYYY-MM-DD HH:mm', 
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });

    //----------------------------
    $('#create-esterilizacion').on('click', function(){
      $('#div-create').show('low');
      $('#create-esterilizacion').hide('low');
    });

    $('.cerrar').on('click', function(){
      $('#div-create, #div-update ').hide('low');
      $('#create-esterilizacion').show('low');
    });
        

     $(".edit").click(function()
     {
        var id = $(this).parents("tr").find("td").eq(0).html();  
        var url = "php/crud.php";
        var action = "edit";

        $.post(url,{action:action, id:id}, function(data){
          console.log(data);
          var datos = JSON.parse(data);
          $('#id').val(datos.id);
          $('#ff_inicio').val(datos.ff_inicio);
          $('#ff_final').val(datos.ff_final);
          $('#cant').val(datos.cant);
          $('#elemento').append('<option selected>'+datos.elemento+'</option>')

          $('#div-update').show('low');
          $('#create-esterilizacion, #div-create').hide('low');
        });
      });
</script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>