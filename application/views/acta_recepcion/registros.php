<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Actas de Recepci&oacute;n <small>DEMO</small> </h1>
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

      <div class="box-header with-border"> 
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"> 
              <h3 class="box-title">Actas de Recepci&oacute;n Registradas</h3>
            </div>
          </div>  
          <div class="col-md-3">
            <div class="form-group"> 
              <?php
              $fecha_ano=$this->uri->segment(3);
              if ($fecha_ano!='2019' and  $fecha_ano!='2020') { 
              ?>
              <a class="btn btn-block btn-primary" href="<?php echo base_url().'acta_recepcion/nuevo/'.$fecha_ano ?>" >Agregar Registro </a>
              <?php 
              } 
              ?>
            </div>
          </div>  
          <div class="col-md-3">
            <div class="form-group"> 
              <a class="btn btn-block btn-danger" href="<?php echo base_url()?>acta_recepcion">CANCELAR / REGRESAR</a> 
            </div>
          </div>  

          <!--
          <div class="col-md-1">
            <div class="form-group"> 
              <a class="btn  btn-primary" data-toggle="control-sidebar"><i class="fa fa-question-circle" ></i></a>
            </div>
          </div>   
          -->
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
                  <th>Fecha de Registro</th>
                  <th>Institucion Solicitante</th>
                  <th>Unidad Actuante</th>
                  <th>Nro Oficio</th>
                  <th>Fecha Oficio</th>
                  <th>Tipo Experticia</th>    
                  <th>Evidencia</th>  
                  <th>ACCIONES</th>        
                </tr>
              </thead>
              <tbody>  
                <?php 
                    $user = $this->ion_auth->user()->row(); 
                    $id=null;
                    foreach($datos as $dato)
                    {
                      $id=$dato->id;
                    }  
 
                  foreach($datos as $dato)
                  {
                ?>
                <tr>
                  <td><?php echo $dato->nro_acta;?></td>
                  <td><?php echo $dato->tipo_acta?></td>
                  <td><?php echo $dato->fecha_acta?></td>
                  <td><?php echo $dato->des_institucion_solicitante?></td>
                  <td><?php echo $dato->des_unidad_solicitantente?></td>
                  <td><?php echo $dato->nro_oficio?></td>
                  <td><?php echo $dato->fecha_oficio?></td>
                  <td><?php echo $dato->des_experticia?></td>
                  <td><?php echo $dato->informacion_acta?></td>
                  <td>
                    <?php
                    $nro_acta=$dato->nro_acta;
                    $tipo_acta=$dato->tipo_acta;
                    $archivo_pdf=NULL;
                    $where = array(
                            'id_remision_q' => $nro_acta,
                            'tipo_acta' => $tipo_acta,
                            'remision_ano' => $fecha_ano );
                    $query=$this->acta_recepcion_model->buscar('quimica.remision_dictamen',$where,false);
                    if ($query) {
                      $archivo_pdf=$query->archivo_pdf;
                    }
                    
                    

                    if ($archivo_pdf!=NULL) { 
                      $documento=base_url().'uploads/archivos_secretaria/'.$archivo_pdf;
                      ?>
                      <a target="va" class="btn btn-app"  href="<?php echo  $documento ?>"><i class="fa fa-file-pdf-o"></i> VER DOCUMENTO</a>
                      <?php
                    }else{ 
                      $group = array(2);
                       if (($user->id==$dato->id or $this->ion_auth->is_admin()) or $this->ion_auth->in_group($group)  )
                       { 
                        ?>
                        <a class="btn btn-app" href="<?php echo base_url().'acta_recepcion/editar/'.$dato->nro_acta.'/'.$dato->tipo_acta.'/'.$dato->fecha_acta ?>"> <i class="fa fa-edit"></i>EDITAR</a>
                        <?php
                  }
                ?>

                  <?php
                        if ($this->ion_auth->is_admin())
                        { 
                        ?>
                        <a class="btn btn-app" href="<?php echo base_url().'acta_recepcion/eliminar/'.$dato->nro_acta.'/'.$dato->tipo_acta.'/'.$dato->fecha_acta ?>"> <i class="fa fa-eraser"></i>ELIMINAR</a>
                         
                  <?php
                        }
                        ?>
                        <a target="v"   class="btn btn-app"  href="<?php echo base_url().'acta_recepcion/pdf/'.$dato->nro_acta.'/'.$dato->tipo_acta.'/'.$dato->fecha_acta ?>"><i class="fa fa-file-pdf-o"></i> VER PDF</a>
                        <?php
                  }
                ?>
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

    <!-- Your Page Content Here -->
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
            <div class="form-group"> 
              <h3 class="box-title">Actas de Devolución Registradas</h3>
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
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>  
                <?php 
                    $user = $this->ion_auth->user()->row(); 
                    $id=null;
                    foreach($datos as $dato)
                    {
                      $id=$dato->id;
                    }  
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

                      $group = array(2);
                       if (($user->id==$dato->id or $this->ion_auth->is_admin()) or $this->ion_auth->in_group($group)  )                { 
                        ?> 
                        <a class="btn btn-app" href="<?php echo base_url().'acta_recepcion/editar/'.$dato2->nro_acta.'/'.$dato2->tipo_acta.'/'.$dato2->fecha_acta ?>"> <i class="fa fa-edit"></i>EDITAR</a>
                        <?php
                  }
                ?>

                  <?php
                        if ($this->ion_auth->is_admin())
                        {  
                        ?>
                        <a class="btn btn-app" href="<?php echo base_url().'acta_recepcion/eliminar/'.$dato2->nro_acta.'/'.$dato2->tipo_acta.'/'.$dato2->fecha_acta ?>"> <i class="fa fa-eraser"></i>ELIMINAR</a>
                         
                  <?php
                        }
                        ?>
                        <a target="v"   class="btn btn-app"  href="<?php echo base_url().'acta_recepcion/pdf/'.$dato2->nro_acta.'/'.$dato2->tipo_acta.'/'.$dato2->fecha_acta ?>"><i class="fa fa-file-pdf-o"></i> VER PDF</a>
                        <?php
                  }
                ?>
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
  });


  $(function () {
    $("#example2").DataTable(); 
  });
</script>