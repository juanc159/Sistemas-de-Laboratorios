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
                      
    <form  action="create_user" method="post">
        <div class="box-body">
          
          <div class="row">  
            <div class="col-md-4">
              <div class="form-group">
                <label>CEDULA</label>  
                <?php echo form_input($cedula);?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>APELLIDOS</label>  
                <?php echo form_input($last_name);?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>NOMBRES</label>  
                <?php echo form_input($first_name);?>
              </div>
            </div>
          </div>

          <div class="row">  
            <div class="col-md-4">
              <div class="form-group">
                <label>GRADO/ JERARQUIA</label>  
                <?php echo form_input($grado);?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>EMAIL</label>  
                <?php echo form_input($email);?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>TELEFONO</label>  
                <?php echo form_input($phone);?>
              </div>
            </div> 
          </div>

           <div class="row">  
            <div class="col-md-6">
              <div class="form-group">
                <label>CONTRASEÑA</label>  
                <?php echo form_input($password);?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>CONFIRMAR CONTRASEÑA</label>  
                <?php echo form_input($password_confirm);?>
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





        </div><!-- /.box-body -->
      </form>

 
            </div><!-- /.box -->

 
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>
 