<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Actas de Recepci&oacute;n
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

<?php
      foreach($datos as $dato)
      {
    ?> 
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Registrar un Acta Nueva</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                  <table>
                    <tr>
                      <td>
                        TIPO DE ACTA:
                      </td>
                      <td>
                        <input disabled="disabled" type="text" name="nro_acta" id="nro_acta"  value="<?php echo $dato->tipo_acta ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        NUMERO DE ACTA:
                      </td>
                      <td>
                        <input disabled="disabled" type="text" name="nro_acta" id="nro_acta"  value="<?php echo $dato->nro_acta ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        FECHA DEL ACTA:
                      </td>
                      <td>
                        <input disabled="disabled" type="date" name="fecha_acta" id="fecha_acta" value="<?php echo $dato->fecha_acta ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        UNIDAD SOLICITANTE:
                      </td>
                      <td> 
                        <input disabled="disabled" type="text" name="des_unidad_solicitantente" id="des_unidad_solicitantente" value="<?php echo $des_unidad_solicitantente ?>"> 
                      </td>
                    </tr>                    
                    <tr>
                      <td>
                        NUMERO DE OFICIO:
                      </td>
                      <td>
                        <input disabled="disabled" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo $dato->nro_oficio ?>">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        FECHA OFICIO:
                      </td>
                      <td>
                        <input disabled="disabled" type="date" name="fecha_oficio" id="fecha_oficio" value="<?php echo $dato->fecha_oficio ?>">
                      </td>
                    </tr> 
                    <tr>
                      <td>
                        TIPO DE EXPERTICIAS:
                      </td>
                      <td>
                        <input disabled="disabled" type="text" name="des_experticia" id="des_experticia" value="<?php echo $des_experticia ?>">

                      </td>
                    </tr> 
                    <tr> 
                      <td>
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $dato->id_usuario ?>">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        EXPERTOS DESIGNADOS:
                      </td>
                      <td>
                        <input disabled="disabled" type="text" name="id_exp_desig" id="id_exp_desig" value="<?php echo $des_exp_desig ?>">
                      </td>
                    </tr>
                    <tr>
                      <td> 
                        <a href="<?php echo base_url()?>acta_recepcion">regresar</a>
                      </td>
                      <td> 
                        <a href="<?php echo base_url()?>acta_recepcion/nuevo3/<?php echo $dato->nro_acta?>">OBSERVACIONES</a>
                      </td>
                      <td> 
                        <a target='v' href="<?php echo base_url()?>acta_recepcion/pdf/<?php echo $dato->nro_acta?>">GENERAR PDF</a>
                      </td>

                      <td> 
                      </td>
                    </tr>
                  </table>
                  

                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
      }
    ?> 
 
        <!-- AQUI EMPEZAMOS EL CODIGO DE LAS EVIDENCIAS PARA AGREGAR  Y MOSTRAR -->
             <form action="" method="post">
            <table>
                    <tr>
                      <td>
                        EVIDENCIA:
                      </td>
                      <td>
                        <textarea id="evidencia" name="evidencia" rows="3" cols="90"></textarea> 
                      </td>
                    </tr>
                    <tr>
                      <td> 
                        <a href="<?php echo base_url()?>acta_recepcion">regresar</a>
                      </td>
                      <td>
                        <input type="submit"   value="Agregar" >
                      </td>
                    </tr>
                  </table>

                </form>


             <div class="box">
                <div class="box-header">
                 <h1 class="box-title"><strong> EVIDENCIAS:</strong> </h1>
                </div><!-- /.box-header -->
                <div class="box-body">

                <table id="example1" class="table table-bordered table-striped">   
                <thead>
                      <tr>
                        <th>Numero</th>
                        <th>Descripcion</th>  
                      </tr>
                    </thead> 
                <?php
                  foreach($datos_evi as $dato)
                  {
                ?> 
                  <tr> 
                    <td>
                      <h4 class="box-title"><strong> # <?php echo $dato->id_evidencia ?>:</strong> </h4>
                    </td>
                    <td>
                      <?php echo $dato->des_evidencia ?>
                    </td>
                  </tr> 
                <?php
                  }
                ?>
                </table> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->



 

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>
