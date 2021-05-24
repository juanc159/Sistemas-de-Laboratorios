<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Actas<small>DEMO</small> </h1>
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
    

    <!-- Your Page Content Here -->
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
            <div class="form-group"> 
              <h3 class="box-title">Actas de Devolución Registradas</h3>
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
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Numero</th>
                  <th>Tipo de Acta</th>   
                  <th>Fecha de Registro</th>
                  <th>Institucion Solicitante</th>
                  <th>Unidad Actuante</th>
                  <th>Nro Oficio</th>
                  <th>Fecha Oficio</th>
                  <th>Tipo Experticia</th>  
                  <th>
                  <?php
                         $user = $this->ion_auth->user()->row(); 
                         $id=null;
                      foreach($datos2 as $dato2)
                      {
                        $id=$dato2->id;
                      }
                        if ($user->id==$id or $this->ion_auth->is_admin())
                        { 
                        ?> 
                        ACCIONES 
                        <?php
                        }
                        ?>
                          
                        </th>
                </tr>
              </thead>
              <tbody>  
                <?php
                $i=1;
                  foreach($datos2 as $dato2)
                  {
                ?>
                <tr>
                  <td><?php echo $dato2->nro_acta;?></td>
                  <td><?php echo $dato2->tipo_acta?></td>
                  <td><?php echo $dato2->fecha_acta?></td>
                  <td><?php echo $dato2->des_institucion_solicitante?></td>
                  <td><?php echo $dato2->des_unidad_solicitantente?></td>
                  <td><?php echo $dato2->nro_oficio?></td>
                  <td><?php echo $dato2->fecha_oficio?></td>
                  <td><?php echo $dato2->des_experticia?></td>
                  <td>
                    <?php

                    $archivo_pdf_rd=$dato2->archivo_pdf_rd;
                    if ($archivo_pdf_rd) { 

                      $documento=base_url().'uploads/archivos_actaRD/'.$archivo_pdf_rd;
                      ?>
                      <a target="va" class="btn btn-app"  href="<?php echo  $documento ?>"><i class="fa fa-file-pdf-o"></i> VER DOCUMENTO</a>
                      <?php
                    }else{
                    ?> 
                     <a   class="btn btn-app"  href="<?php echo base_url().'secretaria/nuevoRemiRD/'.$dato2->nro_acta.'/'.$dato2->tipo_acta.'/'.$dato2->fecha_acta ?>"><i class="fa fa-link"></i> VER INFORMACIÓN</a>
                     <?php
                  }
                ?>
                        
                   </td>
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
  });


  $(function () {
    $("#example2").DataTable(); 
  });
</script>