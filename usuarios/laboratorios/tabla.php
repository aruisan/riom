<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset="UTF-8">
  <title>DataTables</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel='stylesheet'>
  <link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div id='Etiquetas'>
	  <div class="container-fluid">
        <table id="plagas" class="table table-striped table-bordered">
          <caption class="text-center"><h3>Plaguicidas autorizados en México</h3></caption>
          <thead>
            <tr>
              <th>Grupo</th>
              <th>Nombre Comercial</th>
              <th>Ingrediente</th>
              <th>Registro</th>
              <th>Vigencia</th>		
               <th>CARRITO</th>  	  
            </tr>
          </thead>

          <tfoot>
            <tr>
              <th>Grupo</th>
              <th>Nombre Comercial</th>
              <th>Ingrediente</th>
              <th>Registro</th>
              <th>Vigencia</th>	
               <th>CARRITO</th>  		  
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- Etiquetas -->
    <div class="row">
      <div class="col-md-3">H. Veracruz, Ver. México</div>
      <div class="col-md-6">© José Evaristo Pacheco Velasco. Dr. Juan Antonio Villanueva Jiménez</div>
      <div class="col-md-3">2016</div>
    </div>
  </div> <!-- container -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
  <script src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script src="index.js"></script>
</body>
</html>