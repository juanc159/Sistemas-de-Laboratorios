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
     $fecha_a=$this->uri->segment(4);
     $fecha_ano_R=substr($fecha_a, 0,4);

     $readonly=NULL;
     

     $documento='quimica/pdfBarrido/'.$nro_acta.'/'.$fecha_a;

     if ($datos) {
      foreach($datos as $dato)
      {
        $id_remision_bar=$dato->id_remision_bar;
        $num_ofi_remision=$dato->num_ofi_remision;
        $fecha_remision=$dato->fecha_remision;
        $hora_remision=$dato->hora_remision;
        $obs_remision=$dato->obs_remision;
        $archivo_pdf=$dato->archivo_pdf;
        $status_remi=$dato->status_remi;

        $documento='uploads/archivos_barridos/'.$archivo_pdf;
        

        $readonly="readonly";

      }
     }
     else{
        $id_remision_bar="";
        $num_ofi_remision="";
        $fecha_remision="";
        $hora_remision="";
        $obs_remision="";
        $archivo_pdf="";
        $status_remi="";
     }

  


            

      ?>

     <!-- Your Page Content Here -->
    <form  method="post" accept-charset="utf-8" id="miformulario" name="form" enctype="multipart/form-data">  

      <div class="box">
        <div class="box-header"> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <h3 class="box-title">IDENTIFICACION DEL OFICIO DE LA REMISION DE LA EXPERTICIA</h3>
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
                <a target="v2"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url().$documento ?>"> Vista Previa</a>
              </div>
          </div> 
        </div>
      </div><!-- /.box-header -->

      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>NUMERO DE OFICIO DE LA REMISION:</label> 
              <input class="form-control" type="text" name="num_ofi_remision" id="num_ofi_remision"  value="<?php echo $num_ofi_remision ?>" <?php echo $readonly ?>>
            </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label>
                <input class="form-control" type="date" name="fecha_remision" id="fecha_remision"  value="<?php echo $fecha_remision ?>" <?php echo $readonly ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <input class="form-control" type="time" name="hora_remision" id="hora_remision"  value="<?php echo $hora_remision ?>" <?php echo $readonly ?>>
              </div>
            </div> 
        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label>OBSERVACIONES:</label> 
                <input class="form-control" type="text" name="observaciones" id="observaciones" value="<?php echo $obs_remision ?>" <?php echo $readonly ?>>
              </div>
            </div>  
        </div>

        <?php 
        if ($readonly==NULL)
        {
        ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> SUBIR ARCHIVO PDF:</label> 
              <input class="form-control" type="file" name="archivo" id="archivo" > 
            </div>
          </div>
        </div>
      <?php } ?>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision_barrido/'.$fecha_ano_R?>">CANCELAR / REGRESAR</a>

              </div>
            </div> 
            <?php 
            if ($readonly==NULL)
            {
            ?>
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>
            <?php } ?>   
          </div>
      </div>

 
 <?php
   ?>

    </form>

  </section><!-- /.content --> 
</div><!-- ./wrapper -->

<?php $this->load->view('layouts/_footer') ?>
  