<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
$dia=date('d');
$mes_nro=date('m');
$ano=date('y');
$mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];   
//$fecha_actual=$dia.$mes[$mes_nro[1]-1].$ano; 
$fecha_actual2=date('d/m/y');
$fecha_ano=$this->uri->segment(5);
$fecha_ano_R=substr($fecha_ano, 0,4);
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
          <div class="col-md-3">
              <div class="form-group"> 
                <h3 class="box-title">Modificar Acta de Peritacion</h3>
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
                <a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url().'quimica/pdfPeritacion/'.$nro_acta.'/'.$fecha_ano ?>"> Vista Previa</a>
              </div>
          </div> 
          <div class="col-md-3">
            <div class="form-group">  
              <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/peritacion/'.$fecha_ano_R?>">CANCELAR / REGRESAR</a>
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
                <label>NUMERO DE REGISTRO:</label> <?php echo $nro_acta ?> <hr>
                <label>FECHA REALIZACION:</label> <?php echo $dato->fecha_acta;  ?>  
 
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
            <div class="col-md-4">
              <div class="form-group">
                <label>NUMERO DE OFICIO:</label>
                 <?php echo form_error('nro_oficio'); ?> 
                <input class="form-control" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo $dato->nro_oficio ?>" >
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA OFICIO:</label> 
                <?php echo form_error('fecha_oficio'); ?>
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio"  value="<?php echo $dato->fecha_oficio ?>" >
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <label>NRO DE CAUSA:</label>
                <?php echo form_error('num_causa'); ?>  
                <input class="form-control" type="text" name="num_causa" id="num_causa" value="<?php echo $dato->num_causa ?>">
              </div>
            </div> 
          </div>
 

          <div class="row"> 
            <div class="col-md-4">
              <div class="form-group">
                <label>NOMBRE Y APELLIDOS DEL O LOS IMPUTADOS:</label> 
                <?php echo form_error('nombre_imputado'); ?> 
                <input class="form-control" type="text" name="nombre_imputado" id="nombre_imputado" value="<?php echo $dato->nombre_imputado ?>"  >
              </div>
            </div>  

            <div class="col-md-4">
              <div class="form-group">
                <label>N° CI DEL IMPUTADO:</label> 
                <?php echo form_error('cedula_imputado'); ?> 
                <input class="form-control" type="text" name="cedula_imputado" id="cedula_imputado" value="<?php echo $dato->cedula_imputado ?>" >
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <label>NRO DE EXPEDIENTE:</label> 
                <?php echo form_error('num_expediente'); ?>
                <input class="form-control" type="text" name="num_expediente" id="num_expediente" value="<?php echo $dato->num_expediente ?>">
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
            <div class="col-md-12">
              <div class="form-group">
                <label>DATOS DEL JEFE DE LA COMISION:</label> 
              </div>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>CEDULA DE IDENTIDAD:</label> 
                <?php echo form_error('jefe_cedula'); ?>
                <input class="form-control" type="text" name="jefe_cedula" id="jefe_cedula" value="<?php echo $dato->jefe_cedula ?>" onkeypress="return SoloNumeros(event)" maxlength="8">
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label>APELLIDOS Y NOMBRES:</label> 
                <?php echo form_error('jefe_nombre'); ?>
                <input class="form-control" type="text" name="jefe_nombre" id="jefe_nombre" value="<?php echo $dato->jefe_nombre ?>" >
              </div>
            </div> 
            

             <div class="col-md-4"> 
              <div class="form-group"> 
                <label>TELEFONO:</label>
                <?php echo form_error('telefono_jefe'); ?>  
                <input type="text" name="telefono_jefe" id="telefono_jefe" class="form-control m-b" value="<?php echo $dato->telefono_jefe ?>" >
              </div>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/peritacion/'.$fecha_ano_R?>">CANCELAR / REGRESAR</a>
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