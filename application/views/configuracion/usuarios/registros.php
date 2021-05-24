<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CONFIGURACIONES
            <small>DEMO</small>
          </h1>
        </section>
 <?php 
 
        if ( $this->session->flashdata('ControllerMessage') != '' ) 
        {
          echo $this->session->flashdata('ControllerMessage');   
        } 
      ?> 
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
                <a class="btn btn-block btn-primary" href="<?php echo base_url() ?>quimica/nuevoPeritacion" class="fa fa-plus-circle">Agregar Registro </a>
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
                        <th>Numero</th>
                        <th>Fecha</th>
                        <th>Unidad Solicitante</th>
                        <th>Nro Oficio</th>
                        <th>Fecha Oficio</th> 
                        <th  ></th> 
                        
                        <th>&nbsp;</th> <th>&nbsp;</th> 
                      </tr>
                    </thead>
                    <tbody>  
                    <?php
                     $users = $this->ion_auth->users()->result(); // get all users
                      foreach($datos as $dato)
                      {
                    ?>
                      <tr>
                        <td><?php echo $dato->nro_acta?></td>
                        <td><?php echo $dato->fecha_acta?></td>
                        <td><?php echo $dato->des_unidad_solicitantente?></td>
                        <td><?php echo $dato->nro_oficio?></td>
                        <td><?php echo $dato->fecha_oficio?></td>
                        <td><a   class="fa fa-edit" href="<?php echo base_url() ?>quimica/editarPeritacion/<?php echo $dato->nro_acta ?>"> </a></td>
                        <td><a  class="fa fa-eraser" href="<?php echo base_url() ?>quimica/eliminarPeritacion/<?php echo $dato->nro_acta ?>"> </a></td>
                        <td><a target="v"  class="fa fa-file-pdf-o" href="<?php echo base_url() ?>quimica/pdfPeritacion/<?php echo $dato->nro_acta ?>"> </a></td>
                      </tr> 
                    <?php
                      }
                    ?>
                    </tbody>  
                  </table>
          </div>
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