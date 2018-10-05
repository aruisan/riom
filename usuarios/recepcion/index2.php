

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


$sql="SELECT * FROM paciente where id_paciente >= 1 and id_paciente <= 100 ORDER BY id_paciente DESC";
$consulta = $enlace->query($sql);

$sql_usu="SELECT * FROM usuario where tipo=2 ORDER BY nom_usuario DESC";
$consulta_usu= $enlace->query($sql_usu);


$sql_registros = "SELECT  count(*) AS registros from paciente";
$registro_actual = $enlace->query($sql_registros);
$registro= $registro_actual->fetch_object();
$entero_registro = $registro->registros/1000; 


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
      <li>Recepcion</a></li>
    </ol>
  </div>
  <div class="row">
    <div class="list-group col-md-12 hidden-xs " >
      <div class="target row col-md-7"> 
        <div class="container col-md-12" id="form">
          <button tyle="button" class="close btn btn-danger ocultar" >&times;</button>
            <form class="form-horizontal form-cita" action="php/insertar.php" name="form1" id="form1" method="POST">
              <fieldset>
                <div class="form-group">
                  <center> 
                    <h3 class="col-md-12" for="ffnac" >Ingreso de Datos del Paciente</h3> 
                  </center>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3" for="cc" >Tipo Doc.</label> 
                  <div class="col-md-3">
                    <select id="tdc" class="form-control" type="text" name="tdc">
                      <option value="CC">CC</option> 
                      <option value="TI">TI</option>
                      <option value="NIT">RC</option>
                      <option value="CE">CE</option>
                    </select>
                  </div>
                  <label class="control-label col-md-1" for="ndc" >No.</label> 
                  <div class="col-md-5">
                    <input id="ndc" class="form-control" type="text" placeholder="Digite la cedula:" name="ndc" >
                  </div><br>
                  <div class="col-md-8">
                  </div>
                  <div id="error-ndc" class="text-danger">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label  col-md-2" for="nombre1" >Nombre(1)</label> 
                  <div class="col-md-4">
                    <input id="nombre1" class="form-control nombre" type="text" placeholder="Primer nombre:" name="nombre1" ></input>
                  </div>
                  <label class="control-label  col-md-2" for="nombre2" >Nombre(2)</label> 
                  <div class="col-md-4">
                    <input id="nombre2" class="form-control nombre2" type="text" placeholder="Segundo nombre:" name="nombre2" ></input>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label  col-md-2" for="apellido1" >Apellido(1)</label> 
                  <div class="col-md-4">
                    <input id="nombre3" class="form-control nombre" type="text" placeholder="Primer apellido:" name="apellido1" ></input>
                  </div>
                    <label class="control-label  col-md-2" for="apellido2" >Apellido(2)</label> 
                  <div class="col-md-4">
                    <input id="nombre4" class="form-control nombre" type="text" placeholder="Segundo apellido:" name="apellido2" ></input>
                  </div><br>
                  <div class="col-md-3">
                  </div> 
                  <div id="error-nombre" class="text-danger">
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label  col-md-2" for="telefono" >Telefono</label> 
                  <div class="col-md-3">
                    <input id="telefono" class="form-control" type="text" name="telefono"></input>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label" for="correo" >Sexo: </label> 
                    <input type="radio" name="sexo" value="Masculino" checked> masculino         
                    <input type="radio" name="sexo" value="Femenino"> femenino
                    <input type="radio" name="sexo" value="Otros"> otros
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label  col-md-4" for="ffnac" >Fecha de nacimiento</label> 
                  <div class="col-md-5">
                    <input id="ffnac" class="form-control" type="date"  name="ffnac" required></input>
                  </div>
                  <div class="col-md-3" id="edad"> 
                  </div><br>
                  <div class="col-md-3">
                  </div>
                </div>

                <div class="form-group">
                  <center>
                    <div class="col-md-9">
                      <input type="reset" value="Borrar" onClick="resetForm()" class="btn btn-danger">
                      <input type="submit" value="Ingresar" onClick="validarFormularios()" class="btn btn-primary citas">
                    </div> 
                  </center>
                </div>

                <center id="resultados">
                  <div class="container">
                    <div id="respuesta">
                      <div id="mensaje" name="mensaje" class="text-warning">
                      </div>
                    </div>
                  </div>
                </center>
              </fieldset>
            </form>
          </div>
        </div>

      <div id="cuadro-tabla" class="row col-md-10 tabla col-sm-6 col-xs-4">
        <button id="mostrar" class="btn-success glyphicon glyphicon-paste botoncito-redondeado"></button>
        <div class="input-group  botones">
          <input type="text" value="<?php echo $entero_registro; ?>" id="year" class="form-control alert calendario alert alert-danger">
          <div class="input-group-btn ">
            <div class="btn-group-lg">
              <a type="button" title="Inicio" href="#" class="btn  glyphicon glyphicon-user active"></a>
              <a type="button" title="Citas" href="usuarios.php" class="btn  btn-primary glyphicon glyphicon-list-alt"></a>
              <a type="button" title="Servicios" href="cuentas.php" class="btn  btn-warning glyphicon glyphicon glyphicon-th-list"></a>  
              <a type="button" title="Doctores" href="tablas/doctores" class="btn  btn-danger"><center><img style="width:20px;" src="iconos/dr.png"></center></a> 
              <a type="button" title="Examenes" href="tablas/examenes" class="btn  btn-info"><center><img style="width:20px;" src="iconos/exa.png"></center></a> 
              <a type="button" title="Cuentas" id="dinero" class="btn btn-default"><center><img style="width:20px;" src="iconos/cuentas.png"></center></a>
            </div>
          </div>
        </div>
      </div>


      <div class="row debajo"><div class="col-md-1"></div>
        <div class="col-lg-11">
          <div class="panel panel-default">
            <div class="panel-heading" style="background:#1B776D;">
              <center class="bg-success"> 
                <b>Cuadro de pacientes</b>
              </center>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <div class="container-fluid">
                  <table class="example table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:40px;">No.</th>
                        <th style="width:70px;">Tipo.DC</th>
                        <th style="width:140px;">No.DC</th>
                        <th style="width:160px;">Nombre1</th>
                        <th style="width:160px;">Nombre2</th> 
                        <th style="width:160px;">Apellido1</th>
                        <th style="width:160px;">Apellido2</th>
                        <th style="width:180px;">Nacimiento</th>
                        <th style="width:130px;">Edad</th>
                        <th style="width:60px;">Sexo</th>
                        <th>Telefono</th>
                        <th style="width:60px;">Citas</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                    </tr>
                </thead>
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
                </div><!--- *** generador de cuentas -->
 <!--- generador de cuentas -->
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

<!--- *** generador de cuentas -->
                <tbody>
                  <?php
                  while($reg = $consulta->fetch_object())
                  {
                    $ffnac=$reg->ff_nac;
                    $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                    $nac=$enlace->query($nac);
                    $nac=$nac->fetch_object();
                    $age=  $nac->edad/365.25 ;       
                    $sexo=$reg->sexo;
                      if($sexo=="Masculino"){$sexo="M";}elseif($sexo=="Femenino"){$sexo="F";}
                  ?>

                  <tr>
                    <td class="items"><?php echo mb_convert_encoding($reg->id_paciente, "UTF-8")?></td> 
                    <td><a href="javascript:copyTp(<?php echo $reg->id_paciente; ?>);"><label id="la<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->tipo_dc, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyDc(<?php echo $reg->id_paciente; ?>);"><label id="lb<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->num_dc, "UTF-8") ?></label></a></td>
                    <td><a href="javascript:copyN1(<?php echo $reg->id_paciente; ?>);"><label id="lc<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->nom_1, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyN2(<?php echo $reg->id_paciente; ?>);"><label id="ld<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->nom_2, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyA1(<?php echo $reg->id_paciente; ?>);"><label id="le<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ape_1, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyA2(<?php echo $reg->id_paciente; ?>);"><label id="lf<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ape_2, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyff(<?php echo $reg->id_paciente; ?>);"><label id="lg<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ff_nac, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyAge(<?php echo $reg->id_paciente; ?>);"><label id="lh<?php echo $reg->id_paciente; ?>"><?php echo floor($age); ?></label></a></td>
                    <td><a href="javascript:copySexo(<?php echo $reg->id_paciente; ?>);"><label id="li<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($sexo, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyTel(<?php echo $reg->id_paciente; ?>);"><label id="lj<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->telefono, "UTF-8")?></label></a></td>
                    <td><a href="php/factura.php?id=<?php echo $reg->id_paciente ?>"  class="glyphicon glyphicon-list-alt citas"></a> 
                              <a href="php/ver.php?id=<?php echo $reg->id_paciente ?>"  class="glyphicon glyphicon-eye-open citas"></a></td>
                    <td><a href="php/editar_paciente.php?id=<?php echo $reg->id_paciente; ?>" class=" glyphicon glyphicon-edit"></a></td>
                  </tr>
            <?php } ?>
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
          </div> <!-- /.panel-body -->
        </div><!-- /.panel -->
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->            
</div>


<script src="js/jquery.js"></script>
<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
<script src="js/validar-formularios.js"></script>
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
    $(document).ready(function(){
        $("#mostrar").hover(function(){
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
           

 

    return false; // Evitar ejecutar el submit del formulario.

           
//-------------------------
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
           

 

    return false; // Evitar ejecutar el submit del formulario.


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
           

 

    return false; // Evitar ejecutar el submit del formulario.


})
//______________________________
         });





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