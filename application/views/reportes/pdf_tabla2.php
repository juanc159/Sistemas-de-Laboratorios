<?php
 class MYPDF extends TCPDF {

    //Page header
    public function Header() {
          //AGREGANDO MARGENES 
          $this->SetTopMargin(45);

          // define style for border
          $border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));

                   
          $this->SetDrawColor(255, 127, 127);
          $this->SetFillColor(255, 242, 204);
          $this->Rect(0, 0, 279, 215, 'DF', $border_style);

          // AGREGANDO IMAGENES AL PDF 
          // RECORDAR QUE K_PATH_IMAGES ES LA DIRECCION DE LA CARPETA DE IMAGENES
          // DE LA LIBRERIA TCPDF Y QUE HAY VNA TODAS LAS IMAGENES QUE QUEREMOS VER
          $image_file2 = K_PATH_IMAGES.'escudo.png'; 
          $this->Image($image_file2,10,12, 32,30);

          $image_file = K_PATH_IMAGES.'logo_mp.png'; 
          $this->Image($image_file,237,12, 32,30); 


          //MEMBRETE 
          $this->SetFont('helvetica', 'B', 10);
          $this->SetXY(88,4);
          $this->Cell(100, 25, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
          $this->SetXY(89,8);
          $this->Cell(100, 25, 'MINISTERIO DEL PODER POPULAR PARA LA DEFENSA', 0, 1, 'C'); 
          $this->SetXY(90,12);
          $this->Cell(100, 25, 'FUERZA ARMADA NACIONAL BOLIVARIANA', 0, 1, 'C');     
          $this->SetXY(91,16);
          $this->Cell(100, 25, 'GUARDIA NACIONAL BOLIVARIANA', 0, 1, 'C'); 
          $this->SetXY(92,20);
          $this->Cell(100, 25, 'SEGUNDO COMANDO Y JEFATURA DE ESTADO MAYOR GENERAL', 0, 1, 'C'); 
          $this->SetXY(93,24);
          $this->Cell(100, 25, 'SISTEMA DE LABORATORIOS CRIMINALISTICOS, CIENTIFICOS Y TECNOLOGICOS', 0, 1, 'C');  
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

//*************
ob_end_clean(); //rompimiento de pagina
//*************

$pdf = new MYPDF('LANDSCAPE', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
 
// set default header data
 $pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts 
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins  
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
$pdf->SetPrintFooter(true);
 
// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);
 

$pdf->AddPage();
 // Set some content to print    


// set margins 
  
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
                  'nombre' => 'QUÍMICA',
                  'descripcion' => 'DEPARTAMENTO DE QUÍMICA'),
              array(  'id' => '2',
                  'nombre' => 'FÍSICA',
                  'descripcion' => 'DEPARTAMENTO DE FÍSICA'),
              array(  'id' => '3',
                  'nombre' => 'INFORMÁTICA',
                  'descripcion' => 'DEPARTAMENTO DE INFORMÁTICA'),
              array(  'id' => '4',
                  'nombre' => 'BIOLOGÍA',
                  'descripcion' => 'DEPARTAMENTO DE BIOLOGÍA')

            );


            $exp= array(
              array('EXPERTICIA DE DROGAS','DESCARTES QUÍMICOS','TOXICOLOGÍA','TEXTILES','ALCOHOLIMETRÍA'),
              array('GRAFOTÉCNICA','RECONOCIMIENTO TÉCNICO','BALÍSTICA','DACTILOSCOPIA','VEHÍCULO','INSPECCIONES TÉCNICAS'),
              array('RECONOCIMIENTO TÉCNICO','EXTRACCIÓN DE CONTENIDO','COHERENCIA TECNICA','ANÁLISIS AUDIOVISUAL'),
              array('MICROBIOLOGÍA','BOTÁNICA','FISICOQUÍMICO','GENÉTICA FORENSE','ANTROPOLOGÍA FORENSE')
            );





 function createRange($start, $end, $format = 'Ym-d') { $start = new DateTime($start); $end = new DateTime($end); $invert = $start > $end; $dates = array(); $dates[] = $start->format($format); while ($start != $end) { $start->modify(($invert ? '-' : '+') . '1 day'); $dates[] = $start->format($format); } return $dates; }

 
$fecha_ini=$this->uri->segment(3);
$fecha_fin=$this->uri->segment(4);
$fecha=createRange($fecha_ini,$fecha_fin, 'd-m-Y');
 
 


$pdf->SetFont('helvetica', 'B', 6); 



// define style for border
$border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));











$pdf->SetDrawColor(255, 127, 127);
$pdf->SetFillColor(165, 0, 33);
$pdf->Rect(9, 54, 261, 20, 'DF', $border_style); 


$fecha_ini=date("d-m-Y", strtotime($fecha_ini));
$fecha_fin=date("d-m-Y", strtotime($fecha_fin));

$html='
<br><br><br><br><br><br>
<table  style="color:white; text-align: center;vertical-align: middle;">
  <tr >
    <td ><h2>REPORTE SEMANAL DE EXPERTICIAS REALIZADAS POR EL SISTEMA DE LABORATORIOS CRIMINALÍSTICOS, CIENTÍFICOS Y TECNOLÓGICOS  DE LA GUARDIA NACIONAL BOLIVARIANA</h2></td> 
  </tr>
  <tr >  
    <td style="text-align: center;vertical-align: middle;"><h3>DESDE EL DÍA LUNES '.$fecha_ini.' HASTA EL DOMINGO '.$fecha_fin.'</h3></td>
  </tr>
</table>
<br><br> <br><br>  
';


$html=$html.'
<table  id="example1" class="table  table-bordered table-striped  " border="1">
                <thead   >
  <tr  style="background-color:rgb(165,0,33); color:white;">
    <th  class="warning" style="text-align: center;vertical-align: middle;"  rowspan="2">LABORATORIOS</th>
  
 ';


  $listo=1;
  $i=0; 
  foreach ($exp as $value)
  {
    $cexd=count($value);
    if ($listo!=null)
    {
      $html=$html.'<th style="text-align: center; vertical-align: middle;" class="info" colspan="'.$cexd.'">DEPARTAMENTO DE '.$dep[$i]['nombre'].'</th>';
    }
    $i++;
  }
  $listo=null;
  $html=$html.'<th rowspan="2" style="text-align: center; vertical-align: middle;" class="danger">TOTAL</th>';
 
 $html=$html.'</tr>
<tr style="background-color:rgb(165,0,33); color:white; text-align: center;">';

 
  $i=0; 
  foreach ($exp as $value)
  {
    $cexd=count($value); 
    for ($j=0; $j < $cexd ; $j++) { 
      $html=$html."<th style='text-align: center;  vertical-align: middle;' class='success'>".$exp[$i][$j]."</th>";
    }
    $i++;
  }
    

$html=$html."
</tr>
  </thead>
  <tbody>";



$id_lab=0;
$suma_total[][]=array();
$v[]=array();
for ($j=0; $j < 10 ; $j++)
{ 
        $html=$html.'<tr style="background-color:rgb(255,255,0); color:black; text-align: center;" >';
        $html=$html.'<td style="background-color:rgb(189,215,238); color:black;" class="warning"><strong>'.$lab[$j]['nombre']." #".$lab[$j]['numero']."</strong></td>";

        
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
            $html=$html.'<td style="background-color:rgb(255,255,0); color:black;">'.$s."</td>";
            $suma_total[$j][$cst]=$s;
            $v[$j]+=$suma_total[$j][$cst];
            $cst++;
          }
          
          $d++;

        }
        $html=$html.'<td style="font-size:12px;"  class="danger">'.$v[$j]."</td>";

        $html=$html."</tr>";

}

 $html=$html.'
<tr  style="background-color:rgb(189,215,238); color:black; text-align: center;"> 
  <td  class="danger" style="text-align: center;"><strong>TOTAL</strong></td>';


  $v[]=array();

  $total_completo=0;
  for ($x=0; $x < 20; $x++)
  { 
    $v[$x]=0;
      for ($j=0; $j < 10; $j++) 
      { 
        
        $v[$x]+=$suma_total[$j][$x];
        
      }
      $html=$html.'<td style="background-color:rgb(255,255,0); color:black; font-size:12px;" class="danger">'.$v[$x]."</td>"; 
      $total_completo+=$v[$x];
   } 

$html=$html.'
   <td style="background-color:rgb(255,255,0); color:black; font-size:12px;" class="info">';
   $html=$html.$total_completo;

   $html=$html."</td>
</tr> 

</tbody>

</table>
"; 

$html=$html.'
<br><br><br><br><br><br>
<table  >
 <tr>
    <td style="text-align: left;vertical-align: middle;"><h2>CONFORME:</h2></td> 
  </tr>

</table>
<br><br><br><br><br><br><br>  
<table style="font-size:8px" > 
  <tr>
    <td style="text-align: center;vertical-align: middle;"><h2>G/B. FRANK ERNESTO PÉREZ GONZÁLEZ</h2></td> 
  </tr>
  <tr> 
    <td style="text-align: center;vertical-align: middle;"><h3>DIRECTOR DEL SISTEMA DE LABORATORIOS CRIMINALISTICOS, CIENTIFICOS Y TECNOLOGICOS</h3></td>
  </tr>
  <tr> 
    <td style="text-align: center;vertical-align: middle;"><h3>DE LA GUARDIA NACIONAL BOLIVARIANA </h3></td>
  </tr>
</table>

';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Reporte.pdf', 'I');
?>