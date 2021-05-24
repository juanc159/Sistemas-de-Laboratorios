<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Actas de Recepci&oacute;n <small>DEMO</small> </h1>
  </section>
 



<?php

foreach($datos as $dato)
{

}
$nro_acta=$this->uri->segment(3);
$tipo_acta=$this->uri->segment(4);
$fecha_acta=$this->uri->segment(5);
?>


  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-3">
            <div class="form-group"> 
              <h3 class="box-title">Actas de Recepci&oacute;n Registradas</h3>
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
                <a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url().'acta_recepcion/pdf/'.$nro_acta.'/'.$tipo_acta.'/'.$fecha_acta ?>"> Vista Previa</a>
              </div>
          </div> 
          <div class="col-md-3">
            <div class="form-group"> 
              <?php
              $fecha_ano=$this->uri->segment(5);
              $fecha_ano=substr($fecha_ano, 0,4);
              ?>
              <a class="btn btn-block btn-danger" href="<?php echo base_url().'acta_recepcion/registros/'.$fecha_ano?>">CANCELAR / REGRESAR</a>
            </div>
          </div>   
        </div>
      </div><!-- /.box-header -->

      
      <form action="" method="post" enctype="multipart/form-data">
        <div class="box-body"> 
          <div class="row">

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>TIPO DE ACTA: </label>
                 <?php  echo $dato->tipo_acta; ?> <hr>
                 <label>FECHA ACTA: </label>
                 <?php  echo $dato->fecha_acta; ?>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <?php  
                  $campo_idSolicitante=$dato->id_institucion_solicitante;
                  $datos3=$this->acta_recepcion_model->buscar_institucion_solicitante($campo_idSolicitante);
                  foreach($datos3 as $dato3)
                  {
                    $des_institucion_solicitante=$dato3->des_institucion_solicitante;
                  }
                ?> 
                <label>INSTITUCION SOLICITANTE</label>  
                <?php echo form_error('id_institucion_solicitante'); ?>  
                <select name="id_institucion_solicitante" id="id_institucion_solicitante" class="form-control select2 m-b"> 
                  <option value="<?php echo $campo_idSolicitante ?>"><?php echo $des_institucion_solicitante ?></option>
                  <?php 
                    foreach($instituciones as $institucion)
                    {
                  ?> 
                  <option value="<?php echo $institucion->id_institucion_solicitante;  ?>"  ><?php echo $institucion->des_institucion_solicitante;  ?></option>
                  <?php
                    }
                  ?> 
                </select>  
                 
              </div>
            </div> 


            <div class="col-md-3">
              <div class="form-group">
                <?php  
                  $campo_idSolicitante=$dato->id_unidad_solicitante;
                  $datos3=$this->acta_recepcion_model->buscar_unidad_solicitante($campo_idSolicitante);
                  foreach($datos3 as $dato3)
                  {
                    $des_unidad_solicitantente=$dato3->des_unidad_solicitantente;
                  }
                ?> 
                <label>UNIDAD ACTUANTE</label>  
                <?php echo form_error('id_unidad_solicitante'); ?>  
                <select name="id_unidad_solicitante" id="id_unidad_solicitante" class="form-control select2 m-b"> 
                  <option value="<?php echo $campo_idSolicitante ?>"><?php echo $des_unidad_solicitantente ?></option>
                  <?php 
                    foreach($unidades_act as $unidad_solicitante)
                    {
                  ?> 
                  <option value="<?php echo $unidad_solicitante->id_unidad_solicitante;  ?>"  ><?php echo $unidad_solicitante->des_unidad_solicitantente;  ?></option>
                  <?php
                    }
                  ?> 
                </select>  
                 
              </div>
            </div>   


            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>DEPENDENCIA:</label>
                <input type="text" name="dependencia_unidad" id="dependencia_unidad" class="form-control m-b" value="<?php echo $dato->dependencia_unidad  ?>">
              </div>
            </div>
 
          </div><!-- /.FIN ROW -->


          <div class="row">

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>NUMERO DE EXPEDIENTE:</label>
                <input type="text" name="nro_expediente" id="nro_expediente" class="form-control m-b" value="<?php echo $dato->nro_expediente  ?>">
              </div>
            </div>
 

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>NUMERO DE OFICIO:</label>
                <input type="text" name="nro_oficio" id="nro_oficio" class="form-control m-b" value="<?php echo $dato->nro_oficio  ?>">
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>FECHA OFICIO:</label>
                <input type="date" name="fecha_oficio" id="fecha_oficio" class="form-control m-b" value="<?php echo $dato->fecha_oficio  ?>">
              </div>
            </div>



            <div class="col-md-3">
              <div class="form-group">
                <?php  
                  $id_tipo_experticia=$dato->id_tipo_experticia;
                  $datos3=$this->acta_recepcion_model->buscar_tipo_experticias($id_tipo_experticia);
                  foreach($datos3 as $dato3)
                  {
                    $des_experticia=$dato3->des_experticia;
                  }
                ?> 
                <label>TIPO DE EXPERTICIAS</label>  
                <?php echo form_error('id_tipo_experticia'); ?>  
                <select name="id_tipo_experticia" id="id_tipo_experticia" class="form-control select2 m-b"> 
                  <option value="<?php echo $dato->id_tipo_experticia ?>"><?php echo $des_experticia ?></option>
                  <?php 
                    foreach($experticias as $experticia)
                    {
                  ?> 
                  <option value="<?php echo $experticia->id_tipo_experticia;  ?>"  ><?php echo $experticia->des_experticia;  ?></option>
                  <?php
                    }
                  ?> 
                </select>  
                 
              </div>
            </div>    

          </div><!-- /.FIN ROW -->
          <div class="row">  
            <div class="col-md-3">
              <div class="form-group">
                <label> SUBIR FOTO EVIDENCIA</label> 
                <input class="form-control" multiple='' type="file" name="foto_evidencia[]" id="foto_evidencia" >
              </div>
            </div>  
            <div class="col-md-9">
              <div class="form-group"> 

                <?php 
                  $nombre_carpeta='evidencia-'.$tipo_acta.'-'.$nro_acta.'-'.$fecha_acta;
                  $estructura = 'uploads/fotos_evidencias/'.$nombre_carpeta.'/';
                  
                  if(is_dir($estructura)){  
                    $dirint = dir($estructura);
                    while (($archivo = $dirint->read()) !== false)
                    {
                      if (preg_match( '/\.(?:jpe?g|png|gif)$/i', $archivo)) {
                        echo "<img width='150' height='150' src='".base_url().$estructura.$archivo."'  >"."\n";
                      }
                    } 
                    $dirint->close();
                  }
                    
                ?>


                
              </div>
            </div>
          </div>

          <div class="row"> 
            <div class="col-md-12"> 
              <div class="form-group"> 
                <label>EVIDENCIA:</label>
                <textarea   id="editor" name="editor" ><?php echo set_value("editor")?>
                    <?php echo $dato->informacion_acta  ?>

                  </textarea>
              </div>
            </div>

          </div><!-- /.FIN ROW -->


          <div class="row">

            <div class="col-md-12"> 
              <div class="form-group"> 
                <label>DATOS DEL JEFE DE LA COMISION:</label> 
              </div>
            </div> 
            </div><!-- /.FIN ROW -->
            
          <div class="row">
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>CEDULA:</label>
                <input type="text" name="cedula_jefe" id="cedula_jefe" class="form-control m-b" value="<?php echo $dato->cedula_jefe  ?>" >
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>APELLIDOS Y NOMBRES:</label>
                <input type="text" name="ape_nom_jefe" id="ape_nom_jefe" class="form-control m-b" value="<?php echo $dato->ape_nom_jefe;?>" >
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>CARGO:</label>
                <input type="text" name="cargo_jefe" id="cargo_jefe" class="form-control m-b" value="<?php echo $dato->cargo_jefe;?>" >
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>TELEFONO:</label>
                <?php echo form_error('telefono_jefe'); ?>  
                <input type="text" name="telefono_jefe" id="telefono_jefe" class="form-control m-b" value="<?php echo $dato->telefono_jefe;?>" onkeypress="return SoloNumeros(event)">
              </div>
            </div>

          </div><!-- /.FIN ROW -->



            <div class="row">
              <div class="col-md-6">
                <div class="form-group"> 
                  <a class="btn btn-block btn-danger" href="<?php echo base_url()?>acta_recepcion">CANCELAR / REGRESAR</a>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="form-group"> 
                  <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
                </div>
              </div>   
            </div><!-- /.FIN ROW -->


        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </form>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>

 <script>
  

  $("#btn0").click(function(){
    Swal.fire('Ejemplo basico de Sweet Alert 2');
}); 

  initSample();
  initSample2();
 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 
  }) 
 
</script>

<script >
  $(function () {
    $("#example1").DataTable(); 
  });
</script>