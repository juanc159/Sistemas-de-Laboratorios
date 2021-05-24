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
                <h3 class="box-title">DICTAMENES ENTREGADOS</h3>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group"> 
                <?php
                $link="secretaria";
                $group = array(8);
                if ($this->ion_auth->in_group($group))
                { 
                  $link="reportes";  
                }
                ?>
                <a class="btn btn-block btn-danger" href="<?php echo base_url().$link ?>" class="fa fa-plus-circle">Regresar </a>
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
                        <th>Tipo de Acta</th>   
                        <th>Numero de Oficio</th>
                        <th>Fecha Oficio</th>
                        <th>Numero de Oficio Remision</th>
                        <th>Fecha Remision</th>
                        <th>Hora Remision</th>
                        <th>Fecha Oficio</th> 
                        <th>ACCION</th>  
                      </tr>
                    </thead>
                    <tbody>  
                    <?php
                    $fecha=$this->uri->segment(3);
                      foreach($datos as $dato)
                      { 
                        
                        $variable=$dato->tipo_acta;
                        if ($variable=='RECEPCION')
                        {
                          $tabla='div_inf_for.acta_recepcion';
                        }
                        if ($variable=='PERITACION')
                        {
                          $tabla='quimica.acta_peritacion';
                        }

                        $where = "nro_acta='".$dato->id_remision_q."' and fecha_acta>='".$fecha."-01-01' and fecha_acta<='".$fecha."-12-31'";
                        $datos2=$this->acta_recepcion_model->buscar($tabla,$where,$tipo=true);
                        foreach($datos2 as $dato2)
                        {
                          $nro_oficio   = $dato2->nro_oficio;
                          $fecha_oficio = $dato2->fecha_oficio;
                        }
                          
                            
                        
                    ?>
                      <tr>
                        <td><?php echo $dato->id_remision_q?></td>
                        <td><?php echo $dato->tipo_acta?></td>
                        <td><?php echo $nro_oficio ?></td>
                        <td><?php echo $fecha_oficio?></td>
                        <td><?php echo $dato->num_ofi_remision?></td>
                        <td><?php echo $dato->fecha_remision?></td>
                        <td><?php echo $dato->hora_remision?></td>
                        <td><?php echo $dato->representante_mp?></td>
                        <td>
                          <a target="v"   class="btn btn-app"  href="<?php echo base_url() ?>uploads/archivos_secretaria/<?php echo $dato->archivo_pdf ?>"><i class="fa fa-file-pdf-o"></i> VER DICTAMEN</a>
						  <a  target="a" class="btn btn-app"  href="<?php echo base_url().'secretaria/nuevoDictamen/'.$dato->id_remision_q.'/'.$dato->tipo_acta.'/'.$dato->remision_ano ?>"><i class="fa fa-link"></i> VER INFORMACIÓN</a>
                        </td>
                        
                      </tr> 
                    <?php
                    }
                    ?>
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
        $("#example2").DataTable();
      });
    </script>