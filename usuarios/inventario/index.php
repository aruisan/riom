
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


if($reg->tipo==6){
   $url_logo="../../cp/";
//___________________________________________________________
$sql = "SELECT i.ffhh, e.*, sum(m.cantidad) as stock, datediff(ff_vencimiento, now()) as dia
        FROM `inventario` i, elemento e, movimientos m 
        WHERE i.id_elemento = e.id 
        AND i.id = m.id_inventario 
        group by id_elemento";
$consulta = $enlace->query($sql);

$sqlElementos = "SELECT nombre, id FROM elemento WHERE anulado = 0";
$consultaElementos = $enlace->query($sqlElementos);
$consultaElementos2 = $enlace->query($sqlElementos);
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

  .bg-amarillo{
    background: #e38d13;
    color: white;
  }

  .bg-rojo{
    background: #ac2925;
    color: white;
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

    <ul class="nav nav-tabs">
      <li class="active"><a href="index.php">Movimientos</a></li>
      <li><a href="elementos.php">Elementos</a></li>
    </ul>
    <br>


    <?php include_once('cuerpo/inventarios.php'); ?>


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
        $('.example1, .example2').DataTable({
          "destroy": true,
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
        var url = "php/crudMovimientos.php";
        var action = "edit";

        $.post(url,{action:action, id:id}, function(data){
          console.log(data);
          var datos = JSON.parse(data);

          $('#id').val(datos.id);
          $('#idM').val(datos.idM);
          $('#ff_vencimiento').val(datos.ff_vencimiento);
          $('#cantidad').val(datos.cantidad);
          $('#ffhh').val(datos.ffhh);
          $('#id_elemento').append('<option value="'+datos.id_elemento+'" selected>'+datos.nombre+'</option>')

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