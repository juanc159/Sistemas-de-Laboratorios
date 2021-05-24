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
                    <h3 class="box-title">GRUPOS</h3>
                  </div>
                </div>  
                <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/grupos">CANCELAR / REGRESAR</a> 

                </div>
              </div>   
            </div>
          </div><!-- /.box-header -->

                <div class="box-body">  
                      
    <?php echo form_open("auth/create_group");?>
        <div class="box-body">
          
          
           <div class="row">  
            <div class="col-md-6">
              <div class="form-group">
	                <?php echo lang('create_group_name_label', 'group_name');?> <br />
            		<?php echo form_input($group_name);?>
                <div id="infoMessage">Agregar un maximo de 20 caracteres en el nombre del grupo</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <?php echo lang('create_group_desc_label', 'description');?> <br />
            	<?php echo form_input($description);?>
              </div>
            </div> 
          </div>
  

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion/grupos">CANCELAR / REGRESAR</a>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR" > 
              </div>
            </div>   
          </div>





        </div><!-- /.box-body -->
     <?php echo form_close();?>

 
            </div><!-- /.box -->

 
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>
 