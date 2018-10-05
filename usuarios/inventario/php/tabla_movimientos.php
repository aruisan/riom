      <div id="cuadro-citas">
        <div class="row col-md-12 tabla col-sm-6 col-xs-4">       
          <div class="col-md-12">

            <div class="panel panel-warning col-md-12">
              <div class="panel-heading text-center">
                Movimientos por Lote
              </div>
              <div class="panel-body">
                <table class="example2 table table-condensed table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Fecha</th>
                      <th>Stock</th>
                      <th>Lote</th>
                      <!--<th class="text-center"> <i class="fa fa-minus-circle" aria-hidden="true"></i> </th>-->
                    </tr>
                  </thead>
                  <tbody> 
                    <?php while($reg = $consulta->fetch_object()){ 
                      ?>
                    <tr>
                      <td><?= $reg->id; ?></td>
                      <td><?= $reg->fecha; ?></td>
                      <td class="<?= $semaforo ?>" ><?= $reg->cantidad; ?></td>
                      <td><?php $fecha_actual = new DateTime($reg->lote); echo  $fecha_actual->format("Ymd").'-'.$reg->id_inventario; ?></td>
                      <!--<td class="text-center">
                        <a data-toggle="modal" data-target="#salida" data-dismiss="modal" id="<?= $reg->id_inventario; ?>" class="btn btn-danger btn-xs salida"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                      </td>-->
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

    <script>

        $(document).ready(function() {
        $('.example2').DataTable({
          "destroy": true,
          "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
        });
        } );
         
    </script>