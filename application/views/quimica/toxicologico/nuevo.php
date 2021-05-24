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
                <h3 class="box-title">Registrar Acta de Toxicologia</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/toxicologico/'.$fecha_ano?>">CANCELAR / REGRESAR</a>
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <form  action="" method="post">
        <div class="box-body">
          
          <div class="row">
             

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA REALIZACION:</label> 
                <?php echo $fecha_actual;  ?>   
                <input type="hidden" name="fecha_acta" id="fecha_acta" value="<?php echo $fecha_actual2;  ?> ">
              </div>
            </div>

            <div class="col-md-4">
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




            <div class="col-md-4">
              <div class="form-group">
                <label>SOLICITANTE:</label> 
                <?php echo form_error('solicitante'); ?> 
                <input class="form-control" type="text" name="solicitante" id="solicitante" value="<?php echo set_value("solicitante")?>" >
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
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio" value="<?php echo set_value("fecha_oficio")?>">
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <label>CIUDADANO:</label> 
                <?php echo form_error('ciudadano'); ?> 
                <input class="form-control" type="text" name="ciudadano" id="ciudadano" value="<?php echo set_value("ciudadano")?>" onkeypress="return Sololetras(event)">
              </div>
            </div>  
          </div>
 

          <div class="row"> 
            

            <div class="col-md-4">
              <div class="form-group">
                <label>NACIONALIDAD:</label> 
                <?php echo form_error('nacio_ciu'); ?> 
                <select  class="form-control"   name="nacio_ciu" id="nacio_ciu" >
                  <option value="VENEZOLANO">VENEZOLANO</option>
                  <option value="EXTRANJERO">EXTRANJERO</option>
                </select>
                 
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <label>CEDULA DE IDENTIDAD:</label> 
                <?php echo form_error('cedula_ciu'); ?> 
                <input class="form-control" type="text" name="cedula_ciu" id="cedula_ciu" value="<?php echo set_value("cedula_ciu")?>" >
              </div>
            </div>   

            <div class="col-md-4">
              <div class="form-group">
                <label>DOMICILIO:</label> 
                <?php echo form_error('domicilio_ciu'); ?> 
                <input class="form-control" type="text" name="domicilio_ciu" id="domicilio_ciu" value="<?php echo set_value("domicilio_ciu")?>">
              </div>
            </div>  

            

          </div>

          <div class="row">  
             <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label> 
                <?php echo form_error('fecha_tox'); ?> 
                <input class="form-control" type="date" name="fecha_tox" id="fecha_tox" value="<?php echo set_value("fecha_tox")?>">
              </div>
            </div>  
            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <?php echo form_error('hora_tox'); ?> 
                <input class="form-control" type="time" name="hora_tox" id="hora_tox" value="<?php echo set_value("hora_tox")?>">
              </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                <label>TESTIGO:</label> 
                <?php echo form_error('testigo'); ?> 
                <input class="form-control" type="text" name="testigo" id="testigo" value="<?php echo set_value("testigo")?>">
              </div>
            </div>  
          </div>
 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>RESULTADOS:</label> 
              </div>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-12">
              <!-- checkbox -->
              <div class="form-group">
                <label>
                  <input type="checkbox" class="minimal" id="marihuana" name="marihuana" value="X">
                MARIHUANA </label> 
                <label>
                  <input type="checkbox" class="minimal" id="cocaina" name="cocaina"  value="X">
                COCAINA </label> 
                <label>
                  <input type="checkbox" class="minimal"  id="opiaceos" name="opiaceos"  value="X">
                OPIACEOS </label> 
              </div>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/toxicologico/'.$fecha_ano?>">CANCELAR / REGRESAR</a>
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

