<div class="row">
    <div class="list-group col-md-12 hidden-xs " >
      <div class="target row col-md-7"> 
        <div class="container col-md-12" id="form">
          <button tyle="button" class="close btn btn-danger ocultar">&times;</button>
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
                  <input id="ndc" class="form-control" type="text" placeholder="Digite la cedula:" name="ndc" ></input>
                </div>
                <br>
                <div class="col-md-8"></div>
                <div id="error-ndc" class="text-danger"></div>
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
                </div>
                <br>
                <div class="col-md-3"></div> 
                <div id="error-nombre" class="text-danger"></div>
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
                <div class="col-md-3" id="edad"></div>
                <br>
                <div class="col-md-3"></div>
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
                    <div id="mensaje" name="mensaje" class="text-warning"></div>
                  </div>
                </div>
              </center>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>