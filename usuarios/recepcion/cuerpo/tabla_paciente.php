<div class="row debajo"><div class="col-md-1"></div>
        <div class="col-lg-11">
          <div class="panel panel-default">
            <div class="panel-heading" style="background:#1B776D;">
              <center class="bg-success"> 
                <b>Cuadro de pacientes</b>
              </center>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <div class="container-fluid">
                  <table class="example1 table table-condensed table-striped table-bordered dt-responsive table-hover nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style="width:40px;">No.</th>
                        <th style="width:70px;">Tipo.DC</th>
                        <th style="width:140px;">No.DC</th>
                        <th style="width:160px;">Nombre1</th>
                        <th style="width:160px;">Nombre2</th> 
                        <th style="width:160px;">Apellido1</th>
                        <th style="width:160px;">Apellido2</th>
                        <th style="width:180px;">Nacimiento</th>
                        <th style="width:130px;">Edad</th>
                        <th style="width:60px;">Sexo</th>
                        <th>Telefono</th>
                        <th style="width:60px;">Citas</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                    </tr>
                </thead>
                   
                <tbody>
                  <?php
                  while($reg = $consulta->fetch_object())
                  {
                    $ffnac=$reg->ff_nac;
                    $nac="SELECT DATEDIFF(curdate(),'$ffnac') AS edad ";
                    $nac=$enlace->query($nac);
                    $nac=$nac->fetch_object();
                    $age=  $nac->edad/365.25 ;       
                    $sexo=$reg->sexo;
                      if($sexo=="Masculino"){$sexo="M";}elseif($sexo=="Femenino"){$sexo="F";}
                  ?>

                  <tr>
                    <td class="items"><?php echo mb_convert_encoding($reg->id_paciente, "UTF-8")?></td> 
                    <td><a href="javascript:copyTp(<?php echo $reg->id_paciente; ?>);"><label id="la<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->tipo_dc, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyDc(<?php echo $reg->id_paciente; ?>);"><label id="lb<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->num_dc, "UTF-8") ?></label></a></td>
                    <td><a href="javascript:copyN1(<?php echo $reg->id_paciente; ?>);"><label id="lc<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->nom_1, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyN2(<?php echo $reg->id_paciente; ?>);"><label id="ld<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->nom_2, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyA1(<?php echo $reg->id_paciente; ?>);"><label id="le<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ape_1, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyA2(<?php echo $reg->id_paciente; ?>);"><label id="lf<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ape_2, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyff(<?php echo $reg->id_paciente; ?>);"><label id="lg<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->ff_nac, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyAge(<?php echo $reg->id_paciente; ?>);"><label id="lh<?php echo $reg->id_paciente; ?>"><?php echo floor($age); ?></label></a></td>
                    <td><a href="javascript:copySexo(<?php echo $reg->id_paciente; ?>);"><label id="li<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($sexo, "UTF-8")?></label></a></td>
                    <td><a href="javascript:copyTel(<?php echo $reg->id_paciente; ?>);"><label id="lj<?php echo $reg->id_paciente; ?>"><?php echo mb_convert_encoding($reg->telefono, "UTF-8")?></label></a></td>
                    <td><a href="php/factura.php?id=<?php echo $reg->id_paciente ?>"  class="glyphicon glyphicon-list-alt citas"></a> 
                              <a href="php/ver.php?id=<?php echo $reg->id_paciente ?>"  class="glyphicon glyphicon-eye-open citas"></a></td>
                    <td><a href="php/editar_paciente.php?id=<?php echo $reg->id_paciente; ?>" class=" glyphicon glyphicon-edit"></a></td>
                  </tr>
            <?php } ?>
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
          </div> <!-- /.panel-body -->
        </div><!-- /.panel -->
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
             
 