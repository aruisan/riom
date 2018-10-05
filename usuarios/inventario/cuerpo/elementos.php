    <div class="list-group col-md-8 col-md-offset-2 " >
      <button class="btn btn-primary" id="create-esterilizacion">Nuevo Elemento</button>
      <div class="row ocultar" id="div-create">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crudElementos.php" method="POST">
          <input type="hidden" name="action" id="action" value="create">
          <center><h3>Crear Nuevo Elemento</h3></center>

          <div class="col-md-7 form-group has-primary">
            <label class="label-control">nombre</label>
            <input type="text" name="nombre" placeholder="Nombre Elemento" class="form-control" required>
          </div>
          <div class="col-md-2 form-group has-primary">
            <label class="label-control">Codigo</label>
            <input type="text" name="codigo" placeholder="Codigo" class="form-control col-md-4" required>
          </div>
          <div class="col-md-3 form-group has-primary">
            <label class="label-control">Stock Minimo</label>
            <input type="text" name="stock" placeholder="Stock Minimo" class="form-control col-md-4" required>
          </div>
          <div class="col-md-8 form-group has-primary">
            <label class="label-control">Marca</label>
            <input type="text" name="marca" placeholder="Marca" class="form-control col-md-4" required>
          </div>
          
          <div class="col-md-4 form-group has-primary">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="medida">
              <option>unidades</option>
              <option>paquete</option>
              <option>cajas</option>
              <option>gramos</option>
              <option>mililitro</option>
              <option>cm3</option>
            </select>
          </div>

          <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
      </div>

      <div class="row ocultar" id="div-update">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crudElementos.php" method="POST">
          <input type="hidden" name="action" id="action" value="update">
          <input type="hidden" name="id" id="id">
          <center><h3>Editar Elemento</h3></center>

          <div class="col-md-7 form-group has-success">
            <label class="label-control">nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre Elemento" class="form-control" required>
          </div>

          <div class="col-md-2 form-group has-success">
            <label class="label-control">Codigo</label>
            <input type="text" name="codigo" id="codigo" placeholder="Codigo" class="form-control col-md-4" required>
          </div>

          <div class="col-md-3 form-group has-success">
            <label class="label-control">Stock Minimo</label>
            <input type="text" name="stock" id="stock" placeholder="Stock Minimo" class="form-control col-md-4" required>
          </div>

          <div class="col-md-8 form-group has-success">
            <label class="label-control">Marca</label>
            <input type="text" name="marca" id="marca" placeholder="Marca" class="form-control col-md-4" required>
          </div>
          
          <div class="col-md-4 form-group has-success">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="medida" id="medida">
              <option>unidades</option>
              <option>paquete</option>
              <option>cajas</option>
              <option>gramos</option>
              <option>mililitro</option>
              <option>cm3</option>
            </select>
          </div>

          <input type="submit" value="Enviar" class="btn btn-success">
        </form>
      </div>
    </div>
    <br>
    <br>
    </div>
      <div id="cuadro-citas">
        <div id="cuadro-tabla" class="row col-md-12 tabla col-sm-6 col-xs-4">       
          <div class="col-md-12" id="citas">
            <table class="example1 table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>     
                  <th>No.</th>
                  <th>Nombre</th>
                  <th>Codigo</th>
                  <th>Marca</th>
                  <th>Medida</th>
                  <th>Stock Minimo</th>
                  <th> <i class="fa fa-pencil" aria-hidden="true"></i> <i class="fa fa-trash" aria-hidden="true"></i> </th>
                </tr>
              </thead>
              <tbody>  
                <?php while($reg = $consulta->fetch_object()){ ?>
                <tr>
                  <td><?= $reg->id; ?></td>
                  <td><?= $reg->nombre;?></td>
                  <td><?= $reg->codigo; ?></td>
                  <td><?= $reg->marca; ?></td>
                  <td><?= $reg->medida; ?></td>
                  <td><?= $reg->minimo; ?></td>
                  <td>
                    <button class="btn btn-success edit btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <a href="php/crudElementos.php?action=delete&id=<?= $reg->id ?>" class="btn btn-danger  btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>