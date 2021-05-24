<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

 

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CONFIGURACIONES DEL SISTEMA
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
    <section class="content">
          <!-- Your Page Content Here -->
      <div class="box">
            <div class="box-header"> 
            <div class="row">
              <div class="col-md-9">
                  <div class="form-group"> 
                    <h3 class="box-title">USUARIOS</h3>
                  </div>
                </div>  
                <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>auth">CANCELAR / REGRESAR</a> 
                </div>
              </div>   
            </div>
          </div><!-- /.box-header -->

                <div class="box-body">  
                      
    <?php echo form_open("auth/deactivate/".$user->id);?>
        <div class="box-body">
          
          <div class="row">  
            <div class="col-md-4">
              <div class="form-group">
              	<h1><?php echo lang('deactivate_heading');?></h1>
<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
<p>
  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

              </div>
            </div> 
          </div> 
  

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>auth">CANCELAR / REGRESAR</a>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR" > 
              </div>
            </div>   
          </div>


<?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(['id' => $user->id]); ?>


        </div><!-- /.box-body -->
     <?php echo form_close();?>

 
            </div><!-- /.box -->

 
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>
 