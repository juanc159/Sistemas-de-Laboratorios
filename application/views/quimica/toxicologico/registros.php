<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DEPARTAMENTO DE QUIMICA
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
          <div class="col-md-6">
              <div class="form-group"> 
                <h3 class="box-title">ELABORACION DE ACTAS TOXICOLOGÍA</h3>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group"> 
                <?php
              $fecha_ano=$this->uri->segment(3);
              if ($fecha_ano!='2019') { 
              ?>
                <a class="btn btn-block btn-primary" href="<?php echo base_url().'quimica/nuevoToxicologico/'.$fecha_ano ?>" class="fa fa-plus-circle">Agregar Registro </a>
                <?php 
              } 
              ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url()?>quimica">CANCELAR / REGRESAR</a> 
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
                        <th>Fecha Registro</th> 
                        <th>Solicitante</th>
                        <th>Nro Oficio</th>
                        <th>Fecha Oficio</th>  
                        
                        <?php
                         $user = $this->ion_auth->user()->row(); 
                      $id=null;
                      foreach($datos as $dato)
                      {
                        $id=$dato->id;
                      }
                        if ($user->id==$id or $this->ion_auth->is_admin())
                        { 
                        ?> 
                        <th  >ACCIONES</th> 
                        <?php
                        }
                        ?>
                      </tr>
                    </thead>
                    <tbody>  
                    <?php 
                    $check_editar=0;
                      foreach($datos as $dato)
                      { 
                    ?>
                      <tr>
                        <td><?php echo $dato->nro_acta?></td>
                        <td><?php echo $dato->fecha_tox?></td>
                        <td><?php echo $dato->solicitante?></td> 
                        <td><?php echo $dato->nro_oficio?></td>
                        <td><?php echo $dato->fecha_oficio?></td>
                        <td>
                          <?php
                          $archivo_pdf=null;
                        $nro_acta=$dato->nro_acta;

 
                        $fecha_a=$this->uri->segment(3);
                        $where = array(
                              'id_remision_tox' => $nro_acta,
                              'remision_ano' => $fecha_a
                            );
                      $acta_remitida=$this->acta_recepcion_model->buscar('quimica.remision_toxicologico',$where,false);  
 
                        if ($acta_remitida!=null) {
                          $documento=base_url()."uploads/archivos_toxicologico/".$acta_remitida->archivo_pdf_remi_tox;
                          $check_editar=1;
                          $titulo_pdf="VER DOCUMENTO";
                        }
                        else{
                          $documento=base_url()."quimica/pdfToxicologico/".$dato->nro_acta.'/'.$dato->fecha_tox;
                          $check_editar=0;
                          $titulo_pdf="VER PDF";
                        }



                        if (($user->id==$dato->id or $this->ion_auth->is_admin()) and $check_editar!=1)
                        { 
                        ?> 
                        <a   class="btn btn-app" href="<?php echo base_url().'quimica/editarToxicologico/'.$dato->nro_acta.'/'.$dato->fecha_tox ?>"> <i class="fa fa-edit"></i>EDITAR</a>
                        <?php
                        }
                        ?> 
                         <?php
                        if ($this->ion_auth->is_admin()  and $check_editar!=1)
                        { 
                        ?> 
                        <a class="btn btn-app"   href="<?php echo base_url().'quimica/eliminarToxicologico/'.$dato->nro_acta.'/'.$dato->fecha_tox ?>"> <i class="fa fa-eraser"></i>ELIMINAR</a>
                        <?php
                        }
                        ?>   

                         <a target="v"   class="btn btn-app"  href="<?php echo $documento ?>"><i class="fa fa-file-pdf-o"></i> <?php echo $titulo_pdf; ?></a>
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