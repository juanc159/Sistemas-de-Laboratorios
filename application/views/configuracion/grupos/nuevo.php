<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
$dia=date('d');
$mes_nro=date('m');
$ano=date('y');
$mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC']; 
$fecha_actual=$dia.$mes[$mes_nro[1]-1].$ano; 
$fecha_actual2=date('d/m/y');
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
                <h3 class="box-title">Registrar Acta de Peritacion</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>quimica/peritacion">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <form  action="nuevoPeritacion" method="post">
        <div class="box-body">
          
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>NUMERO DE REGISTRO:</label>  <?php echo $nro_acta ?>
                <input  type="hidden" name="nro_acta" id="nro_acta" value="<?php echo $nro_acta ?>" >
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA REALIZACION:</label> 
                <?php echo $fecha_actual;  ?>   
                <input type="hidden" name="fecha_acta" id="fecha_acta" value="<?php echo $fecha_actual2;  ?> ">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>UNIDAD SOLICITANTE</label> 
                 <?php echo form_error('id_unidad_solicitante'); ?>  
                <select class="form-control select2" name="id_unidad_solicitante" class="form-control m-b"> 
                  <option value="0">-- SELECCIONE UNIDAD SOLICITANTE --</option>
                  <?php 
                    foreach($datos2 as $unidad_solicitante)
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
          </div>


          <div class="row"> 
            <div class="col-md-4">
              <div class="form-group">
                <label>NUMERO DE OFICIO:</label> 
                <?php echo form_error('nro_oficio'); ?> 
                <input class="form-control" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo set_value("nro_oficio")?>" >
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA OFICIO:</label>
                <?php echo form_error('fecha_oficio'); ?>  
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio"  value="<?php echo set_value("fecha_oficio")?>">
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <label>NRO DE CAUSA:</label> 
                <?php echo form_error('num_causa'); ?> 
                <input class="form-control" type="text" name="num_causa" id="num_causa" value="<?php echo set_value("num_causa")?>">
              </div>
            </div> 
          </div>
 

          <div class="row"> 
            <div class="col-md-4">
              <div class="form-group">
                <label>NOMBRE Y APELLIDOS DEL O LOS IMPUTADOS:</label> 
                <?php echo form_error('nombre_imputado'); ?> 
                <input class="form-control" type="text" name="nombre_imputado" id="nombre_imputado" value="<?php echo set_value("nombre_imputado")?>" onkeypress="return Sololetras(event)">
              </div>
            </div>  

            <div class="col-md-4">
              <div class="form-group">
                <label>N° CI DEL IMPUTADO:</label> 
                <?php echo form_error('cedula_imputado'); ?> 
                <input class="form-control" type="text" name="cedula_imputado" id="cedula_imputado" value="<?php echo set_value("cedula_imputado")?>" onkeypress="return SoloNumeros(event)" maxlength="8">
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <label>NRO DE EXPEDIENTE:</label> 
                <?php echo form_error('num_expediente'); ?> 
                <input class="form-control" type="text" name="num_expediente" id="num_expediente" value="<?php echo set_value("num_expediente")?>">
              </div>
            </div>  

          </div>

          <div class="row">  
            <div class="col-md-12">
              <div class="form-group">
                <label>DESCRIPCION DE LA EVIDENCIA:</label> 
                <?php echo form_error('editor'); ?> 
                <textarea   id="editor" name="editor" ><?php echo set_value("editor")?></textarea>
              </div>
            </div>    
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>OBSERVACIONES:</label> 
                <?php echo form_error('editor2'); ?> 
                <textarea   id="editor2" name="editor2" ><?php echo set_value("editor2")?></textarea>
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
            <div class="col-md-6">
              <div class="form-group">
                <label>APELLIDOS Y NOMBRES:</label> 
                <?php echo form_error('jefe_nombre'); ?> 
                <input class="form-control" type="text" name="jefe_nombre" id="jefe_nombre" value="<?php echo set_value("jefe_nombre")?>">
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label>CEDULA DE IDENTIDAD:</label> 
                <?php echo form_error('jefe_cedula'); ?> 
                <input  class="form-control" type="text" name="jefe_cedula" id="jefe_cedula" value="<?php echo set_value("jefe_cedula")?>"   onkeypress="return SoloNumeros(event)" maxlength="8" > 
              </div>
            </div>   
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>quimica/peritacion">CANCELAR / REGRESAR</a>
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