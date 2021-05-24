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
              <div class="col-md-6">
                  <div class="form-group"> 
                    <h3 class="box-title">USUARIOS</h3>
                  </div>
                </div>  
                <div class="col-md-3">
                  <div class="form-group"> 
                    <a class="btn btn-block btn-primary" href="<?php echo base_url() ?>auth/create_group" class="fa fa-plus-circle">AGREGAR GRUPO</a>
                  </div>
                </div>  
                <div class="col-md-3">
                  <div class="form-group"> 
                    <a class="btn btn-block btn-danger" href="<?php echo base_url()?>configuracion">CANCELAR / REGRESAR</a> 
                  </div>
                </div>   
            </div>
          </div><!-- /.box-header -->

                <div class="box-body"> 
                <div class="row"> 
          <div class="col-md-12">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th> 
                <th>ACCIÓN</th>
              </tr>
              </thead>
              <tbody>
              <?php 
               $groups = $this->ion_auth->groups()->result();


              foreach ($groups as $group):?>
                 
                <tr>
                        <td><?php echo htmlspecialchars($group->id,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
                      
                  <td><?php echo anchor("auth/edit_group/".$group->id, 'Editar') ;?></td>
                </tr>
              
              <?php endforeach;?>
            </tbody> 
            </table>
          </div> 
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

 
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>
 <script >
      $(function () {
        $("#example1").DataTable(); 
      });
    </script>