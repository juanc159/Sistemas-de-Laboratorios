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
      'descripcion' => 'Departamento de Quimica', ),
  array(  'id' => '2',
      'nombre' => 'FISICA',
      'descripcion' => 'Departamento de Fisica', ),
  array(  'id' => '3',
      'nombre' => 'INFORMATICA',
      'descripcion' => 'Departamento de Informatica', ),
  array(  'id' => '4',
      'nombre' => 'BIOLOGIA',
      'descripcion' => 'Departamento de Biologia', )
);


$exp= array(
  array('EXPERTICIA DE DROGAS','DESCARTES QUIMICOS','TOXICOLOGIA','TEXTILES','ACOHOLIMETRIA'),
  array('GRAFOTECNICA','RECONOCIMIENTO TECNICO','BALISTICA','DATILOSCOPIA','VEHICULO','INSPECCIONES TECNICAS'),
  array('RECONOCIMIENTO TECNICO','EXTRACCION DE CONTENIDO','COHERENCIA TECNICA','ANALISIS AUDIOVISUAL'),
  array('MICROBIOLOGIA','BOTANICA','FISICOQUIMICO','GENETICA FORENSE','ANTROPOLIA FORENSE'),
);

 
 $fecha= array('27/01/2020','21/01/2020','22/01/2020','23/01/2020','24/01/2020','25/01/2020','26/01/2020');



$sumatoria[][]=array(); 
$s=0;
$suma=array(); 
for ($j=0; $j < 10 ; $j++)
{  //recorre los laboratorios

  //agarra el documento y lo reccorre
  $h=0;
  $archivo_nombre=$lab[$j]['archivo'];
  if(($fp = fopen(base_url().'uploads/reporte_semanal/'.$archivo_nombre, "r")) !== FALSE) {
    $k=0;
      while (($datos = fgetcsv($fp,null,";")) !== FALSE) {
          $numero = count($datos);
          //echo $datos[0].'<br>';

          //echo $suma[$k]=$suma[$k]+$datos[$k];
         /* echo $datos[1].'<br>';
          echo $datos[2].'<br>';
          echo $datos[3].'<br>';*/
          $k++;
          for ($i = 0; $i < $numero; $i++){

            $matriz[$h][$i]=$datos[$i];
          }
          $h++;
      }
      fclose($fp);
  }
  //
 

  //echo "<h2>LABORATORIO ".$lab[$j]['numero'].' / ARCHIVO: '.$lab[$j]['archivo'].'</h2>'; 
  $texto_dir="'".$lab[$j]['id']."',";
    $f=0;
    foreach ($fecha as $value_fecha)
    {
      $i=0;
      $p=0;
      $total=0;
      $rc=0;//inicializa desde la colimna 0
      $texto_fecha="'".$fecha[$f]."',";
      foreach ($exp as $value)
      {
        $cexd=count($value);
        $total=$p+$cexd;
        //echo "<hr><h4>DIVISION ".$dep[$i]['nombre'].' / CANTIDAD DE EXPERTICIAS: '.$cexd.'</h4>';
         
        

        $division="'".$dep[$i]['id']."',";
        $s=0;
        for ($y=0; $y < $cexd; $y++)
        {
          $experticia="'".$y."',"; 

          //se revisa si la cantidad que llega no es algo nulo
          //if es nulo o un espacio se agrega automaticamente el cero a la cantidad
          $cantidad=$matriz[$f][$rc];
          if ($cantidad==" " or $cantidad==""){
            $cantidad=0;
          }
          else{
            $cantidad=$matriz[$f][$rc];
          }
          
          
          //echo 'insert into public.reporte(id_lab,fecha,id_dependencia,id_exp,cant) values ('.$texto_dir.$texto_fecha.$division.$experticia.$cantidad.'); <br>';

           $sql='insert into public.reporte(id_lab,fecha,id_dependencia,id_exp,cant) values ('.$texto_dir.$texto_fecha.$division.$experticia."'".$cantidad."'".')';
 
          $s=$s+settype($matriz[$f][$rc],"integer");
           $sumatoria[$f][$rc]=$s;
           //pg_query($dbconn,$sql);
           
          $rc++; //se mueve de columna en columna
        }

        
        $p=$total;
        $i++;
      }  
      $f++; 
    } 
}
 


 //sumando
 
?> 
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            REPORTES
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
                <h3 class="box-title">REPORTE SEMANAL DE FECHA <?php echo $fecha[0]?> HASTA EL <?php echo $fecha[6]?>  </h3> 
              </div>
            </div>  
           <div class="col-md-3">
              <div class="form-group"> 
                <a target="v"  class="btn btn-block btn-primary fa fa-file-pdf-o" href="<?php echo base_url() ?>reportes/pdf_tabla"> Ver Reporte en PDF</a>
              </div>
          </div>      
        </div>
      </div><!-- /.box-header -->
      <div class="box-body"> 
        <!-- Table row -->


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
            $sql="select cant from public.reporte where id_lab='".$id_lab."' and id_dependencia='".$d."' and id_exp='".$e."';";
            
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
  for ($x=0; $x < 20; $x++)
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

</tbody>

</table>



            </div><!-- /.col -->
          </div><!-- /.row -->

          </div>
          </div> 

      <div class="box">
      <div class="box-header"> 
        <div class="row">
          <div class="col-md-9">
              <div class="form-group"> 
                <h3 class="box-title">REPORTE SEMANAL DE FECHA 30/09/2019 HASTA EL 06/10/2019 </h3> 
              </div>
            </div>  
           <div class="col-md-3">
              <div class="form-group"> 
               
              </div>
          </div>      
        </div>
      </div><!-- /.box-header -->
      <div class="box-body"> 
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-6 table-responsive">

              <div id="canvas-holder" style="width:100%">
                <canvas id="chart-area"></canvas>
              </div>


                                <script>

                                var randomScalingFactor = function() {
                                      return Math.round(Math.random() * 255);
                                    };

                                var bgColor = [];
                                  <?php
                                            for ($j=0; $j < 10 ; $j++)
                                            {
                                            ?>
                                              var colorR = randomScalingFactor();
                                              var colorG = randomScalingFactor();
                                              var colorB = randomScalingFactor();
                                              bgColor.push('rgba('+colorR+','+colorG+','+colorB+','+1+')');

                                            <?php
                                            } 
                                            ?>


                                var ctx1 = document.getElementById("chart-area");
                                var myChart = new Chart(ctx1, {
                                    type: 'pie',
                                    data: {

                                        labels: [
                                        <?php
                                        $j=0;
                                        foreach ($exp as $value)
                                        {
                                          $cexd=count($value);
                                            $total=$p+$cexd;
                                          for ($e=0; $e < count($value); $e++)
                                            {
                                            ?>
                                           '<?php echo $exp[$j][$e]; ?>',

                                          <?php
                                         
                                        } $j++;}
                                        ?>
                                 
                                        ],
                                        datasets: [{
                                            label: 'GRAFICA DE EXPERTICIAS ',
                                            data: [
                                            <?php
                                        for ($j=0; $j < 20 ; $j++)
                                        {
                                          ?>
                                         '<?php echo $v2[$j];?>',

                                        <?php
                                        } 
                                        ?>
                                        ],

                                            backgroundColor: bgColor, 
                                            borderAlign: 'inner',
                                            borderColor: bgColor,
                                            borderWidth: 1,
                                            hoverBackgroundColor  :'rgba(0, 0, 0, 0.1)',
                                            hoverBorderColor: 'rgba(255, 0, 0, 0.1)',
                                            hoverBorderWidth: 2 
                                        }]
                                    },
                                    options: {
                                        animation: {
                                             easing:'easeOutBounce'
                                        }
                                    }
                                     
                                });

                                var dataURL1 = ctx1.toDataURL('image/png');

                                </script>

                  <form target="v" method="POST" action="<?php echo base_url() ?>reportes/pdf_grafica_torta" name="form1" id="form1">
                <input type="hidden" name="base64" id="base64"/> 
                <button class="btn btn-block btn-primary fa fa-file-pdf-o" type="submit">
                  Ver Reporte en PDF
                </button>
              </form>
            </div>

 
          <div class="row">
            <div class="col-xs-6 table-responsive">

               


                    <div id="canvas-holder" style="width:100%">
                                    <canvas id="chart-area2"></canvas>
                                  </div>


                    <script>

                                var randomScalingFactor = function() {
                                      return Math.round(Math.random() * 255);
                                    };

                                var bgColor = [];
                                  <?php
                                            for ($j=0; $j < 10 ; $j++)
                                            {
                                            ?>
                                              var colorR = randomScalingFactor();
                                              var colorG = randomScalingFactor();
                                              var colorB = randomScalingFactor();
                                              bgColor.push('rgba('+colorR+','+colorG+','+colorB+','+1+')');

                                            <?php
                                            } 
                                            ?>


                                var ctx2 = document.getElementById("chart-area2"); 
                                var myChart = new Chart(ctx2, {
                                    type: 'bar',
                                    data: {

                                        labels: [
                                        <?php
                                        for ($j=0; $j < 10 ; $j++)
                                        {
                                          ?>
                                         '<?php echo $lab[$j]['nombre'].$lab[$j]['numero'].'= '.$v[$j];?>',

                                        <?php
                                        } 

                                        ?>
                                 
                                        ],
                                        datasets: [{
                                            label: 'GRAFICA DE EXPERTICIAS ',
                                            data: [
                                            <?php
                                        for ($j=0; $j < 10 ; $j++)
                                        {
                                          ?>
                                         '<?php echo $v[$j];?>',

                                        <?php
                                        } 
                                        ?>
                                        ],

                                            backgroundColor: bgColor,
                                            borderColor: bgColor,
                                            borderWidth: 1
                                        }]
                                    }
                                     
                                });

                                var dataURL2 = ctx2.toDataURL('image/png');

                                </script>


<button id="btn0" class="btn btn-outline-primary btn-lg btn-block">Básico</button> 

              <form target="v" method="POST" action="<?php echo base_url() ?>reportes/pdf_grafica_barra" name="form2" id="form2">
                 
                <input type="hidden" name="base64_2" id="base64_2"/> 
                <button class="btn btn-block btn-primary fa fa-file-pdf-o" type="submit">
                  Ver Reporte en PDF
                </button>
              </form>
               </div>
 
          </div>
      </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script>

  $("#btn0").click(function(){
    Swal.fire('Ejemplo basico de Sweet Alert 2');
}); 


   // on the submit event, generate a image from the canvas and save the data in the textarea
   document.getElementById('form1').addEventListener("submit",function(){
      var image1 = ctx1.toDataURL(); // data:image/png....
      document.getElementById('base64').value = image1; 
   },false);


    // on the submit event, generate a image from the canvas and save the data in the textarea
   document.getElementById('form2').addEventListener("submit",function(){
      var image2 = ctx2.toDataURL(); // data:image/png....
      document.getElementById('base64_2').value = image2;
   },false);


</script>
 