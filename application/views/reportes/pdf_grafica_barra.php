<?php
 class MYPDF extends TCPDF {

    //Page header
    public function Header() {
          //AGREGANDO MARGENES 
          $this->SetTopMargin(45);

          // AGREGANDO IMAGENES AL PDF 
          // RECORDAR QUE K_PATH_IMAGES ES LA DIRECCION DE LA CARPETA DE IMAGENES
          // DE LA LIBRERIA TCPDF Y QUE HAY VNA TODAS LAS IMAGENES QUE QUEREMOS VER
          $image_file2 = K_PATH_IMAGES.'escudo.png'; 
          $this->Image($image_file2,40,12, 25,25);

          $image_file = K_PATH_IMAGES.'slcct.png'; 
          $this->Image($image_file,210,12, 32,25); 

          //MEMBRETE 
          $this->SetFont('helvetica', 'B', 8);
          $this->SetXY(88,0);
          $this->Cell(100, 25, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
          $this->SetXY(89,4);
          $this->Cell(100, 25, 'MINISTERIO DEL PODER POPULAR PARA LA DEFENSA', 0, 1, 'C'); 
          $this->SetXY(90,8);
          $this->Cell(100, 25, 'FUERZA ARMADA NACIONAL BOLIVARIANA', 0, 1, 'C');     
          $this->SetXY(91,12);
          $this->Cell(100, 25, 'GUARDIA NACIONAL BOLIVARIANA', 0, 1, 'C'); 
          $this->SetXY(92,16);
          $this->Cell(100, 25, 'SEGUNDO COMANDO Y JEFATURA DE ESTADO MAYOR GENERAL', 0, 1, 'C'); 
          $this->SetXY(93,20);
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
 
$pdf->SetFont('helvetica', 'B', 8); 


// $pdf->Write(0, K_PATH_IMAGES.' ');
 // $pdf->Write(0, base_url());
 
$fecha= array('30/09/2019','01/10/2019','02/10/2019','03/10/2019','04/10/2019');
$html='
<table  >
  <tr>
    <td style="text-align: center;vertical-align: middle;"><h1>GRAFICO SEMANAL DE EXPERTICIAS REALIZADAS EN EL SLCCT-GNB</h1></td> 
  </tr> 
   <tr> 
    <td style="text-align: center;vertical-align: middle;"><h3>SEMANA DEL '.$fecha[0].' AL '.$fecha[4].' </h3></td>
  </tr>
</table>

';


$image_file2 = base_url().'public/images/graficas_generadas/Grafica2.png'; 
$pdf->Image($image_file2,40,60, 200,100);
 


$html=$html.'
<br><br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br> <br><br><br><br><br> 
<br><br><br><br><br> <br><br><br><br><br> <br><br><br>  
<table  >
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
