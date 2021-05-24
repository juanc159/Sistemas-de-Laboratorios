<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Actas de Recepci&oacute;n <small>DEMO</small> </h1>
  </section>

  <?php 
  echo base_url();
    if ( $this->session->flashdata('ControllerMessage') != '' ) 
    {
      echo $this->session->flashdata('ControllerMessage');   
    } 
  ?> 

  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
            <div class="form-group"> 
              <h3 class="box-title">Actas de Recepci&oacute;n Registradas</h3>
            </div>
          </div>  
          <div class="col-md-3">
            <div class="form-group"> 
              <?php $fecha_ano=$this->uri->segment(3); ?>
              <a class="btn btn-block btn-danger" href="<?php echo base_url().'acta_recepcion/registros/'.$fecha_ano?>">CANCELAR / REGRESAR</a> 
            </div>
          </div>   
        </div>
      </div><!-- /.box-header -->
  
      <form action="" method="post" enctype="multipart/form-data">
        <div class="box-body"> 
          <div class="row">

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>TIPO DE ACTA</label>
                <?php echo form_error('tipo_acta'); ?>  
                <select name="tipo_acta" id="tipo_acta" class="form-control m-b">  
                      <option value="0">-- SELECCIONE --</option>  
                  <option value="RECEPCION"  >RECEPCION</option>
                  <option value="DEVOLUCION"  >DEVOLUCION</option>
                </select> 
              </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                  <label>INSTITUCION SOLICITANTE</label>   
                   <?php echo form_error('id_institucion_solicitante'); ?>  
                  <select class="form-control select2" name="id_institucion_solicitante" class="form-control m-b"> 
                    <option value="0">-- SELECCIONE INSTITUCION SOLICITANTE --</option>
                    <?php 
                      foreach($instituciones as $institucion_solicitante)
                      {
                    ?> 
                    <option value="<?php echo $institucion_solicitante->id_institucion_solicitante;  ?>"  >
                      <?php echo $institucion_solicitante->des_institucion_solicitante;  ?>
                    </option>
                    <?php
                      }
                    ?> 
                  </select>  
                </div>
              </div>   


              <div class="col-md-3">
                <div class="form-group">
                  <label>UNIDAD ACTUANTE</label>  
                   <?php echo form_error('id_unidad_solicitante'); ?>  
                  <select class="form-control select2" name="id_unidad_solicitante" class="form-control m-b"> 
                    <option value="0">-- SELECCIONE UNIDAD ACTUANTE --</option>
                    <?php 
                      foreach($unidades_act as $unidad_solicitante)
                      {
                    ?> 
                    <option value="<?php echo $unidad_solicitante->id_unidad_solicitante;  ?>"  >
                      <?php echo $unidad_solicitante->des_unidad_solicitantente;  ?>
                    </option>
                    <?php
                      }
                    ?> 
                  </select>  
                </div>
              </div> 

              <div class="col-md-3"> 
              <div class="form-group"> 
                <label>DEPENDENCIA:</label>
                <?php echo form_error('dependencia_unidad'); ?>  
                <input type="text" name="dependencia_unidad" id="dependencia_unidad" class="form-control m-b" value="<?php echo set_value("dependencia_unidad")?>">
              </div>
            </div>
          </div><!-- /.FIN ROW -->


          <div class="row">

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>NUMERO DE EXPEDIENTE:</label>
                <?php echo form_error('nro_expediente'); ?>  
                <input type="text" name="nro_expediente" id="nro_expediente" class="form-control m-b" value="<?php echo set_value("nro_expediente")?>">
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>NUMERO DE OFICIO:</label>
                <?php echo form_error('nro_oficio'); ?>  
                <input type="text" name="nro_oficio" id="nro_oficio" class="form-control m-b" value="<?php echo set_value("nro_oficio")?>">
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>FECHA OFICIO:</label>
                <?php echo form_error('fecha_oficio'); ?>  
                <input type="date" name="fecha_oficio" id="fecha_oficio" class="form-control m-b" value="<?php echo set_value("fecha_oficio")?>">
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>TIPO DE EXPERTICIAS:</label>   
                <?php echo form_error('id_tipo_experticia'); ?>  
                <select class="form-control select2" name="id_tipo_experticia" class="form-control m-b"> 
                  <option value="0">-- SELECCIONE TIPO DE EXPERTICIAS --</option>
                  <?php 
                    foreach($experticias as $experticia)
                    {
                  ?> 
                  <option value="<?php echo $experticia->id_tipo_experticia;  ?>"  >
                    <?php echo $experticia->des_experticia;  ?>
                  </option>
                  <?php
                    }
                  ?> 
                </select>   
              </div>
            </div>

          </div><!-- /.FIN ROW -->

          <div class="row">  
            <div class="col-md-6">
              <div class="form-group">
                <label> SUBIR FOTO EVIDENCIA</label> 
                <input class="form-control" multiple='' type="file" name="foto_evidencia[]" id="foto_evidencia" >
              </div>
            </div>
          </div> 

          <div class="row">
                    
            <div class="col-md-12"> 
              <div class="form-group"> 
                <label>EVIDENCIAS:</label>  
                <textarea   id="editor" name="editor" ><?php echo set_value("editor")?>
                    
                    <?php 
                    if ($this->formato==1):  
                    ?> 

                    <p>&nbsp;</p> 

                    <p>&nbsp;</p>

                    <hr />
                    <p style="text-align:justify"><strong>OBSERVACIONES: </strong></p>


                    <?php endif ?>

                  </textarea>
              </div>
            </div>

          </div><!-- /.FIN ROW -->

          <div class="row">

            <div class="col-md-12"> 
              <div class="form-group"> 
                <label>DATOS DEL JEFE DE LA COMISION:</label>  
              </div>
            </div> 
            </div><!-- /.FIN ROW -->


          <div class="row">
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>CEDULA:</label>
                <?php echo form_error('cedula_jefe'); ?>  
                <input type="text" name="cedula_jefe" id="cedula_jefe" class="form-control m-b" value="<?php echo set_value("cedula_jefe")?>" onkeypress="return SoloNumeros(event)" maxlength="8">
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>APELLIDOS Y NOMBRES:</label>
                <?php echo form_error('ape_nom_jefe'); ?>  
                <input type="text" name="ape_nom_jefe" id="ape_nom_jefe" class="form-control m-b" value="<?php echo set_value("ape_nom_jefe")?>" onkeypress="return Sololetras(event)" >
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>GRADO / JERARQUIA:</label>
                <?php echo form_error('cargo_jefe'); ?>  
                <input type="text" name="cargo_jefe" id="cargo_jefe" class="form-control m-b" value="<?php echo set_value("cargo_jefe")?>">
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>TELEFONO:</label>
                <?php echo form_error('telefono_jefe'); ?>  
                <input type="text" name="telefono_jefe" id="telefono_jefe" class="form-control m-b" value="<?php echo set_value("telefono_jefe")?>" onkeypress="return SoloNumeros(event)">
              </div>
            </div>

          </div><!-- /.FIN ROW -->



            <div class="row">
              <div class="col-md-6">
                <div class="form-group"> 
                  <a class="btn btn-block btn-danger" href="<?php echo base_url()?>acta_recepcion">CANCELAR / REGRESAR</a>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="form-group"> 
                  <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
                </div>
              </div>   
            </div><!-- /.FIN ROW -->


        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </form>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>

 <script>


  initSample();
  initSample2();
 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 
  }) 
 
</script>

<script >
  $(function () {
    $("#example1").DataTable(); 
  });
</script>