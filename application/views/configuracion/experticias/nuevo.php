<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>CONFIGURACIONES <small>DEMO</small></h1>
  </section>

   <!-- Main content -->
   <section class="content">
    <!-- Your Page Content Here --> 
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">Registrar Tpo de Experticia</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/experticias">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <form  action="nuevoTipoExperticia" method="post">
        <div class="box-body">
           
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>NOMBRE:</label> 
                <?php echo form_error('des_experticia'); ?> 
                <input class="form-control" type="text" name="des_experticia" id="des_experticia" value="<?php echo set_value("des_experticia")?>">
              </div>
            </div> 
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/experticias">CANCELAR / REGRESAR</a>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR" > 
              </div>
            </div>   
          </div>





        </div><!-- /.box-body -->
      </form>
    </div><!-- /.box -->

 
  </section><!-- /.content --> 
</div><!-- ./wrapper -->

<?php $this->load->view('layouts/_footer') ?>
 