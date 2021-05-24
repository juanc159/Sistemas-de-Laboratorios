<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
$dia=date('d');
$mes_nro=date('m');
$ano=date('y');
$mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];  
$fecha_actual=$dia.$mes[$mes_nro[1]-1].$ano; 
$fecha_actual2=date('d/m/y');


$fecha_ano=$this->uri->segment(3);
?>
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>DEPARTAMENTO DE QUIMICA <small>DEMO</small></h1>
  </section>

   <!-- Main content -->
   <section class="content">
    <!-- Your Page Content Here --> 
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">Registrar Acta de Barrido</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/barrido/'.$fecha_ano?>">CANCELAR / REGRESAR</a>  
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <form  action="" method="post">
        <div class="box-body">
          
          <div class="row">
             

             <div class="col-md-3">
              <div class="form-group">
                <label>2DO EXPERTO</label> 
                 <?php echo form_error('experto'); ?>  
                <select class="form-control select2" name="experto" class="form-control m-b"> 
                  <option value="0">-- SELECCIONE EXPERTO --</option>
                  <option value="0">-- NINGUNO --</option>
                  <?php 
                   $users = $this->ion_auth->users(5)->result();
                    foreach($users as $user)
                    {
                  ?> 
                  <option value="<?php echo $user->id;  ?>"  >
                    <?php echo $user->last_name.' '.$user->first_name;  ?>
                  </option>
                  <?php
                    }
                  ?> 
                  
                </select>  
              </div>
            </div>  

            <input class="form-control" type="hidden" name="quien_autoriza" id="quien_autoriza" value="CNEL. MARIN GONZALEZ EDUARDO E." required>

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
          </div>


          <div class="row"> 

            <div class="col-md-3">
              <div class="form-group">
                <label>QUIEN AUTORIZA:</label> 
                <?php echo form_error('quien_autoriza'); ?> 
                <?php
                  $jefe1="G/B. PEREZ GONZALEZ FRANK ERNESTO";
                  $jefe2="CNEL. MARIN GONZALEZ EDUARDO EMIRO";
                ?>
                <select  class="form-control"   name="quien_autoriza" id="quien_autoriza" >
                  <option value="<?php echo $jefe1; ?>"><?php echo $jefe1; ?></option>
                  <option value="<?php echo $jefe2; ?>"><?php echo $jefe2; ?></option>
                </select>
                 
              </div>
            </div> 
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>SOLICITANTE:</label>
                <?php echo form_error('solicitante'); ?>  
                <input type="text" name="solicitante" id="solicitante" class="form-control m-b" value="<?php echo set_value("solicitante")?>">
              </div>
            </div>  

            <div class="col-md-3">
              <div class="form-group">
                <label>NUMERO DE OFICIO:</label> 
                <?php echo form_error('nro_oficio'); ?> 
                <input class="form-control" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo set_value("nro_oficio")?>" >
              </div>
            </div> 

            <div class="col-md-3">
              <div class="form-group">
                <label>FECHA OFICIO:</label> 
                <?php echo form_error('fecha_oficio'); ?> 
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio" value="<?php echo set_value("fecha_oficio")?>">
              </div>
            </div> 

             
          </div>
 

          <div class="row">      

          <div class="col-md-4">
              <div class="form-group">
                <label>FECHA BARRIDO:</label> 
                <?php echo form_error('fecha_barrido'); ?> 
                <input class="form-control" type="date" name="fecha_barrido" id="fecha_barrido" value="<?php echo set_value("fecha_barrido")?>" >
              </div>
            </div>         

            <div class="col-md-4">
              <div class="form-group">
                <label>LUGAR:</label> 
                <?php echo form_error('lugar'); ?> 
                <input class="form-control" type="text" name="lugar" id="lugar" value="<?php echo set_value("lugar")?>" >
                 
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <label>UBICACIÓN:</label> 
                <?php echo form_error('ubicacion'); ?> 
                <input class="form-control" type="text" name="ubicacion" id="ubicacion" value="<?php echo set_value("ubicacion")?>" >
                 
              </div>
            </div>             

          </div>

        
 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>EVIDENCIA:</label> 
                <textarea   id="editor" name="editor" ><?php echo set_value("editor")?>
                <?php 
                  if ($this->formato==1):  
                  ?> 

                  <p>&nbsp;</p>

                  Posteriormente, se procedió a realizar una revisión minuciosa a las diferentes partes internas y externas;

                  <p>&nbsp;</p>

                  Empleando para ello las técnicas de hisopado y aspirado, colectándose: ___________________, muestras para su traslado al laboratorio, en: ___________________________________________________

                  <p>&nbsp;</p>

                  Consecutivamente, culminado el barrido, el (los) ___________________ quedó (aron) en las mismas instalaciones (SI __ NO __) bajo custodia de: ___________________. Dicho acto se llevó a cabo con la presencia de los ciudadanos: ____________________________________________________________________________________________________________________________________________________________________________________________________________
                  <?php endif ?>
                </textarea>
              </div>
            </div>  
          </div>
 

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/barrido/'.$fecha_ano?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>   
          </div>
  
        </div><!-- /.box-body -->
      </form>
    </div><!-- /.box -->

 
  </section><!-- /.content --> 
</div><!-- ./wrapper -->


<?php $this->load->view('layouts/_footer') ?>

 <script>


  initSample();
  initSample2();
 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 
  }) 
 
</script>
