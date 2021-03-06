<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php 

$fecha_reporte=date('d-m-Y');
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
                  'descripcion' => 'DEPARTAMENTO DE QU??MICA'),
              array(  'id' => '2',
                  'nombre' => 'FISICA',
                  'descripcion' => 'DEPARTAMENTO DE F??SICA'),
              array(  'id' => '3',
                  'nombre' => 'INFORMATICA',
                  'descripcion' => 'DEPARTAMENTO DE INFORM??TICA'),
              array(  'id' => '4',
                  'nombre' => 'BIOLOGIA',
                  'descripcion' => 'DEPARTAMENTO DE BIOLOG??A'),
              array(  'id' => '5',
                  'nombre' => 'COMISION',
                  'descripcion' => 'COMISIONES')

            );


            $exp= array(
               array('EXPERTICIA DE DROGAS','DESCARTES QU??MICOS','TOXICOLOG??A','TEXTILES','ALCOHOLIMETR??A'),
              array('GRAFOT??CNICA','RECONOCIMIENTO T??CNICO','BAL??STICA','DACTILOSCOPIA','VEH??CULO','INSPECCIONES T??CNICAS'),
              array('RECONOCIMIENTO T??CNICO','EXTRACCI??N DE CONTENIDO','COHERENCIA TECNICA','AN??LISIS AUDIOVISUAL'),
              array('MICROBIOLOG??A','BOT??NICA','FISICOQU??MICO','GEN??TICA FORENSE','ANTROPOLOG??A FORENSE'),
              array('COMISI??N')
            );


             function createRange($start, $end, $format = 'Ym-d') { $start = new DateTime($start); $end = new DateTime($end); $invert = $start > $end; $dates = array(); $dates[] = $start->format($format); while ($start != $end) { $start->modify(($invert ? '-' : '+') . '1 day'); $dates[] = $start->format($format); } return $dates; }

 
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
		        	<div class="col-md-6">
		            	<div class="form-group"> 
		                	<h3 class="box-title">REPORTE DE FECHA <?php echo $fecha_reporte?>  </h3> 
		              	</div>
		            </div>  
		            <div class="col-md-3">
			        	<div class="form-group">
			            	<a class="btn btn-block btn-primary" href="<?php echo base_url().'reportes/nuevo_reporte/'.$fecha_reporte ?>" > AGREGAR REPORTE </a>
			        	</div>
			        </div>   
		           	<div class="col-md-3">
			        	<div class="form-group">
			            	<a class="btn btn-block btn-danger" href="<?php echo base_url().'principal'?>">CANCELAR / REGRESAR</a> 
			        	</div>
			        </div>    
		        </div>
	      	</div><!-- /.box-header -->
      		 
        </div> <!-- /.box -->
        
      

        <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group">  
                <h3 class="box-title">REPORTE SEMANAL DE FECHA  </h3> 
              </div>
            </div>  
           <div class="col-md-3">
              <div class="form-group"> 
                <?php
                  if ($_POST)
                  {
                    $fecha_ini=$_POST['fecha_ini'];
                    $fecha_fin=$_POST['fecha_fin'];
                    $fecha=createRange($fecha_ini,$fecha_fin, 'd-m-Y');
                 
                ?>
                
                <a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url()."reportes/pdf_tabla_fechas/".$fecha_ini.'/'.$fecha_fin ?>"> Ver Reporte en PDF</a>
                <?php 
                  }
                ?>
              </div>
          </div>      
        </div>
      </div><!-- /.box-header -->
      <form method="POST" action="" name="form2" id="form2">
        <div class="box-body"> 

          <div class="row"> 
            <div class="col-md-3">
                <div class="form-group">  
                  <label>FECHA INICIAL:</label>
                    <input type="date" name="fecha_ini" id="fecha_ini" class="form-control m-b"/>  
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">  
                  <label>FECHA FINAL:</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control m-b"/>  
                </div>
            </div>   
            <div class="col-md-3">
                <div class="form-group">  
                  <label> &nbsp; </label>
                  <button class="btn btn-block btn-primary fa fa-file-pdf-o" type="submit"> GENERAR REPORTE </button>
                </div>
            </div>      
          </div><!-- /.FIN ROW -->

          <div class="row">
            <div class="col-xs-12 table-responsive">
             <table  id="example1" class="table  table-bordered table-striped  " border="3">
                <thead   >
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
                      echo "<th style='text-align: center; vertical-align: middle;' class='info' colspan=".$cexd.">DEPARTAMENTO DE ".$dep[$i]['nombre']."</th>";
                    }
                    $i++;
                  }
                  $listo=null;
                  echo "<th rowspan='2' style='text-align: center; vertical-align: middle;' class='danger'>TOTAL</th>";
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

                if ($_POST)
                {
                  $fecha_ini=$this->uri->segment(3);
                  $fecha_fin=$this->uri->segment(4);
                  $fecha_ini=$_POST['fecha_ini'];
                  $fecha_fin=$_POST['fecha_fin'];
                  $fecha=createRange($fecha_ini,$fecha_fin, 'd-m-Y');

                  
                  


               

                $id_lab=0;
                $suma_total[][]=array();
                $v[]=array();
                for ($j=0; $j < 10 ; $j++)
                {  
                        echo "<tr  >";
                        echo "<td class='warning'><strong>".$lab[$j]['nombre']." #".$lab[$j]['numero']."</strong></td>";

                        
                        $v[$j]=0;
                        $d=1;
                        $id_lab=$id_lab+1;
                          $cst=0;
                        foreach ($exp as $value)
                        {
                          $suma_total[$j][$cst]=0;
                          for ($e=0; $e < count($value); $e++)
                          { 
                            $sql="select cant from public.reporte where fecha>='$fecha_ini' and fecha<='$fecha_fin' and id_lab='".$id_lab."' and id_dependencia='".$d."' and id_exp='".$e."';";
                            
                            $datos = $this->db->query($sql);
                            $s=0;

                            foreach ($datos->result() as $arr)
                            { 
                              $s=$s+$arr->cant; 
                            }

                            //echo "<hr>";
                            echo "<td>".$s."</td>";
                            $suma_total[$j][$cst]=$s;
                            $v[$j]+=$suma_total[$j][$cst];
                            $cst++;
                          }
                          
                          $d++;

                        }
                        echo "<td class='danger'>".$v[$j]."</td>";

                        echo "</tr>";

                }
                ?> 
                <tr  > 
                  <td class='danger' style='text-align: center;'><strong>TOTAL</strong></td>
                  <?php
                  $v2[]=array();

                  $total_completo=0;
                  for ($x=0; $x < 21; $x++)
                  { 
                    $v2[$x]=0;
                      for ($j=0; $j < 10; $j++) 
                      { 
                        
                        $v2[$x]+=$suma_total[$j][$x];
                        
                      }
                      echo "<td class='danger'>".$v2[$x]."</td>"; 
                      $total_completo+=$v2[$x];
                   } 

                   ?>
                   <td class='info'><?php echo $total_completo; ?></td>
                </tr> 
                <?php
                 }
                ?>
                </tbody>

              </table>
          </div>
        </div>
      </div>
    </form>
  </div> 
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

 