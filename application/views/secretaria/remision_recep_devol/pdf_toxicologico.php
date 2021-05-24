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
          $this->SetFont('helvetica', 'B', 10);
          $this->SetXY(88,0);
          $this->Cell(30, 25, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
          $this->SetXY(89,4);
          $this->Cell(30, 25, 'MINISTERIO DEL PODER POPULAR PARA LA DEFENSA', 0, 1, 'C'); 
          $this->SetXY(90,8);
          $this->Cell(30, 25, 'FUERZA ARMADA BOLIVARIANA', 0, 1, 'C');     
          $this->SetXY(91,12);
          $this->Cell(30, 25, 'GUARDIA NACIONAL BOLIVARIANA', 0, 1, 'C'); 
          $this->SetXY(92,16);
          $this->Cell(30, 25, 'SEGUNDO COMANDO Y JEFATURA DE ESTADO MAYOR GENERAL', 0, 1, 'C'); 
          $this->SetXY(93,20);
          $this->Cell(30, 25, 'LABORATORIO CRIMINALISTICO N° 43', 0, 1, 'C'); 
          $this->SetXY(94,24);
          $this->Cell(20, 25, 'DIVISION DE QUIMICA', 0, 1, 'C');  
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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
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
$pdf->SetFont('helvetica', 'B', 10); 

// set margins 

$nro_acta=$this->uri->segment(3);
$datos=$this->quimica_model->buscar_acta('nro_acta',$nro_acta);

foreach($datos as $dato)
{
  //UNIDAD SOLICITANTE
  $id_unidad_solicitante=$dato->id_unidad_solicitante;
  $datos2=$this->acta_recepcion_model->buscar('div_inf_for.unidad_solicitante','id_unidad_solicitante',$id_unidad_solicitante);
  foreach($datos2 as $dato2)
  {
    $des_unidad_solicitantente=$dato2->des_unidad_solicitantente;
  }

  // EL RESTO DE LA INFORMACION
  $fecha_acta=$dato->fecha_acta;
  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;
  $tipo_acta=$dato->tipo_acta;
  $num_causa=$dato->num_causa;
  $num_expediente=$dato->num_expediente;
  $nombre_imputado=$dato->nombre_imputado;
  $cedula_imputado=$dato->cedula_imputado;
  $evidencia=$dato->evidencia;
  $observaciones=$dato->observaciones; 
  $jefe_nombre=$dato->jefe_nombre; 
  $jefe_cedula=$dato->jefe_cedula; 

  //usuario quien realizo el acta de peritacion
  $id_usuario=$dato->id_usuario;
  $datos3=$this->acta_recepcion_model->buscar('div_inf_for.usuarios','id_usuario',$id_usuario);
  foreach($datos3 as $dato3)
  {
    $gdo_jquia=$dato3->gdo_jquia;
    $cedula=$dato3->cedula;
    $apellidos=$dato3->apellidos;
    $nombres=$dato3->nombres;
  }
}
 
$html = '

<table  border="1"   >
<tr>
      <td style="text-align:left;"><h3>NUMERO REGISTRO: '.$nro_acta.'</h3></td> 
      <td   style="text-align:center;"><h3>ACTA DE PERITACION <br>(Art. 223,224,225 del COPP)</h3></td> 
      <td style="text-align:center;"><h3>LCCT-DQ-FIE-014-1</h3></td> 
</tr> 
</table>

<table  border="1" style="text-align:center;"  >
<tr>
      <td>UNIDAD SOLICITANTE</td> 
      <td>FECHA / NRO. OFICIO</td> 
      <td>EXPERTO DESIGNADO</td> 
      <td>FECHA DE REALIZACION</td> 
</tr> 
<tr>
      <td>'.$des_unidad_solicitantente.'</td> 
      <td>'.$fecha_acta.' / '.$nro_oficio.'</td> 
      <td>'.$gdo_jquia.' '.$apellidos.' '.$nombres.'</td> 
      <td>'.$fecha_acta.'</td> 
</tr> 
</table>

<table  border="1" style="text-align:center;"  >
<tr>
      <td>NRO. CAUSA / EXPEDIENTE</td> 
      <td>NOMBRE Y APELLIDO DE O LOS IMPUTADOS</td> 
      <td>N° CI DEL IMPUTADO</td>  
</tr> 
<tr>
      <td>'.$num_causa.' / '.$num_expediente.'</td> 
      <td>'.$nombre_imputado.'</td> 
      <td>'.$cedula_imputado.'</td>  
</tr> 
</table>

 <table  border="1">
<tr style="text-align:left;">
      <td>DESCRIPCION DE LA EVIDENCIA:</td>  
</tr> 
 
 <tr>
      <td>'.$evidencia.'</td>  
</tr>
</table>


 <table  border="1">
<tr style="text-align:left;">
      <td>OBSERVACIONES:</td>  
</tr> 
 
 <tr>
      <td>'.$observaciones.'</td>  
</tr>
</table>



 
<p></p>
<table style="text-align:center;" border="0" cellspacing="3" cellpadding="4">

  <tr>
        <td>'.$gdo_jquia.' '.$apellidos.' '.$nombres.'</td>
        <td>'.$jefe_nombre.'</td>
    </tr>
    <tr>
        <td>C.I. V- '.$cedula.'</td>
        <td>C.I. '.$jefe_cedula.'</td>
    </tr>
    <tr>
        <td>___________________________________
<p>EXPERTO QUE RECIBE LA EVIDENCIA</p>
</td>
<td>___________________________________
<p>JEFE DE LA COMISIÓN</p>
</td>
    </tr>
     
</table>

 
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Reporte.pdf', 'I');
?>