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
          $this->SetXY(94,28);
          $this->Cell(20, 25, 'DEPARTAMENTO DE QUIMICA', 0, 1, 'C');  
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
 

$pdf->AddPage();
 // Set some content to print    
$pdf->SetFont('helvetica', 'B', 10); 

// set margins 

$nro_acta=$this->uri->segment(3);
$fecha_a=$this->uri->segment(4);
$where = array(
                'nro_acta' =>$nro_acta,
                'fecha_acta' =>$fecha_a,
            );
$datos=$this->quimica_model->buscar_descarte($where);

foreach($datos as $dato)
{

//INSITUCION SOLICITANTE
  $id_institucion_solicitante=$dato->id_institucion_solicitante;
  $where_institucion = array(
        'id_institucion_solicitante' => $id_institucion_solicitante
        );
  $datos2=$this->acta_recepcion_model->buscar('div_inf_for.institucion_solicitante',$where_institucion);
  foreach($datos2 as $dato2)
  {
    $des_institucion_solicitante=$dato2->des_institucion_solicitante;
  }

  //UNIDAD ACTUANTE
  $id_unidad_solicitante=$dato->id_unidad_solicitante;
  $where_unidad = array(
        'id_unidad_solicitante' => $id_unidad_solicitante
        );
  $datos2=$this->acta_recepcion_model->buscar('div_inf_for.unidad_solicitante',$where_unidad);
  foreach($datos2 as $dato2)
  {
    $des_unidad_solicitantente=$dato2->des_unidad_solicitantente;
  }

$dependencia_unidad=$dato->dependencia_unidad;

  // EL RESTO DE LA INFORMACION
  $fecha_acta=$dato->fecha_acta;
  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;
  $tipo_acta=$dato->tipo_acta;  
  $empresa=$dato->empresa;
  $exportador=$dato->exportador;
  $evidencia=$dato->evidencia; 
  $jefe_nombre=$dato->jefe_nombre; 
  $jefe_cedula=$dato->jefe_cedula; 

  //usuario quien realizo el acta de peritacion
  $id_usuario=$dato->id_usuario;
  $usuario = $this->ion_auth->user($id_usuario)->row(); 
}
 
$html = '

<table  border="1"   >
<tr>
      <td style="text-align:left;"><h3>REGISTRO: '.$nro_acta.'</h3></td> 
      <td   style="text-align:center;"><h3>ACTA DE DESCARTE <br>(Art. 223,224,225 del COPP)</h3></td> 
      <td style="text-align:center;"><h3>LCCT-DQ-FIE-014-5</h3></td> 
</tr> 
</table>

<table  border="1" style="text-align:center;"  >
<tr>
      <td style="text-align:center;">INSTITUCIÓN SOLICITANTE</td> 
      <td style="text-align:center;">UNIDAD ACTUANTE</td> 
      <td style="text-align:center;">DEPENDENCIA</td>  
</tr> 
<tr>
      <td style="text-align:center; font-size:9px">'.$des_institucion_solicitante.'</td> 
      <td style="text-align:center; font-size:9px">'.$des_unidad_solicitantente.'</td> 
      <td style="text-align:center; font-size:9px">'.$dependencia_unidad.'</td>  
</tr>
<tr> 
      <td>FECHA / NRO. OFICIO</td> 
      <td>EXPERTO DESIGNADO</td> 
      <td>FECHA DE REALIZACIÓN</td> 
</tr> 

<tr> 
      <td>'.$fecha_acta.' / '.$nro_oficio.'</td> 
      <td>'.$usuario->grado.' '.$usuario->last_name.' '.$usuario->first_name.'</td>  
      <td>'.$fecha_acta.'</td> 
</tr> 
</table>

<table  border="1" style="text-align:center;"  >
<tr  >
      <td>EMPRESA  / FUNCIONARIO /C.I: </td>  
      <td>EXPORTADOR / ALMACEN / DESTINO: </td>
</tr> 
  <tr  >
      <td>'.$empresa.'</td>  
      <td>'.$exportador.'</td>
</tr> 
 
</table>

 <table  border="1"> 
 <tr>
      <td>DESCRIPCIÓN GENERAL DE LA EVIDENCIA: '.$evidencia.'</td>  
</tr>
</table>
 
  
 


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
          <td style="border-top:solid black 1px;"><p>FIRMA DEL EXPERTO</p></td> 
        </tr>   
      </table>

    </td>

    <td>

    <table style="text-align:center;" border="0" cellspacing="0" cellpadding="">
      <tr> 
        <td>'.$jefe_nombre.'</td>
      </tr>
      <tr> 
        <td>C.I. '.$jefe_cedula.'</td> 
      </tr>
      <tr> 
        <td></td>
        <td></td>
      </tr>
      <tr> 
        <td style="border-top:solid black 1px;"><p>JEFE DE LA COMISIÓN <br> </p></td>
      </tr>   
    </table>

    </td>
  </tr>
</table>

 
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Reporte.pdf', 'I');
?>