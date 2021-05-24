<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
$dia=date('d');
$mes_nro=date('m');
$ano=date('y');
$mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];   
$fecha_actual=$dia.$mes[$mes_nro[1]-1].$ano; 
$fecha_actual2=date('d/m/y');

$fecha_ano=$this->uri->segment(3);
?>
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>DEPARTAMENTO DE QUIMICA <small>DEMO</small></h1>
  </section>

   <!-- Main content -->
   <section class="content">
    <!-- Your Page Content Here --> 
    <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">Registrar Acta Descarte</h3>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">  
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/descarte/'.$fecha_ano ?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
                
        </div>
      </div><!-- /.box-header -->

      <form  action="" method="post">
        <div class="box-body">
          
          <div class="row"> 

            <div class="col-md-3">
              <div class="form-group">
                <label>FECHA REALIZACION:</label> 
                <?php echo $fecha_actual;  ?>   
                <input type="hidden" name="fecha_acta" id="fecha_acta" value="<?php echo $fecha_actual2;  ?> ">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>INSTITUCION SOLICITANTE</label> 
                 <?php echo form_error('id_institucion_solicitante'); ?>  
                <select class="form-control select2" name="id_institucion_solicitante" class="form-control m-b"> 
                  <option value="0">-- SELECCIONE INSTITUCION SOLICITANTE --</option>
                  <?php 
                    foreach($instituciones as $institucion_solicitante)
                    {
                  ?> 
                  <option value="<?php echo $institucion_solicitante->id_institucion_solicitante;  ?>"  >
                    <?php echo $institucion_solicitante->des_institucion_solicitante;  ?>
                  </option>
                  <?php
                    }
                  ?> 
                </select>  
              </div>
            </div>   

            <div class="col-md-3">
              <div class="form-group">
                <label>UNIDAD ACTUANTE</label> 
                 <?php echo form_error('id_unidad_solicitante'); ?>  
                <select class="form-control select2" name="id_unidad_solicitante" class="form-control m-b"> 
                  <option value="0">-- SELECCIONE UNIDAD ACTUANTE --</option>
                  <?php 
                    foreach($unidades_act as $unidad_solicitante)
                    {
                  ?> 
                  <option value="<?php echo $unidad_solicitante->id_unidad_solicitante;  ?>"  >
                    <?php echo $unidad_solicitante->des_unidad_solicitantente;  ?>
                  </option>
                  <?php
                    }
                  ?> 
                </select>  
              </div>
            </div> 
            <div class="col-md-3"> 
              <div class="form-group"> 
                <label>DEPENDENCIA:</label>
                <?php echo form_error('dependencia_unidad'); ?>  
                <input type="text" name="dependencia_unidad" id="dependencia_unidad" class="form-control m-b" value="<?php echo set_value("dependencia_unidad")?>">
              </div>
            </div>
          </div>


          <div class="row"> 
            <div class="col-md-3">
              <div class="form-group">
                <label>NUMERO DE OFICIO:</label> 
                <?php echo form_error('nro_oficio'); ?> 
                <input class="form-control" type="text" name="nro_oficio" id="nro_oficio" value="<?php echo set_value("nro_oficio")?>" >
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>FECHA OFICIO:</label>
                <?php echo form_error('fecha_oficio'); ?>  
                <input class="form-control" type="date" name="fecha_oficio" id="fecha_oficio"  value="<?php echo set_value("fecha_oficio")?>">
              </div>
            </div>   

            <div class="col-md-3">
              <div class="form-group">
                <label>EMPRESA / FUNCIONARIO / C.I:</label> 
                <?php echo form_error('empresa'); ?> 
                <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo set_value("empresa")?>">
              </div>
            </div>    


            <div class="col-md-3">
              <div class="form-group">
                <label>EXPORTADOR / ALMACEN / DESTINO:</label> 
                <?php echo form_error('exportador'); ?> 
                <input class="form-control" type="text" name="exportador" id="exportador" value="<?php echo set_value("exportador")?>" onkeypress="return Sololetras(event)">
              </div>
            </div>   
          </div>
             
  

          <div class="row">  
            <div class="col-md-12">
              <div class="form-group">
                <label>DESCRIPCION DE LA EVIDENCIA:</label> 
                <?php echo form_error('editor'); ?> 
                <textarea   id="editor" name="editor" ><?php echo set_value("editor")?>
                  
          <?php 
                  if ($this->formato==1):  
                  ?> 

                  <p style="text-align:justify"><span >Una (01) bolsa elaborada en material sint&eacute;tico transparente, sellada con precinto color ________, signado con el n&uacute;mero _________, dentro del cual se encontr&oacute;  ___________________________</span></p>

                  <hr /> 

                  <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
                    <tbody>
                      <tr>
                        <td colspan="4" style="text-align:center"><strong>ENSAYO DE COLORACI&Oacute;N</strong></td>
                      </tr>
                      <tr>
                        <td rowspan="2" style="text-align:center"><strong>N&deg; EVIDENCIA</strong></td>
                        <td rowspan="2" style="text-align:center"><strong>CARACTER&Iacute;STICAS</strong></td>
                        <td colspan="2" style="text-align:center"><strong>ENSAYOS DE ORIENTACI&Oacute;N</strong></td>
                      </tr>
                      <tr>
                        <td style="text-align:center"><strong>SCOTT PARA COCA&Iacute;NA</strong></td>
                        <td style="text-align:center"><strong>MARQUIS PARA HERO&Iacute;NA</strong></td>
                      </tr>
                      <tr>
                        <td style="text-align:center">01</td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                      </tr>
                    </tbody>
                  </table>

                  <p>&nbsp;</p>

                  <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
                    <tbody>
                      <tr>
                        <td colspan="3" style="text-align:center"><strong>ENSAYO CONFIRMATORIO</strong></td>
                      </tr>
                      <tr>
                        <td style="text-align:center"><strong>T&Eacute;CNICA INSTRUMENTAL</strong></td>
                        <td style="text-align:center"><strong>RESULTADOS (&plusmn; 2nm)</strong></td>
                        <td style="text-align:center"><strong>INTERPRETACI&Oacute;N DE LOS RESULTADOS</strong></td>
                      </tr>
                      <tr>
                        <td style="text-align:center">ESPECTROFOTOMETR&Iacute;A ULTRAVIOLETA (ESPECTROFOT&Oacute;METRO DE UV-VISIBLE MARCA GENESIS 10 UV)</td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                      </tr>
                    </tbody>
                  </table>


                  <hr />
                  <p style="text-align:justify"><strong>OBSERVACIONES:&nbsp;</strong></p>
 
                  <hr />
                  <p><strong>RECOMENDACI&Oacute;N:&nbsp; </strong> </p>



                  <?php endif ?>

                </textarea>
              </div>
            </div>    
          </div>
            

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>DATOS DEL FUNCIONARIO FIRMANTE:</label> 
              </div>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>APELLIDOS Y NOMBRES:</label> 
                <?php echo form_error('jefe_nombre'); ?> 
                <input class="form-control" type="text" name="jefe_nombre" id="jefe_nombre" value="<?php echo set_value("jefe_nombre")?>">
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label>CEDULA DE IDENTIDAD:</label> 
                <?php echo form_error('jefe_cedula'); ?> 
                <input  class="form-control" type="text" name="jefe_cedula" id="jefe_cedula" value="<?php echo set_value("jefe_cedula")?>"   onkeypress="return SoloNumeros(event)" maxlength="8" > 
              </div>
            </div>   
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <a class="btn btn-block btn-danger" href="<?php echo base_url().'quimica/descarte/'.$fecha_ano ?>">CANCELAR / REGRESAR</a> 
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group"> 
                <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
              </div>
            </div>   
          </div>





        </div><!-- /.box-body -->
      </form>
    </div><!-- /.box -->

 
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