
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
  $id_elemento = $_GET['id_elemento'];
  $_SESSION['id_elemento'] = $id_elemento;

  $sql ="SELECT sum(m.cantidad) as stock, m.id, DATE(i.ffhh) AS fecha, i.id as id_inventario, i.lote, datediff(ff_vencimiento, now()) as dia from movimientos m, elemento e, inventario i where m.id_inventario = i.id AND i.id_elemento = e.id AND e.id = $id_elemento group by fecha";
  $consulta = $enlace->query($sql);

  $sqlElemento = "SELECT * FROM elemento WHERE id = $id_elemento";
  $consultaElemento = $enlace->query($sqlElemento);
  $elemento = $consultaElemento->fetch_object();
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

    <ol class="breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Movimientos</li>
    </ol>


    <?php include_once('cuerpo/movimientos.php'); ?>


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

      $('.salida').on('click', function(){
            var id = this.id;
            var lote = $(this).parents("tr").find("td").eq(3).html(); 
            $('#id_inventario').val(id)
            $('.modal-title').text('Salida de Stock del Lote '+lote)
      });
         
      $('.movimientos').on('click', function(){
        var action = "movimientos";
        var id = this.id;
        var url = "php/crudMovimientos.php";

        $.post(url,{action:action, id:id}, function(data){
          console.log(data);      
          $('#tabla_movimientos').html(data);
        });
      });

</script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>