

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"></meta>
<meta http-equiv="content-Type" content="width=divice-cidth,initial-scale=1,maximun-scale=1"></meta>
<title>SESION</title>
<link href="cp/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<p><br></p>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
		 <div class="panel-default panel ">
		 	<div class="panel-body">
		 		<div class="page-header">
		 			<h1 class="text-warning">SOFTWARE</h1>
		 		</div>	
		 		<form role="form" action="index.php" method="POST">
		 			<div class="form-group">
		 				<label for="usu">Usuario</label>
		 				<div class="input-group">
		 					<span class="input-group-addon"><span class="glyphicon-user glyphicon"></span></span>
		 				<input class="form-control" name="usuario" placeholder="Digite el usuario" id="usu"></input>
		 			</div></div>
		 			<div class="form-group">
		 				<label for="clave">Clave</label>
		 				<div class="input-group">
		 					<span class="input-group-addon"><span class="glyphicon-lock glyphicon"></span></span>
		 				<input class="form-control" type="password" name="clave" placeholder="Digite la clave" id="clave"></input>
		 			</div></div>
		 			<input class="btn-success btn" type="reset" value="Borrar">
		 			<button class="btn-info btn" type="submit" name="entrar" value="1">Login</button>
		 		</form>
		 	</div>	
		 </div>
		 </div>
	</div>


	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-sm-5 col-md-6">
		<div class="alert-warning"><h3 class="text-center text-warning">El usuario no tiene permisos asignados</h3></div>
		</div>
	</div>
