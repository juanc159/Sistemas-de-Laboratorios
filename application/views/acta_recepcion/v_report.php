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
          $this->Image($image_file2,10,12, 25,25);

          $image_file = K_PATH_IMAGES.'slcct.png'; 
          $this->Image($image_file,170,12, 30,25); 

           

          //MEMBRETE 
          $this->SetFont('helvetica', 'B', 8);
          $this->SetXY(88,0);
          $this->Cell(30, 25, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
          $this->SetXY(89,4);
          $this->Cell(30, 25, 'MINISTERIO DEL PODER POPULAR PARA LA DEFENSA', 0, 1, 'C'); 
          $this->SetXY(90,8);
          $this->Cell(30, 25, 'FUERZA ARMADA NACIONAL BOLIVARIANA', 0, 1, 'C');     
          $this->SetXY(91,12);
          $this->Cell(30, 25, 'GUARDIA NACIONAL BOLIVARIANA', 0, 1, 'C'); 
          $this->SetXY(92,16);
          $this->Cell(30, 25, 'SEGUNDO COMANDO Y JEFATURA DE ESTADO MAYOR GENERAL', 0, 1, 'C'); 
          $this->SetXY(93,20);
          $this->Cell(30, 25, 'SISTEMA DE LABORATORIOS CRIMINALISTICOS, CIENTIFICOS Y TECNOLOGICOS', 0, 1, 'C'); 
          $this->SetXY(93,24);
          $this->Cell(30, 25, 'LABORATORIO CRIMINALISTICO N° 43', 0, 1, 'C');  

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
 


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
 
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




$posx=9;

// Add a page
// This method has several options, check the source code documentation for more information.





$pdf->AddPage();
 // Set some content to print    
 
 
$html = <<<EOD
 
EOD;

//---------------------------ACTA DE RECEPCIÓN---------------------------------//
$nro_acta=$this->uri->segment(3);
$tipo_a=$this->uri->segment(4);
$fecha_a=$this->uri->segment(5);
$datos=$this->acta_recepcion_model->buscar_acta('nro_acta',$nro_acta,'tipo_acta',$tipo_a,$fecha_a);

foreach($datos as $dato)
{
  $tipo_acta=$dato->tipo_acta;
}

$xpos=9;
$pdf->SetFillColor(198, 201, 203);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY($xpos,48); 
$pdf->MultiCell(197, 1, 'ACTA DE '.$tipo_acta, 1, 'C', 1, 1, '' ,'', true);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetXY($xpos,50); 

 
function cambiarFecha($fecha) {
  return implode("-", array_reverse(explode("-", $fecha)));
} 

 

foreach($datos as $dato)
{ 
 
  $fecha_acta=$dato->fecha_acta;
  $tipo_acta=$dato->tipo_acta;

  $id_institucion_solicitante=$dato->id_institucion_solicitante;
  $datos3=$this->acta_recepcion_model->buscar_institucion_solicitante($id_institucion_solicitante);
  foreach($datos3 as $dato3)
  {
    $des_institucion_solicitante=$dato3->des_institucion_solicitante;
  }


  $id_unidad_solicitante=$dato->id_unidad_solicitante;
  $datos3=$this->acta_recepcion_model->buscar_unidad_solicitante($id_unidad_solicitante);
  foreach($datos3 as $dato3)
  {
    $des_unidad_solicitantente=$dato3->des_unidad_solicitantente;
  }


  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;

  $id_tipo_experticia=$dato->id_tipo_experticia;
  $datos3=$this->acta_recepcion_model->buscar_tipo_experticias($id_tipo_experticia);
  foreach($datos3 as $dato3)
  {
    $des_experticia=$dato3->des_experticia;
  }


  $informacion_acta=$dato->informacion_acta;

  $cedula_jefe=$dato->cedula_jefe;
  $ape_nom_jefe=$dato->ape_nom_jefe;
  $cargo_jefe=$dato->cargo_jefe;
  $cargo_jefe=$dato->cargo_jefe;
  
  $telefono_jefe=$dato->telefono_jefe;


  $id_usuario=$dato->id_usuario;
         
}
$usuario = $this->ion_auth->user($id_usuario)->row(); 

 
 $pdf->SetFont('helvetica', 'B', 8);
$user=$this->ion_auth->get_users_groups($id_usuario)->result();
foreach ($user as $group){ 
 $departameto_header=$group->name;
}
$pdf->SetXY(97,28);
$pdf->Cell(20, 25, 'DEPARTAMENTO DE '.$departameto_header, 0, 1, 'C');

 
 $pdf->SetFont('helvetica', 'B', 10); 
$html = '
  
<table style="text-align:left;" border="1"   >

<tr>
      <td>NRO. DE REGISTRO: '.$nro_acta.' </td>
      <td>FECHA: '.cambiarFecha($fecha_acta).'</td>
</tr>
<tr>
      <td colspan="2">INSTITUCIÓN SOLICITANTE:'.$des_institucion_solicitante.'  </td>
</tr>
<tr>
      <td colspan="2">UNIDAD ACTUANTE:'.$des_unidad_solicitantente.'  </td>
</tr>
<tr>
      <td colspan="2">NRO. DE OFICIO Y FECHA: '.$nro_oficio.' CON FECHA DE '.cambiarFecha($fecha_oficio).' </td>
</tr>

<tr>
      <td colspan="2">TIPO DE EXPERTICIA: '.$des_experticia.' </td>
</tr>
 
 <tr>
      <td colspan="2">EVIDENCIAS: '.$informacion_acta.' </td> 
</tr>
</table>
 

 

<p></p>


<table style="text-align:center;" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td>

      <table style="text-align:center;" border="0" cellspacing="0" cellpadding="">
        <tr>
          <td>'.$usuario->grado.' '.$usuario->last_name.' '.$usuario->first_name.'</td> 
        </tr>
        <tr>
          <td>C.I. V- '.$usuario->cedula.'</td> 
        </tr>
        <tr> 
          <td></td> 
        </tr>
        <tr>
          <td style="border-top:solid black 1px;"><p>EXPERTO QUE RECIBE LA EVIDENCIA</p></td> 
        </tr>   
      </table>

    </td>

    <td>

    <table style="text-align:center;" border="0" cellspacing="0" cellpadding="">
      <tr> 
        <td>'.$cargo_jefe.' '.$ape_nom_jefe.'</td>
      </tr>
      <tr> 
        <td>C.I. '.$cedula_jefe.'</td> 
      </tr>
      <tr> 
        <td></td>
        <td></td>
      </tr>
      <tr> 
        <td style="border-top:solid black 1px;"><p>JEFE DE LA COMISIÓN <br> '.$telefono_jefe.'</p></td>
      </tr>   
    </table>

    </td>
  </tr>
</table>


';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Reporte.pdf', 'I');
?>