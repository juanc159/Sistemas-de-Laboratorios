<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php
$tipo_pagina=$this->uri->segment(3);
$fecha_a=$this->uri->segment(4); 
$title_pagina=null;
$link="secretaria";
$ver_info_acta=true;
if ($tipo_pagina=='RECEPCION')
{
  $title_pagina="Actas de Recepci&oacute;n Registradas";
}
if ($tipo_pagina=='PERITACION')
{
  $title_pagina="Actas de Peritaci&oacute;n Registradas";
}
if ($tipo_pagina=='DEVOLUCION')
{
  $title_pagina="Actas de Devolucion Registradas";
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    SECRETARIA
    <small>DEMO</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header"> 
      <div class="row">
        <div class="col-md-9">
          <div class="form-group"> 
            <h3 class="box-title"><?php echo $title_pagina ?></h3>
          </div>
        </div>  
        <div class="col-md-3">
          <div class="form-group"> 
            <?php
              $group = array(8);
              if ($this->ion_auth->in_group($group) and !$this->ion_auth->is_admin())
              { 
                $link="reportes";  
                $ver_info_acta=false;
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
          <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Numero</th>
                        <th>Tipo de Acta</th>   
                        <th>Fecha Registro</th>
                        <th>Institucion Solicitante</th>
                        <th>Unidad Actuante</th>
                        <th>Dependencia</th>
                        <th>Nro Oficio</th>
                        <th>Fecha Oficio</th> 
                        <th>Estatus</th>
                        <?php if ($ver_info_acta): ?>
                        <th>ACCION</th>  
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>  
                    <?php
                     $label="";
                      foreach($datos as $dato)
                      { 
                        $where = array(
                              'id_remision_q' => $dato->nro_acta,
                              'tipo_acta' => $tipo_pagina,
                              'remision_ano' => $fecha_a
                            );
                        $datos3=$this->acta_recepcion_model->buscar('quimica.remision_dictamen',$where);  
 
                          if(!$datos3){
                            $status_remi='EN ESPERA';
                            $label="label-danger";    
                          }
                          foreach($datos3 as $dato3)
                          {

                            $label="";
                            if ($dato3->status_remi==0)
                            {
                              $status_remi='EN ESPERA';   
                              $label="label-danger";                       
                            }
                            if ($dato3->status_remi==1)
                            {
                              $status_remi='AUTORIZADO';
                              $label="label-warning";
                            }
                            if ($dato3->status_remi==2)
                            {
                              $status_remi='POR RETIRAR'; 
                              $label="label-info";                         
                            }
                          
                            if ($dato3->status_remi==3)
                            {
                              $status_remi='3'; 
                              $label="label-primary"; 
                            }
                          
                          }
                          if ($status_remi!='3')
                            {  
                        
                    ?>
                      <tr>
                        <td><?php echo $dato->nro_acta?></td>
                        <td><?php echo $dato->tipo_acta?></td>
                        <td><?php echo $dato->fecha_acta?></td>
                        <td><?php echo $dato->des_institucion_solicitante?></td>
                        <td><?php echo $dato->des_unidad_solicitantente?></td>
                        <td><?php echo $dato->dependencia_unidad?></td>
                        <td><?php echo $dato->nro_oficio?></td>
                        <td><?php echo $dato->fecha_oficio?></td>
                        <td><span class = "label <?php echo $label; ?>"  style="font-size: 15px"> <?php echo $status_remi ?> </span> </td>
                        <?php if ($ver_info_acta): ?>
                        <td>
                          <a   class="btn btn-app"  href="<?php echo base_url().'secretaria/nuevoDictamen/'.$dato->nro_acta.'/'.$dato->tipo_acta.'/'.$fecha_a ?>"><i class="fa fa-link"></i> VER INFORMACIÓN</a>
                        </td>
                        <?php endif ?>
                      </tr> 
                    <?php
                      }
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