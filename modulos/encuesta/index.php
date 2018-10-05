<!DOCTYPE html>
<html>
<head>
	<title>Encuesta - RIOM</title>
	<link rel="stylesheet" type="text/css" href="../../cp/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/encuesta.css">
</head>
<body>
		<div class="container">
			<form action="php/encuesta.php" method="post">
				<input type="hidden" name="action" value="store">
				<input type="hidden" name="questionOne">
				<input type="hidden" name="flujo1">
				<input type="hidden" name="questionTwo">
				<input type="hidden" name="flujo2">
				<input type="hidden" name="questionThree">
				<input type="hidden" name="questionFour">
			</form>
		</div>

<?php 
	require_once('modal/questionOne.php');
	require_once('modal/flujo1.php');
	require_once('modal/questionTwo.php');
	require_once('modal/flujo2.php');
	require_once('modal/questionThree.php');
	require_once('modal/questionFour.php');
	require_once('modal/resp.php');
?>

</body>
	<script type="text/javascript" src="../../cp/jquery.js"></script>
	<script type="text/javascript" src="../../cp/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/encuesta.js"></script>
</html>