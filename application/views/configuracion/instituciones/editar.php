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
                <h3 class="box-title">Modificar Institucion</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/instituciones">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <?php
      $id=$this->uri->segment(3);
      $query = $this->db->query('SELECT * FROM div_inf_for.institucion_solicitante where id_institucion_solicitante='.$id); 
      $datos=$query->result(); 
        foreach($datos as $dato)
        {
      ?>
      <form  action="" method="post">
        <div class="box-body">
           
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>NOMBRE:</label> 
                <?php echo form_error('des_institucion_solicitante'); ?> 
                <input class="form-control" type="text" name="des_institucion_solicitante" id="des_institucion_solicitante" value="<?php echo $dato->des_institucion_solicitante ?>">
              </div>
            </div> 
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/instituciones">CANCELAR / REGRESAR</a>
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
      <?php
       }
      ?>
    </div><!-- /.box -->

 
  </section><!-- /.content --> 
</div><!-- ./wrapper -->

<?php $this->load->view('layouts/_footer') ?>
 