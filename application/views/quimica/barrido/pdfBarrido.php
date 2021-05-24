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
$pdf->SetFont('helvetica', 'B', 8); 

// set margins 

$nro_acta=$this->uri->segment(3);
$fecha_B=$this->uri->segment(4); 

$where_barrido = array(
        'nro_acta' => $nro_acta,
        'fecha_barrido' => $fecha_B,
        );
$datos=$this->acta_recepcion_model->buscar('quimica.barrido',$where_barrido);

foreach($datos as $dato)
{
  //DATOS

  $experto=$dato->experto;
  
  
  if ($experto!=0) { 
    $experto_datos = $this->ion_auth->user($experto)->row(); 
    $experto_info=' y '.$experto_datos->grado.' '.$experto_datos->last_name.' '.$experto_datos->first_name.', expertos adscritos ';
    $damos='Damos ';
  }
  else{
    $experto_info=', experto adscrito ';
    $damos='Doy ';
  }

  
  $quien_autoriza=$dato->quien_autoriza;
  $solicitante=$dato->solicitante;
  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;
  $fecha_oficio = date("d-m-Y", strtotime($fecha_oficio));

  

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
   
 
 
  $fecha_barrido=$dato->fecha_barrido;
  $fecha_barrido=date("d-m-Y", strtotime($fecha_barrido));

  $lugar=$dato->lugar;
  $ubicacion=$dato->ubicacion;
  $evidencia=$dato->evidencia;
  //usuario quien realizo el acta de peritacion
  $id_usuario=$dato->id_usuario;
  $usuario = $this->ion_auth->user($id_usuario)->row(); 




}

$jefe1="G/B. PEREZ GONZALEZ FRANK ERNESTO";
$jefe2="CNEL. MARIN GONZALEZ EDUARDO EMIRO";
$jefe_de="";

if ($jefe2==$quien_autoriza)
{
  $jefe_de="Director del Laboratorio Criminalistico N° 43";
}
if ($jefe1==$quien_autoriza)
{
  $jefe_de="Director del Sistema de Laboratorios Criminalisticos Cientificos y Tecnológicos";
}
 
$html = '

<table  border="1"   cellspacing="0" cellpadding="1" >
<tr>
      <td style="text-align:left;" ><h3>NUMERO REGISTRO: '.$nro_acta.'</h3></td> 
      <td   style="text-align:center;" ><h3>ACTA DE TOMA DE BARRIDO <br>(Art. 223,224,225 del COPP)</h3></td> 
      <td style="text-align:center;" ><h3>LCCT-DQ-FIE-014-4</h3></td> 
</tr> 
<tr>
      <td style="text-align:center;"><h3>INSTITUCIÓN SOLICITANTE</h3></td> 
      <td style="text-align:center;"><h3>UNIDAD ACTUANTE</h3></td> 
      <td style="text-align:center;"><h3>DEPENDENCIA</h3></td>  
</tr> 
<tr>
      <td style="text-align:center; font-size:9px">'.$des_institucion_solicitante.'</td> 
      <td style="text-align:center; font-size:9px">'.$des_unidad_solicitantente.'</td> 
      <td style="text-align:center; font-size:9px">'.$dependencia_unidad.'</td>  
</tr>
</table>

<table  border="0" cellspacing="5" cellpadding="0"   >
<tr>
      <td style="text-align:justify; font-size:10px " >Quien Suscribe: '.$usuario->grado.' '.$usuario->last_name.' '.$usuario->first_name.''.$experto_info.' a la División de Química, del Laboratorio Criminalistico N° 43. Cumpliendo instrucciones del ciudadano: '.$quien_autoriza.', '.$jefe_de.' de la Guardia Nacional Bolivariana, a solicitud realizada por el ciudadano: '.$solicitante.', mediante oficio de solicitud N° '.$nro_oficio.', de fecha '.$fecha_oficio.'. Siendo el dia '.$fecha_barrido.'; nos trasladamos a: '.$lugar.', ubicado en: '.$ubicacion.', con la finalidad  de realizar un barrido químico, a la evidencia que se describe a continuación: '.$evidencia.'</td>
</tr> 
</table>
   


<p></p>
<!–   un solo firmante experto  –>
' ; 
if ($experto==0)
{

$html =$html.'
<table style="text-align:center;" border="0" cellspacing="5" cellpadding="0">
  <tr>

    <td>

    </td>
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

    </td>
  </tr>
</table>';

} 


 
if ($experto!=0)
{ 
$html =$html.'
<!–   dos firmantes expertos  –>
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
        <td>'.$experto_datos->grado.' '.$experto_datos->last_name.' '.$experto_datos->first_name.'</td> 
      </tr>
      <tr> 
        <td>C.I. V- '.$experto_datos->cedula.'</td>  
      </tr>
      <tr> 
        <td></td>
        <td></td>
      </tr>
      <tr> 
        <td style="border-top:solid black 1px;"><p>FIRMA DEL EXPERTO<br></p></td>
      </tr>   
    </table>

    </td>
  </tr>
</table>'; 
}


$html =$html.'
<p></p>
<table style="text-align:center;" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td style="border-top:solid black 1px;"><p>FIRMA DEL TESTIGO</p></td> 

    <td style="border-top:solid black 1px;"><p>FIRMA DEL TESTIGO</p></td> 
  </tr>
</table>
';

$pdf->writeHTML($html, true, false, true, false, '');


$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => "black");

//BORDES PAGINA
$pdf->Line(10, 45, 10, 265, $style); //IZQUIERDO
$pdf->Line(206, 45, 206, 265, $style); //DERECHO
$pdf->Line(10, 265, 206, 265, $style); //ABAJO
 


/*
$pdf->Text(85, 165, '___________________________');
$pdf->Text(105, 170, 'FIRMA');


$pdf->Text(80, 180, 'C.I. NRO.');
$pdf->Text(95, 180, '_______________________');
*/

 
 



$pdf->Output('Reporte.pdf', 'I');
?>