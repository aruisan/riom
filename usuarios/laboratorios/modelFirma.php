<!-- Modal -->
		<div id="myFirma" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header ">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"></h4>
		      </div>
		      <div class="modal-body">
		      		<center>
		      		<div id="signArea">
						<div class="sig sigWrapper" style="height:auto; width:250px; ">
							<div class="typed"></div>
							<canvas class="sign-pad" id="sign-pad" width="240" height="75"></canvas>
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