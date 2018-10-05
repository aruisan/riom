      <div id="cuadro-citas">
        <div class="row col-md-12 tabla col-sm-6 col-xs-4">       
          <div class="col-md-12">
            <div class="panel panel-info col-md-8 col-md-offset-2">
              <div class="panel-heading text-center">
                Datos del elemento
              </div>
              <div class="panel-body">
                <table class="table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td colspan="2"></td>
                    </tr>
                    <tr>
                      <td><b>Nombre:</b></td>
                      <td><?= $elemento->nombre; ?></td>
                    </tr>
                    <tr>
                      <td><b>Marca:</b></td>
                      <td><?= $elemento->marca; ?></td>
                    </tr>
                    <tr>
                      <td><b>Codigo:</b></td>
                      <td><?= $elemento->codigo; ?></td>
                    </tr>
                    <tr>
                      <td><b>Medida:</b></td>
                      <td><?= $elemento->medida; ?></td>
                    </tr>
                  </tbody>
                </table>    
              </div>
            </div>

            <div class="panel panel-primary col-md-12">
              <div class="panel-heading text-center">
                Datos de los movimientos del elemento
              </div>
              <div class="panel-body">
                <table class="example1 table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">dias a vencer</th>
                      <th class="text-center">Stock</th>
                      <th class="text-center">Lote</th>
                      <th class="text-center" class="text-center"> <i class="fa fa-minus-circle" aria-hidden="true"></i> <i class="fa fa-list-ol" aria-hidden="true"></i> </th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php while($reg = $consulta->fetch_object()){ 


                      if($reg->dia <= 10){$semaforoDia = "bg-rojo";}elseif($reg->dia > 10 && $reg->dia < 20){ $semaforoDia = "bg-amarillo"; }else{$semaforoDia = ""; }

                      ?>
                    <tr>
                      <td><?= $reg->id_inventario; ?></td>
                      <td><?= $reg->fecha; ?></td>
                      <td class="text-center <?= $semaforoDia; ?>"><?= $reg->dia; ?></td>
                      <td><?= $reg->stock; ?></td>
                      <td><?= $reg->lote; ?></td>
                      <td class="text-center">
                        <a data-toggle="modal" data-target="#salida" data-dismiss="modal" id="<?= $reg->id_inventario; ?>" class="btn btn-danger btn-xs salida"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>

                        <a data-toggle="modal" data-target="#movimientos" data-dismiss="modal" id="<?= $reg->id_inventario; ?>" class="btn btn-warning btn-xs movimientos"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>                      
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="salida" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <form action="php/crudMovimientos.php" method="POST" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center text-primary"></h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Cantidad a Utilizar</label>
                <input type="hidden" name="action" value="salida">
                <input type="hidden" id="id_inventario" name="id_inventario">
                <input type="number" name="cantidad" min="1" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>
              <input type="submit" value="Enviar" class="btn btn-primary">       
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div id="movimientos" class="modal fade" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center text-primary">Movimientos </h4>
            </div>
            <div class="modal-body" id="tabla_movimientos">
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>     
            </div>
          </form>
        </div>
      </div>
    </div>

