<?php 
session_start();

if(!empty($_POST['salir']))
{

	$_SESSION['id']='';
	session_destroy();
}

if(!empty($_POST['entrar']))
{
	require_once('cp/conexion.php');

	/*mysql_connect("localhost","root","");
	mysql_select_db("riom");*/



	$sql="SELECT *
		  FROM usuario
		  WHERE nick='".$_POST['usuario']."' 
		  AND clave='".$_POST['clave']."'";
	$res = $enlace->query($sql);

	/*$res=mysql_query($sql);
	$num=mysql_num_rows($res);*/

    if($res->num_rows > 0)
    {
     	$row = $res->fetch_object();
     	//$row=mysql_fetch_array($res);
     	$_SESSION['id']=$row->id_usuario;
     	$_SESSION['success'] = "";

	    if($row->tipo == 1)
	    {
	     	header("Location:usuarios/admin");
	 	}else if($row->tipo ==2){
	 		header("Location:usuarios/recepcion");
	 	}else if($row->tipo ==3){
	 		header("Location:usuarios/laboratorios");
		}elseif($row->tipo ==4){
			header("Location:usuarios/mensajero");
		}elseif($row->tipo ==5){
			header("Location:usuarios/esterilizador");
		}elseif($row->tipo ==6){
			header("Location:usuarios/inventario");
		}else {
			header("Location:error2.php");
		}

     }else{
     	header("Location:error1.php");
     }

}


?>



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

	</div>	
</body>
</html>