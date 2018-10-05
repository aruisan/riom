

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

if($reg->tipo==2){

  $url_logo="../../cp/";
  //_____________________________________________________________

date_default_timezone_set('America/Bogota'); 
$fecha =  date('Y-m-d');
$sql="SELECT p.*, c.ff FROM paciente p, cita c where p.id_paciente = c.cita_paciente AND c.ff = '$fecha'";
$consulta = $enlace->query($sql);



$sql_usu="SELECT * FROM usuario where tipo=2 ORDER BY nom_usuario DESC";
$consulta_usu= $enlace->query($sql_usu);


/*$sql_ffhh_actual = "SELECT curdate() as fecha";
$ffhh_actual = $enlace->query($sql_ffhh_actual);
$ff= $ffhh_actual->fetch_object();
$fecha = $ff->fecha*/


?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Recepcion - Pacientes</title>
<!-- Latest compiled and minified CSS -->
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="<?php echo $url_logo; ?>riom.png" />
<link href="../../cp/responsive.boostrap.min.css">
<link href="../../cp/dataTables.bootstrap.min.css">
<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/stilo.css">
</head>

<body>

	<div class="container">
    <!--nav principal-->
    <?php require_once('cuerpo/encabezado.php'); ?>
  <!--fin nav principal-->
  <!--contenedor migas-->
    <div class="container-fluid row">
      <ol class="breadcrumb">
        <li>Recepcion</li>
      </ol>
    </div>
  <!--fin contenedor migas-->
   <!--- formulario ingreso -->
  <?php require_once('cuerpo/form_ingresar.php'); ?>
  <!--- fin formulario ingreso -->
  <!--- botones -->
   	<div id="cuadro-tabla" class="row col-md-10 tabla col-sm-6 col-xs-4">
	   	<button id="mostrar" class="btn-success glyphicon glyphicon-paste botoncito-redondeado"></button>
	    <div class="input-group  botones">
	    	<input type="text" value="<?= $fecha; ?>" id="year" class="calendario form-control alert calendario alert-danger">
		    <div class="input-group-btn ">
		   		<div class="btn-group-lg">
		        	<a type="button" title="Inicio" href="#" class="btn  glyphicon glyphicon-user active"></a>
		        	<a type="button" title="Citas" href="usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
		        	<a type="button" title="Servicios" href="cuentas.php" class="btn  btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
		            <a type="button" title="Doctores" href="tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="iconos/dr.png"></center></a> 
		            <a type="button" title="Examenes" href="tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="iconos/exa.png"></center></a> 
		            <a type="button" title="Cuentas" id="dinero" class="btn btn-default"><center><img style="width:20px;" src="iconos/cuentas.png"></center></a>
                <a href="/modulos/firma/" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
		        </div>
		    </div>
	    </div>
   	</div>
  <!--- fin botones -->

   <!--- generador de cuentas -->
    <div id="cuadro-dinero">
                  <center>
                    <button tyle="button" class="close btn btn-danger ocultar" >&times;</button><br>
                    <label>Usuario: </label> 
                    <select id="user">
                      <option value="*">Todos</option>
                      <?php while($reg_usu=$consulta_usu->fetch_object()){ ?>
                      <option value="<?php echo $reg_usu->id_usuario; ?>" class="iguala"><?php echo $reg_usu->nick; ?></option>
                      <?php } ?>
                    </select>
                    <input id="fecha" type="date" class="iguala" value="<?php echo $ffhh; ?>">
                    <button id="consultar">Consultar</button><br><br>
                    <div id="valores-balance">
                    </div>
                    <button id="gastos" class="btn btn-success">Ingresar Gastos</button>
                  </center>
    </div>
   <!--- *** fin generador de cuentas -->
 <!--- generador de gastos -->
    <div id="cuadro-gastos">
                  <center>
                    <button tyle="button" class="close btn btn-danger ocultar-gastos" >&times;</button><br>
                    <label class="label-control">Gasto: </label><input id="articulo"  placeholder="Articulo o servicio" class="input-control">
                    <label class="label-control">Cantidad: </label><input id="cant"  type="number" class="input-control" placeholder="Cantidad">
                    <label class="label-control">Valor $: </label><input id="valor"  type="number" class="input-control" placeholder="precio">
                    <button id="ingresar-gastos" class="btn btn-warning">Ingresar</button>
                  </center>
                  <div id="resultado-gastos">
                  </div>
                  <div id="valores-balance"> 
                  </div>
    </div>

    <div id="resultados-editar_gastos">
    </div>
   <!--- fin generador de gastos -->

	<!--- ***  tabla ajax-->
    <div class="row" id="cuadro-citas">

      <?php require('cuerpo/tabla_paciente.php'); ?>
	  </div>
	<!--- ***  fin tabla ajax-->

<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>
    <script src="../../cp/jquery.dataTables.min.js"></script>
        <script src="../../cp/dataTables.responsive.min.js"></script>
        <script src="../../cp/dataTables.bootstrap.min.js"></script>
        <script src="../../cp/bootstrap-datepicker.js"></script>
		<script src="../../cp/bootstrap-datepicker.es.min.js"></script>
    <script>
    $(document).ready(function() 
    {
      tabla_paciente();
      calendario();
	   } );


    function tabla_paciente()
    {
        $('.example1').DataTable({
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
    } 



	    //-----------------------
		function calendario()
		{
		        $.fn.datepicker.defaults.format = "yyyy/mm/dd";
		         $('.calendario').datepicker({
		            format: "yyyy/mm/dd",
		            language: "es",
		            autoclose: true
		            });
    }
		                    

		//----------------------------




		$('#year').change(function(){
		  tabla_inicial();
		});
		//----------------------------
		function tabla_inicial(){
		  var url = "tabla_index.php";
		  var year = $("#year").val();
		  $.ajax
		  ({
		    type: "POST",
		    url: url,
		    data: {year:year}, // Adjuntar los campos del formulario enviado.
		    success: function(data)
		    {
		      $("#cuadro-citas").show("low").html(data);
		    } 
		  });

		}
		//-----------------------
      </script>
      <script type="text/javascript">

        $("#mostrar").hover(function()
        {
            $('#target').show(3000);
            $('.target').show("slow");

            var url = "php/cc.php"; // El script a dónde se realizará la petición.
            var valor1=$("#buscar").val();
            $.ajax({

               type: "POST",
               url: url,
               data: {cc:valor1}, // Adjuntar los campos del formulario enviado.
               success: function(data)
               {
                    var datos = eval(data);
                   $("#ndc").val(datos[0]);
               } 
            });
         });


        $(".ocultar").hover(function(){
            $('.target').hide("slow");
            $('#cuadro-dinero').hide("slow");
            $('#cuadro-gastos').hide("slow");
        });


//-------------------------
$("·citas").click(function(){

        var url = "factura.php"; // El script a dónde se realizará la petición.
        var valor1=$("#id").val();
        $.ajax({
           type: "POST",
           url: url,
           data: {cita:valor1}, // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
                var datos = eval(data);
               $("#num2").val(datos[0]);
               $("#num").text("Fact. No. "+datos[0]);
           }
         });
  });

//__________________________________________________
$('#dinero').click(function(){
  $('#cuadro-dinero').show(500);
  var hoy = new Date();
  var url = "php/gastos.php";

      $.ajax({

           type: "POST",

           url: url,

           data: {hoy:hoy}, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#resultado-gastos").html(data)

           }

  
   });

})
//____________________________________
$("#gastos").click(function(){
  $('#cuadro-gastos').show(500);

})
       $(".ocultar-gastos").hover(function(){
            $('#cuadro-gastos').hide("slow");

});

      
//____________________________________

$('#ingresar-gastos').click(function(){
  var var1 = $("#articulo").val();
  var var2 = $("#cant").val();
  var var3 = $("#valor").val();
  var url = "php/ingresar_gastos.php";

      $.ajax({

           type: "POST",

           url: url,

           data: {gastos:var1, cant:var2, valor:var3 }, // Adjuntar los campos del formulario enviado.

           success: function(data)

           {
               $("#resultado-gastos").html(data)
               $("#articulo").val("");
               $("#cant").val("");
               $("#valor").val("");
           }

  
   });



})
//____________________________________
$('#consultar').click(function(){

      var url = "php/balance.php"; // El script a dónde se realizará la petición.
        var user=$("#user").val();
        var fecha=$("#fecha").val();
        $.ajax({
           type: "POST",
           url: url,
           data: {user:user, fecha:fecha}, // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#valores-balance").html(data);
           }
        });
})
//______________________________





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
  //___________________________________
 function copyTp(id){   
          
     
        
      
          var v1 =  $("#la"+id).text();
        $("body").append("<input type='text' id='tempa'>"); 
        $("#tempa").val(v1).select(); 
        document.execCommand("copy"); 
        $("#tempa").remove();
   };
  //___________________________________
   function copyDc(id){   
          
     
        
      
          var v2 =  $("#lb"+id).text();
        $("body").append("<input type='text' id='tempb'>"); 
        $("#tempb").val(v2).select(); 
        document.execCommand("copy"); 
        $("#tempb").remove();
   };
  //___________________________________
    function copyN1(id){   
          
     
        
      
          var v3 =  $("#lc"+id).text();
        $("body").append("<input type='text' id='tempc'>"); 
        $("#tempc").val(v3).select(); 
        document.execCommand("copy"); 
        $("#tempc").remove();
   };
  //___________________________________
    function copyN2(id){   
          
     
        
      
          var v4 =  $("#ld"+id).text();
        $("body").append("<input type='text' id='tempd'>"); 
        $("#tempd").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempd").remove();
   };
  //___________________________________
      function copyA1(id){   
          
     
        
      
          var v4 =  $("#le"+id).text();
        $("body").append("<input type='text' id='tempe'>"); 
        $("#tempe").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempe").remove();
   };
  //___________________________________
        function copyA2(id){   
          
     
        
      
          var v4 =  $("#lf"+id).text();
        $("body").append("<input type='text' id='tempf'>"); 
        $("#tempf").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempf").remove();
   };
  //___________________________________
        function copyff(id){   
          
     
        
      
          var v4 =  $("#lg"+id).text();
        $("body").append("<input type='text' id='tempg'>"); 
        $("#tempg").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempg").remove();
   };
  //___________________________________
        function copyAge(id){   
          
     
        
      
          var v4 =  $("#lh"+id).text();
        $("body").append("<input type='text' id='temph'>"); 
        $("#temph").val(v4).select(); 
        document.execCommand("copy"); 
        $("#temph").remove();
   };
  //___________________________________
        function copySexo(id){   
          
     
        
      
          var v4 =  $("#li"+id).text();
        $("body").append("<input type='text' id='tempi'>"); 
        $("#tempi").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempi").remove();
   };
  //___________________________________
     function copyTel(id){   
          
     
        
      
          var v4 =  $("#lj"+id).text();
        $("body").append("<input type='text' id='tempj'>"); 
        $("#tempj").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempj").remove();
   };
  //___________________________________




</script>

</body>
</html>
<?php }else{
  header("Location:../../error3.php");

}?>