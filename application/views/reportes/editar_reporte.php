 <?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php

$lab=array(
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'ZULIA',
        'numero' => '11',
        'id' => '1',
        'archivo' => 'lab11.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'LARA',
        'numero' => '12',
        'id' => '2'  ,
        'archivo' => 'lab12.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'TACHIRA',
        'numero' => '21',
        'id' => '3'  ,
      'archivo' => 'lab21.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'APURE',
        'numero' => '35',
        'id' => '4' ,
        'archivo' => 'lab35.csv' ), 
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'CARABOBO',
        'numero' => '41',
        'id' => '5' ,
        'archivo' => 'lab41.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'ARAGUA',
        'numero' => '42',
        'id' => '6' ,
        'archivo' => 'lab42.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'DTT CAPITAL',
        'numero' => '43',
        'id' => '7' ,
        'archivo' => 'lab43.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'ANZOATEGUI',
        'numero' => '52',
        'id' => '8' ,
        'archivo' => 'lab52.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'BOLIVAR',
        'numero' => '62',
        'id' => '9' ,
        'archivo' => 'lab62.csv' ),
  array('nombre' => 'LCCT-GNB',
        'direccion' => 'AMAZONAS',
        'numero' => '63',
        'id' => '10' ,
        'archivo' => 'lab63.csv' )
    );

 
  
 

			$dep= array(
              array(  'id' => '1',
                  'nombre' => 'QUIMICA',
                  'descripcion' => 'DEPARTAMENTO DE QUÍMICA'),
              array(  'id' => '2',
                  'nombre' => 'FISICA',
                  'descripcion' => 'DEPARTAMENTO DE FÍSICA'),
              array(  'id' => '3',
                  'nombre' => 'INFORMATICA',
                  'descripcion' => 'DEPARTAMENTO DE INFORMÁTICA'),
              array(  'id' => '4',
                  'nombre' => 'BIOLOGIA',
                  'descripcion' => 'DEPARTAMENTO DE BIOLOGÍA'),
              array(  'id' => '5',
                  'nombre' => 'COMISION',
                  'descripcion' => 'COMISIONES')

            );


            $exp= array(
              array('EXPERTICIA DE DROGAS','DESCARTES QUÍMICOS','TOXICOLOGÍA','TEXTILES','ALCOHOLIMETRÍA'),
              array('GRAFOTÉCNICA','RECONOCIMIENTO TÉCNICO','BALÍSTICA','DACTILOSCOPIA','VEHÍCULO','INSPECCIONES TÉCNICAS'),
              array('RECONOCIMIENTO TÉCNICO','EXTRACCIÓN DE CONTENIDO','COHERENCIA TECNICA','ANÁLISIS AUDIOVISUAL'),
              array('MICROBIOLOGÍA','BOTÁNICA','FISICOQUÍMICO','GENÉTICA FORENSE','ANTROPOLOGÍA FORENSE'),
              array('COMISIÓN')
            );

 
 $fecha= array('27/01/2020','21/01/2020','22/01/2020','23/01/2020','24/01/2020','25/01/2020','26/01/2020');




$fecha_reporte=$this->uri->segment(3);


 //sumando
 
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>REPORTES
            <small>DEMO</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content"> 
    	<!-- Your Page Content Here -->
    	<div class="box">
	    	<div class="box-header"> 
		    	<div class="row">
		        	<div class="col-md-9">
		            	<div class="form-group"> 
		                	<h3 class="box-title">REPORTE DE FECHA <?php echo date('d/m/Y')?>  </h3> 
		              	</div>
		            </div>  
		           	<div class="col-md-3">
		            	<div class="form-group"> 
		                	<a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url().'reportes/pdf_tabla/'.$fecha_reporte ?>"> Ver Reporte en PDF</a>
		              	</div>
		          	</div>      
		        </div>
	      	</div><!-- /.box-header -->
      		<div class="box-body"> 
      			<form method="POST" action="" name="form2" id="form2">
	      			<div class="row">
	            		<div class="col-xs-12 table-responsive"> 
								<table  id="example1" class="table    table-striped  " border="3">
								  <thead>
								    <tr  >
								      <th  class='warning' style='text-align: center; vertical-align: middle;'  rowspan="2">LABORATORIOS</th>
								        <?php
								          $listo=1;
								          $i=0; 
								          foreach ($exp as $value)
								          {
								            $cexd=count($value);
								            if ($listo!=null)
								            {
								              echo "<th style='text-align: center; vertical-align: middle;' class='info' colspan=".$cexd.">".$dep[$i]['descripcion']."</th>";
								            }
								            $i++;
								          }
								          $listo=null;
								        ?> 
								      </tr>
								    <tr>
								      <?php 
								        $i=0; 
								        foreach ($exp as $value)
								        {
								          $cexd=count($value); 
								          for ($j=0; $j < $cexd ; $j++) { 
								            echo "<th style='text-align: center; vertical-align: middle;' class='success'>".$exp[$i][$j]."</th>";
								          }
								          $i++;
								        }
								      ?>  
								    </tr>
								  </thead>
								<tbody>
								    <?php
								      $fecha_reporte=$this->uri->segment(3);
								      for ($j=0; $j < 10 ; $j++)
								      { 
								              echo "<tr  >";
								              echo "<td class='warning'><strong>".$lab[$j]['nombre']." #".$lab[$j]['numero']."</strong></td>";

								              
								              $v[$j]=0;
								              $d=0; 
								              $ex=0;
								              foreach ($exp as $value)
								              {
								                for ($e=0; $e < count($value); $e++)
								                {  
								                	$where=array(
						                                'id_lab' => $lab[$j]['id'],
						                                'fecha' => $fecha_reporte,
						                                'id_dependencia' => $dep[$d]['id'],
						                                'id_exp' => $e,
						                             );
											        $dato=$this->acta_recepcion_model->buscar('public.reporte',$where,false);
											        //print_r($dato);
											        //exit;
								                  //echo "<hr>";

											        $texto='Laboratorio: '.$lab[$j]['numero'].' / ';
											        $texto=$texto.'Departamento: '.$dep[$d]['nombre'].' / ';
											        $texto=$texto.'Experticia: '.$exp[$ex][$e].'';
								                  echo '<td>
								                  <span data-toggle="tooltip" title="" class="  " data-original-title="'.$texto.' ">
								                  <input type="text"  maxlength="3"  name="dato_'.$lab[$j]['numero'].'_'.$dep[$d]['nombre'].'_'.$e.'" id="dato_'.$lab[$j]['numero'].'_'.$dep[$d]['nombre'].'_'.$e.'" class="form-control m-b" value="'.$dato->cant.'" onkeypress="return SoloNumeros(event)"></span>
								                  </td>';  
								                } 
								                $d++;
								                $ex++;
								              } 
								      }
								    ?> 
								  </tbody> 
								</table>
							
						</div><!-- /.table-responsive -->
					</div><!-- /.row -->
	 				
	 				<div class="row"> 
						<div class="col-md-12">
			                <div class="form-group">    
			                </div>
			            </div>
			        </div>
					<div class="row"> 
						<div class="col-md-6">
			                <div class="form-group">    
			                </div>
			            </div>
	            		<div class="col-md-3">
			                <div class="form-group">   
			                	<a class="btn btn-block btn-danger" href="<?php echo base_url()?>reportes">CANCELAR / REGRESAR</a>
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">   
			                	 <input class="btn btn-block btn-primary" type="submit"   value="GUARDAR ACTA" > 
			                </div>
			            </div>
		        	</div>
	        	</form>
        	</div><!-- /.box-body -->
        </div> <!-- /.box -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

 