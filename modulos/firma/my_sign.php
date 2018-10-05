

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>captura de Firma</title>
		<link href="../../cp/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../../cp/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="../../cp/jquery.js"></script>
		<script src="../../cp/bootstrap/js/bootstrap.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		
		<script type='text/javascript' src="js/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}

			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #000000;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}

			.sign-pad{
				color: black;
			}
		</style>
	</head>
	<body>



		<center style="margin-top: 70px;">
			<h4 class="modal-title">Oprima el boton para ver el paciente</h4>
			<br><br>
			<button type="button" id="btnModal" class="btn btn-primary" data-toggle="modal" data-target="#myFirma">
				Firmar
			</button>
		</center>


		<!-- Modal -->
		<div id="myFirma" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"></h4>
		      </div>
		      <div class="modal-body">
		      		<center>
		      		<div id="signArea">
						<div class="sig sigWrapper" style="height:auto; width:400px; ">
							<div class="typed"></div>
							<canvas class="sign-pad" id="sign-pad" width="390" height="200">ll</canvas>
							<input type="hidden" id="cita_id">
						</div>
					</div>
					</center>
		      </div>
		      <div class="modal-footer">
		        <center>
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerar</button>
		        	<button id="btnSaveSign" class="btn btn-warning">Guardar Firma</button> 
		        	<button id="resetfirma" class="btn btn-success">Reset</button> 
		        </center>
		      </div>
		    </div>

		  </div>
		</div>

		<script>
			$(document).ready(function() {
				$('#signArea').signaturePad({penWidth: 4, penColour : '#000', drawOnly:true, drawBezierCurves:true, lineTop:300});
			});

			$('#resetfirma').click(function(){
				var api = $('#signArea').signaturePad();
				var sig = api.clearCanvas();
			});

			$('#btnModal').click(function(){
				$.ajax
				({
					type: 'POST',
					url: 'save_sign.php',
					data: { action:'datosPaciente' },
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
							url: 'save_sign.php',
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
