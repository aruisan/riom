    <div class="list-group col-md-8 col-md-offset-2 " >
      <button class="btn btn-primary" id="create-esterilizacion">Nuevo Movimiento de Inventario</button>
      <div class="row ocultar" id="div-create">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crudMovimientos.php" method="POST">
          <input type="hidden" name="action" id="action" value="create">
          <center><h3>Crear Stock de Elementos</h3></center>
          <div class="col-md-6 form-group has-primary">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="id_elemento">
              <?php while($elementos = $consultaElementos->fetch_object()){ ?>
              <option value="<?= $elementos->id; ?>"><?= $elementos->nombre; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3 form-group has-primary">
            <label class="label-control">Cantidad</label>
            <input type="number" name="cantidad" placeholder="cantidad" class="form-control col-md-4" required>
          </div>
          <div class="col-md-3 form-group has-primary">
            <label class="label-control">Lote</label>
            <input type="text" name="lote" placeholder="Lote" class="form-control col-md-4" required>
          </div>
          <div class="col-md-6 form-group has-primary">
            <label class="label-control">Fecha Ingreso</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ffhh" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="col-md-6 form-group has-primary">
            <label class="label-control">Fecha vencimiento</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ff_vencimiento" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
      </div>

      <div class="row ocultar" id="div-update">
        <button class="btn btn-danger pull-right btn-xs cerrar">X</button>
        <form class="col-md-12" action="php/crudMovimientos.php" method="POST">
          <input type="hidden" name="action" id="action" value="update">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="idM" id="idM">
          <center><h3>Editar Stock de Elementos</h3></center>
          <div class="col-md-6 form-group has-success">
            <label class="label-control">Elementos</label>
            <select class="form-control" name="id_elemento" id="id_elemento">
              <?php while($elementos2 = $consultaElementos2->fetch_object()){ ?>
              <option value="<?= $elementos2->id; ?>"><?= $elementos2->nombre; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3 form-group has-success">
            <label class="label-control">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" placeholder="cantidad" class="form-control col-md-4" required>
          </div>
          <div class="col-md-3 form-group has-success">
            <label class="label-control">Lote</label>
            <input type="text" name="lote" id="lote" placeholder="Lote" class="form-control col-md-4" required>
          </div>
          <div class="col-md-6 form-group has-success">
            <label class="label-control">Fecha Ingreso</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ffhh" id="ffhh" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="col-md-6 form-group has-success">
            <label class="label-control">Fecha vencimiento</label>
            <div class="form-group">
                <div class='input-group date calendario'>
                    <input type='text' class="form-control"  name="ff_vencimiento" id="ff_vencimiento" required/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar">
                        </span>
                    </span>
                </div>
            </div>
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
                  <th>Stock</th>
                  <th>Elemento</th>
                  <!--<th> <i class="fa fa-pencil" aria-hidden="true"></i> </th>-->
                </tr>
              </thead>
              <tbody> 
                <?php while($reg = $consulta->fetch_object()){ 
                  if($reg->stock >= $reg->minimo && $reg->stock <= $reg->minimo+10){ $semaforo = "btn-warning";
                  }elseif($reg->stock < $reg->minimo){ $semaforo = "btn-danger"; }else{ $semaforo = "btn-default"; }

                  ?>
                <tr>
                  <td><?= $reg->id; ?></td>
                  <td><a href="movimientos.php?id_elemento=<?= $reg->id; ?>" class="btn <?= $semaforo ?> stock"><?= $reg->stock; ?></a></td>
                  <td ><?='<b>Nombre:</b>'. $reg->nombre.' <b>Marca:</b> '.$reg->marca.'  <b>codigo:</b>'.$reg->codigo.' <b>Medida:</b> '.$reg->medida; ?></td>
                 <!-- <td>
                    <button class="btn btn-success edit btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  </td>-->
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  