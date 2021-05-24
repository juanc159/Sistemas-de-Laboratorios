<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>SECRETARIA<small>DEMO</small></h1>
  </section>

   <!-- Main content -->
   <section class="content">

     <?php

     $tipo_pagina=$this->uri->segment(4);
     $fecha_ano=$this->uri->segment(5);
     $fecha_link=substr($fecha_ano, 0,4);

 


     $documento=base_url().'acta_recepcion/pdf/'.$nro_acta.'/'.$tipo_a.'/'.$fecha_ano; 
     if ($datos) {
      foreach($datos as $dato)
      { 

        $archivo_pdf=$dato->archivo_pdf_rd; 
        

        if ($archivo_pdf!=null) {
          $documento=base_url().'uploads/archivos_actaRD/'.$archivo_pdf;
        }
        
        $readonly="readonly";

      }
     } 
      ?>

     <!-- Your Page Content Here -->
    <form  method="post" accept-charset="utf-8" id="miformulario" name="form" enctype="multipart/form-data"> 

      <div class="box">
        <div class="box-header"> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <h3 class="box-title">IDENTIFICACION DEL OFICIO</h3>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group"> 
                <?php 
 
                  if ( $this->session->flashdata('ControllerMessage') != '' ) 
                  {
                    echo $this->session->flashdata('ControllerMessage');   
                  } 
                ?> 
              </div>
          </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                <a target="v2"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo $documento ?>"> Vista Previa</a>
              </div>
          </div> 
        </div>
      </div><!-- /.box-header -->

      <div class="box-body"> 

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> SUBIR ARCHIVO PDF:</label> 
              <input type="hidden" name="nada">
              <input class="form-control" type="file" name="archivo" id="archivo" >
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision_recep_devol/'.$fecha_link?>">CANCELAR / REGRESAR</a>  
              </div>
            </div> 
         
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR PDF" > 
              </div>
            </div> 
          </div>
      </div>

 
 <?php
   ?>

    </form>

  </section><!-- /.content --> 
</div><!-- ./wrapper -->

<?php $this->load->view('layouts/_footer') ?>
  