<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php
$nro_acta=$this->uri->segment(3);
$tipo_pagina=$this->uri->segment(4);
$fecha_ano=$this->uri->segment(5);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>SECRETARIA<small><?php echo $tipo_pagina ?></small></h1>
  </section>

   <!-- Main content -->
   <section class="content">
 <?php
 // para editar
 if ($datos!=NULL) {
 

        foreach($datos as $dato)
        {
      ?>

    <!-- Your Page Content Here -->

<form  method="post" accept-charset="utf-8" id="miformulario" name="form" enctype="multipart/form-data">

    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-3">
              <div class="form-group"> 
                <h3 class="box-title">AUTORIZACÓN DE LA EJECUCIÓN DE LA EXPERTICIA</h3>
              </div>
            </div> 

            <div class="col-md-3">
               <?php 
 
                if ( $this->session->flashdata('ControllerMessage') != '' ) 
                {
                  echo $this->session->flashdata('ControllerMessage');   
                } 
              ?>
            </div>  
            <div class="col-md-2">
              <div class="form-group"> 
			  <?php
            if ($this->ion_auth->is_admin())
            { 
            ?>
                <a class="btn btn-block btn-warning" href="<?php echo base_url().'secretaria/eliminar_dictamen/'.$nro_acta.'/'.$tipo_pagina.'/'.$fecha_ano?>">ELIMINAR</a>  
				<?php
            }
            ?>
              </div>
            </div> 
            <?php

            if (!$dato->archivo_pdf) {
              $documento='quimica/pdfPeritacion/'.$nro_acta;
              $link="<a   class='btn btn-block btn-danger fa fa-file-pdf-o' href='#'>NO SE CARGO NINGÚN ARCHIVO</a>";
            }
            else{
              $documento='uploads/archivos_secretaria/'.$dato->archivo_pdf;
              $link="<a target='v'  class='btn btn-block btn-primary fa fa-file-pdf-o' href='".base_url().$documento."'> Vista Previa</a>";
            }

            ?>
            <div class="col-md-2">
              <div class="form-group"> 
                <?php echo $link ?>
              </div>
          </div> 
            <div class="col-md-2">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision/'.$tipo_pagina.'/'.$fecha_ano?>">CANCELAR / REGRESAR</a>  
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

<!-- /.llave para  que se ponga a editar o a registrar primera vez -->
<input  type="hidden" name="llave" id="llave" value="editar">
 
      <?php
      $status_remi1="";
      $status_remi2="";
      $status_remi3="";
      $readonly="";
      $readonly_identificado="";
      $required_identificar="";
      $required_entrega="";
      $readonly_entrega="";
      $status_remi=$dato->status_remi;
      $readonly_autorizacion="";

      if ($dato->status_remi=='1')
      {
        $status_remi1='checked';  
        $required_identificar="required";
      }
      if ($dato->status_remi=='2')
      {
        $status_remi2='checked';
      } 
      if ($dato->status_remi=='3')
      {
        $status_remi3='checked';
      }

      if ($dato->status_remi!=null)
      {
        $readonly_autorizacion="readonly";
      } 



      if ($dato->num_ofi_remision!=null and $dato->fecha_remision!=null  and $dato->hora_remision!=null  and $dato->representante_mp!=null )
      {
        $readonly_identificado="readonly";
        $required_entrega="required";
      } 

      if ($dato->fecha_entrega!=null and $dato->hora_entrega!=null  and $dato->nombre_entrega!=null  and $dato->cargo_entrega!=null and $dato->ced_entrega!=null and $dato->telf_entrega!=null and $dato->obs_remision!=null )
      {
        $readonly_entrega="readonly"; 
      } 
      ?>
        <div class="box-body">   
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>AUTORIZADO POR:</label> 
                <input class="form-control" type="text" name="quien_autoriza" id="quien_autoriza" value="<?php echo $dato->quien_autoriza ?>"  <?php echo $readonly_autorizacion ?>>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label>
                <input class="form-control" type="date" name="fecha_autorizacion" id="fecha_autorizacion" value="<?php echo $dato->fecha_autorizacion ?>"  <?php echo $readonly_autorizacion ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <input class="form-control" type="time" name="hora_autorizacion" id="hora_autorizacion" value="<?php echo $dato->hora_autorizacion ?>"  <?php echo $readonly_autorizacion ?>>
              </div>
            </div> 
          </div> 

          <?php
          if ($status_remi2!=null and $status_remi3!='')
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
          <?php
            }
          ?>
        </div> 
         
      
    </div><!-- /.box -->

    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">IDENTIFICACION DEL OFICIO DE LA REMISION DE LA EXPERTICIA</h3>
              </div>
            </div>                 
        </div>
      </div><!-- /.box-header -->
      
        <div class="box-body">
          <div class="row"> 
            <div class="col-md-12">
              <div class="form-group">
                <label>
                  <?php
                  if ($readonly_identificado==null)
                  {                   
                  ?>
                  <input type="radio" name="status_remi" id="status_remi" class="flat-red" <?php echo $status_remi2 ?> value="2" required> IDENTIFICADO
                  <?php 
                  }
                  ?>
                  
                </label>
              </div>
            </div>  
          </div>
          
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label>NUMERO DE OFICIO DE LA REMISION:</label> 
                <input class="form-control" type="text" name="num_ofi_remision" id="num_ofi_remision"  required value="<?php echo $dato->num_ofi_remision ?>"  <?php echo $readonly_identificado ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label>
                <input class="form-control" type="date" name="fecha_remision" id="fecha_remision"  required value="<?php echo $dato->fecha_remision ?>"  <?php echo $readonly_identificado ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <input class="form-control" type="time" name="hora_remision" id="hora_remision"  required value="<?php echo $dato->hora_remision ?>"  <?php echo $readonly_identificado ?>>
              </div>
            </div> 
          </div>

           <div class="row"> 
            <div class="col-md-6">
              <div class="form-group">
                <label>REPRESENTANTE DEL MINISTERIO PUBLICO:</label> 
                <input class="form-control" type="text" name="representante_mp" id="representante_mp"  required value="<?php echo $dato->representante_mp ?>"   <?php echo $readonly_identificado ?>>
              </div>
            </div>   
              <?php
                    if ($readonly_identificado==null)
                    {                   
                    ?>

            <div class="col-md-6">
              <div class="form-group">
                <label> SUBIR ARCHIVO PDF:</label> 
                <input class="form-control" type="file" name="archivo" id="archivo" >
              </div>
            </div> 
            <?php
            }                 
                  ?>


          </div>
  
 
        </div><!-- /.box-body -->
      
    </div><!-- /.box -->


<?php
          if ($readonly_identificado!=null)
          {       
          ?>
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">ENTREGA DE RESULTADO DE LA EXPERTICIA A LA UNIDAD SOLICITANTE</h3>
              </div>
            </div>                 
        </div>
      </div><!-- /.box-header -->

      
        <div class="box-body">
          <div class="row">  
            <div class="col-md-4">
              <div class="form-group">
                <label>
                  <input type="radio" name="status_remi" id="status_remi" class="flat-red" <?php echo $status_remi3 ?> value="3" required>
                  FIN PROCESO
                </label>
              </div>
            </div> 
          </div>
          
          <div class="row"> 

            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label>
                <input class="form-control" type="date" name="fecha_entrega" id="fecha_entrega" value="<?php echo $dato->fecha_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <input class="form-control" type="time" name="hora_entrega" id="hora_entrega" value="<?php echo $dato->hora_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>CEDULA:</label>
                <input class="form-control" type="text" name="ced_entrega" id="ced_entrega" value="<?php echo $dato->ced_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>
          </div>
 
          <div class="row"> 
            <div class="col-md-4">
              <div class="form-group">
                <label>APELLIDOS Y NOMBRES:</label> 
                <input class="form-control" type="text" name="nombre_entrega" id="nombre_entrega" value="<?php echo $dato->nombre_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>

            

            <div class="col-md-4">
              <div class="form-group">
                <label>CARGO:</label> 
                <input class="form-control" type="text" name="cargo_entrega" id="cargo_entrega" value="<?php echo $dato->cargo_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>TELEFONOS:</label> 
                <input class="form-control" type="text" name="telf_entrega" id="telf_entrega" value="<?php echo $dato->telf_entrega ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>
          </div>

          <div class="row"> 
            
            <div class="col-md-12">
              <div class="form-group">
                <label>OBSERVACIONES:</label> 
                <input class="form-control" type="text" name="obs_remision" id="obs_remision" value="<?php echo $dato->obs_remision ?>" <?php echo $required_entrega.' '.$readonly_entrega ?>>
              </div>
            </div>
          </div>
 
 
        </div><!-- /.box-body -->
      
    </div><!-- /.box -->
<?php
     }     }    
          ?>


<?php
          if ($readonly_entrega==null)
          {       
          ?>
       <div class="box-body"> 

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision/'.$tipo_pagina.'/'.$fecha_ano?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>   
          </div> 
        </div><!-- /.box-body -->

        <?php
          }      
          ?>
    </form>
    <?php


  
  }
  else{
      // nuevo registro
    ?>
     <!-- Your Page Content Here -->
<form  method="post" accept-charset="utf-8" id="miformulario2" name="form" enctype="multipart/form-data">
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">AUTORIZACION DE LA EJECUCION DE LA EXPERTICIA</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision/'.$tipo_pagina.'/'.$fecha_ano?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

<!-- /.llave para  que se ponga a editar o a registrar primera vez -->
<input  type="hidden" name="llave" id="llave" value="nuevo">
      
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>
                  <input type="radio" name="status_remi" id="status_remi" class="flat-red" value="1" required>
                  AUTORIZADO
                </label>
              </div>
            </div>
             
             
          </div> 
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>AUTORIZADO POR:</label> 
                <input class="form-control" type="text" name="quien_autoriza" id="quien_autoriza" value="CNEL. MARIN GONZALEZ" required>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label>FECHA:</label>
                <input class="form-control" type="date" name="fecha_autorizacion" id="fecha_autorizacion" required>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>HORA:</label> 
                <input class="form-control" type="time" name="hora_autorizacion" id="hora_autorizacion" required>
              </div>
            </div>
          </div>
          <div class="row">  
            <div class="col-md-6">
              <div class="form-group">
                <label> SUBIR ARCHIVO PDF2:</label> 
                <input class="form-control" type="file" name="archivo" id="archivo" >
              </div>
            </div>
          </div> 
        </div>
      
    </div><!-- /.box -->

      
        <div class="box-body">
          
          
          <div class="row"> 
            
             
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'secretaria/remision/'.$tipo_pagina.'/'.$fecha_ano?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>   
          </div>
 
        </div><!-- /.box-body -->
      
    </div><!-- /.box -->

    </form>
    <?php
  }
      ?>
  </section><!-- /.content --> 
</div><!-- ./wrapper -->

<?php $this->load->view('layouts/_footer') ?>

 <script>


  initSample();
  initSample2();
 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 
  }) 
 
</script>