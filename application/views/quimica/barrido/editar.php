<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
$dia=date('d');
$mes_nro=date('m');
$ano=date('y');
$mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];    
$fecha_actual=$dia.$mes[$mes_nro[1]-1].$ano; 
$fecha_actual2=date('d/m/y');



$fecha_ano=$this->uri->segment(4);
$fecha_ano_R=substr($fecha_ano, 0,4);
?>
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>DEPARTAMENTO DE QUÍMICA <small>DEMO</small></h1>
  </section>

   <!-- Main content -->
   <section class="content">
    <!-- Your Page Content Here --> 
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-3">
              <div class="form-group"> 
                <h3 class="box-title">Editar Acta de Barrido</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                 <?php 
                    if ( $this->session->flashdata('ControllerMessage') != '' ) 
                    {
                      echo $this->session->flashdata('ControllerMessage');   
                    } 
                  ?> 
              </div>
          </div> 
          <div class="col-md-3">
              <div class="form-group">  
                <a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url().'quimica/pdfBarrido/'.$nro_acta.'/'.$fecha_ano ?>"> Vista Previa</a>
              </div>
          </div> 
            <div class="col-md-3">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/barrido/'.$fecha_ano_R?>">CANCELAR / REGRESAR</a>
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <?php
        foreach($datos as $dato)
        {
      ?>
      <form  action="" method="post">
        <div class="box-body">
          
          <div class="row"> 

            <div class="col-md-3">
              <div class="form-group">
                <label>2DO EXPERTO</label> 
                <?php
                  $id_usuario=$dato->experto;
                  if ($id_usuario!=0)
                  {
                    $usuario = $this->ion_auth->user($id_usuario)->row();
                    $experto = $usuario->last_name.' '.$usuario->first_name;
                    $experto_valor = $usuario->id;
                  }
                  else{
                    $experto = "-- NINGUNO --";
                    $experto_valor = 0;
                  }
                  
                ?>
                 <?php echo form_error('experto'); ?>  
                <select class="form-control select2" name="experto" id="experto" class="form-control m-b"> 
                  <option value="<?php echo $experto_valor ?>"><?php echo $experto;  ?></option>
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
 


            <div class="col-md-3">
              <div class="form-group">
                <?php  
                  $campo_idSolicitante=$dato->id_institucion_solicitante;
                  $datos3=$this->acta_recepcion_model->buscar_institucion_solicitante($campo_idSolicitante);
                  foreach($datos3 as $dato3)
                  {
                    $des_institucion_solicitante=$dato3->des_institucion_solicitante;
                  }
                ?> 
                <label>INSTITUCION SOLICITANTE</label>  
                <?php echo form_error('id_institucion_solicitante'); ?>  
                <select name="id_institucion_solicitante" id="id_institucion_solicitante" class="form-control select2 m-b"> 
                  <option value="<?php echo $campo_idSolicitante ?>"><?php echo $des_institucion_solicitante ?></option>
                  <?php 
                    foreach($instituciones as $institucion)
                    {
                  ?> 
                  <option value="<?php echo $institucion->id_institucion_solicitante;  ?>"  ><?php echo $institucion->des_institucion_solicitante;  ?></option>
                  <?php
                    }
                  ?> 
                </select>  
                 
              </div> 
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <?php  
                  $campo_idSolicitante=$dato->id_unidad_solicitante;
                  $datos3=$this->acta_recepcion_model->buscar_unidad_solicitante($campo_idSolicitante);
                  foreach($datos3 as $dato3)
                  {
                    $des_unidad_solicitantente=$dato3->des_unidad_solicitantente;
                  }
                ?> 
                <label>UNIDAD ACTUANTE</label>  
                <?php echo form_error('id_unidad_solicitante'); ?>  
                <select name="id_unidad_solicitante" id="id_unidad_solicitante" class="form-control select2 m-b"> 
                  <option value="<?php echo $campo_idSolicitante ?>"><?php echo $des_unidad_solicitantente ?></option>
                  <?php 
                    foreach($unidades_act as $unidad_solicitante)
                    {
                  ?> 
                  <option value="<?php echo $unidad_solicitante->id_unidad_solicitante;  ?>"  ><?php echo $unidad_solicitante->des_unidad_solicitantente;  ?></option>
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
                <input type="text" name="dependencia_unidad" id="dependencia_unidad" class="form-control m-b" value="<?php echo $dato->dependencia_unidad; ?>">
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
                  <option value="<?php echo $dato->quien_autoriza ?>"><?php echo $dato->quien_autoriza ?></option>
                  <option value="<?php echo $jefe1; ?>"><?php echo $jefe1; ?></option>
                  <option value="<?php echo $jefe2; ?>"><?php echo $jefe2; ?></option>
                </select>
              </div>
            </div> 

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>SOLICITANTE:</label>
                <?php echo form_error('solicitante'); ?>  
                <input type="text" name="solicitante" id="solicitante" class="form-control m-b" value="<?php echo $dato->solicitante ?>">
              </div>
            </div>  

            <div class="col-md-3">
              <div class="form-group">
                <label>NUMERO DE OFICIO:</label> 
                <?php echo form_error('nro_oficio'); ?> 
                <input class="form-control" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo $dato->nro_oficio ?>">
              </div>
            </div>

            

            <div class="col-md-3">
              <div class="form-group">
                <label>FECHA OFICIO:</label> 
                <?php echo form_error('fecha_oficio'); ?> 
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio" value="<?php echo $dato->fecha_oficio ?>">
              </div>
            </div> 

            
          </div>
 

          <div class="row"> 

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA BARRIDO:</label> 
                <?php echo form_error('fecha_barrido'); ?> 
                <input class="form-control" type="date" name="fecha_barrido" id="fecha_barrido" value="<?php echo $dato->fecha_barrido ?>">
              </div>
            </div> 
            
            <div class="col-md-4">
              <div class="form-group">
                <label>LUGAR:</label> 
                <?php echo form_error('lugar'); ?> 
                <input class="form-control" type="text" name="lugar" id="lugar" value="<?php echo $dato->lugar; ?>" >
                 
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <label>UBICACIÓN:</label> 
                <?php echo form_error('ubicacion'); ?> 
                <input class="form-control" type="text" name="ubicacion" id="ubicacion" value="<?php echo $dato->ubicacion; ?>" >
                 
              </div>
            </div>             

          </div>

          <div class="row">  
            <div class="col-md-12">
              <div class="form-group">
                <label>DESCRIPCION DE LA EVIDENCIA:</label> 
                <?php echo form_error('editor'); ?>
                <textarea   id="editor" name="editor" ><?php echo $dato->evidencia ?></textarea>
              </div>
            </div>    
          </div>

           

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/barrido/'.$fecha_ano_R?>">CANCELAR / REGRESAR</a>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>   
          </div>
 
          </div>





        </div><!-- /.box-body -->
      </form>
      <?php
        }
      ?>
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