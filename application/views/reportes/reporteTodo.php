<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>REPORTES DE LAS DIVISIONES
            <small>DEMO</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
	    	<div class="box-header">
		    	<div class="row">
		        <div class="col-md-6">
		          <div class="form-group">
		            <h3 class="box-title">REPORTE</h3>
                <?php
                  $experticia = array();
                  $i=0;
                  foreach($datos_tipo_experticia as $datos_tipo_experticia)
                  {
                    $experticia[$i]=$datos_tipo_experticia->id_tipo_experticia;
                    echo '<br>'.$experticia[$i].' ['.$i.']';
                    $i++;
                  }
                ?>
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Registro</th>   
                        <th>Fecha Registro</th>
                        <th>Institución Solicitante</th>
                        <th>Unidad Actuante</th>
                        <th>Dependencia de la Unidad</th>
                        <th>Experticia</th>
                        <th>Nro Oficio</th>
                        <th>Fecha Oficio</th>
                        <th>Grado</th>
                        <th>Experto</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php
                     $i=1;
                    $cant_experticia=count($experticia); 
                    //for ($j=0; $j< $cant_experticia; $j++)
                    //{
                      //$d_experticia=$experticia[$j];
                      /// SOLO MODIFICAR LAS FECHAS PARA PODER SACAR EL REPORTE DE QUIENES Y EN QUE AÑOS DEBEN 
                      //O TIENEN EXPERTICIAS PENDIENTES
                      // MODIFICAR LA FECHA Y EL TIPO DE EXPERTICIA SEGUN SEA EL CASO QUE DESEE    
                      $query=$this->db
                      ->select("*")
                      ->from("div_inf_for.acta_recepcion, quimica.remision_dictamen, public.users") 
                      ->where("acta_recepcion.nro_acta=remision_dictamen.id_remision_q AND acta_recepcion.tipo_acta=remision_dictamen.tipo_acta AND acta_recepcion.id_usuario=users.id and  acta_recepcion.tipo_acta='RECEPCION' AND id_tipo_experticia='10' and remision_ano='2020' and status_remi='1' and fecha_acta>='2020-01-01' and fecha_acta<='2020-12-31'")
                      ->order_by("nro_acta","asc")
                      ->get();  
                          foreach ($query->result() as $row)
                          {
                            //institucion solicitante
                            $institucion_solicitante= $this->acta_recepcion_model->buscar_institucion_solicitante($row->id_institucion_solicitante,false);

                            //unidad actuante
                            $unidad_actuante= $this->acta_recepcion_model->buscar_unidad_solicitante($row->id_unidad_solicitante,false);

                            //experticia
                            $experticia= $this->acta_recepcion_model->buscar_tipo_experticias($row->id_tipo_experticia,false);
                          
                        ?>
                        
                        <tr>
                          <td><?php echo $i++?></td>
                          <td><?php echo $row->nro_acta?></td>
                          <td><?php echo $row->fecha_acta?></td>
                          <td><?php echo $institucion_solicitante->des_institucion_solicitante?></td>
                          <td><?php echo $unidad_actuante->des_unidad_solicitantente?></td>
                          <td><?php echo $row->dependencia_unidad?></td>
                          <td><?php echo $experticia->des_experticia?></td>
                          <td><?php echo $row->nro_oficio?></td>
                          <td><?php echo $row->fecha_oficio?></td>
                          <td><?php echo $row->grado?></td>
                          <td><?php echo $row->last_name.' '.$row->first_name?></td>
                        </tr>

                    <?php
                      } //fin foreach
                    
                    //}//fin for
                    ?>
                                      
                    </tbody>
                  </table> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 

</div><!-- /.content-wrapper -->

 