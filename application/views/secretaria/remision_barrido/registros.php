<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SECRETARIA
            <small>DEMO</small>
          </h1>
        </section>
 <?php 
 $fecha_a=$this->uri->segment(3); 
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
                <h3 class="box-title">REMISIONES DE BARRIDOS</h3>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url() ?>secretaria" class="fa fa-plus-circle">Regresar </a>
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
                        <th>Estatus</th>
                        <th></th>  
                      </tr>
                    </thead>
                    <tbody>   
                    <?php

                      foreach($datos as $dato)
                      { 
                        $fecha_a=$this->uri->segment(3);
                        $where = array(
                                'id_remision_bar' => $dato->nro_acta, 
                                'remision_ano' => $fecha_a
                              );
                        $datos3=$this->acta_recepcion_model->buscar('quimica.remision_barrido',$where);
                        $label="";
                        if(!$datos3){
                          $status_remi='EN ESPERA';
                          $label="label-danger"; 
                        }

                        foreach($datos3 as $dato3)
                          { 
                            
                            if ($dato3->status_remi==0)
                            {
                              $status_remi='EN ESPERA';  
                              $label="label-danger";                          
                            }
                            if ($dato3->status_remi==1)
                            {
                              $status_remi='LISTO';
                              $label="label-success";
                            }
                          }

                    ?>
                      <tr>
                        <td><?php echo $dato->nro_acta?></td>
                        <td><?php echo $dato->fecha_barrido?></td>
                        <td><?php echo $dato->des_unidad_solicitantente?></td>
                        <td><?php echo $dato->nro_oficio?></td>
                        <td><?php echo $dato->fecha_oficio?></td> 
                        <td><span  class = "label <?php echo $label; ?>" style="font-size: 15px"> <?php echo $status_remi ?> </span> </td>
                        <td>
                          <a    class="btn btn-app"  href="<?php echo base_url().'secretaria/nuevoBarrido/'.$dato->nro_acta.'/'.$dato->fecha_barrido ?>"><i class="fa fa-link"></i> VER INFORMACION</a>
                          </td>
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