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
$fecha_T=$this->uri->segment(4); 
$where = array(
    'nro_acta' =>$nro_acta,
    'fecha_tox' =>$fecha_T,
);
$datos=$this->quimica_model->buscar_toxicologico($where);

foreach($datos as $dato)
{
  //DATOS
  $experto=$dato->experto; 
  

  
  if ($experto!=0) { 
    $id_usuario2=$dato->experto;
    $usuario2 = $this->ion_auth->user($id_usuario2)->row(); 
    $experto=$usuario2->grado.' '.$usuario2->last_name.' '.$usuario2->first_name;
    $experto=' y '.$experto.', expertos adscritos ';
    $damos='Damos ';
  }
  else{
    $experto=', experto adscrito ';
    $damos='Doy ';
  }

  
  $quien_autoriza=$dato->quien_autoriza;
  $solicitante=$dato->solicitante;
  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;
  $fecha_oficio = date("d-m-Y", strtotime($fecha_oficio));


  $ciudadano=$dato->ciudadano;
  $nacio_ciu=$dato->nacio_ciu;
  $cedula_ciu=$dato->cedula_ciu;
  $domicilio_ciu=$dato->domicilio_ciu;
  $fecha_tox=$dato->fecha_tox;
  $hora_tox=$dato->hora_tox;


  //fecha y hora militar
  $dia = substr($fecha_tox, -2); 
  $mes_nro = substr($fecha_tox, 5,-3); 
  $ano = substr($fecha_tox, 2,-6);   
  $minutos = substr($hora_tox,3,-3); 
  $hora = substr($hora_tox, 0,-6); 


  $mes=['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];  
  $fecha_hora_militar=$dia.$hora.$minutos.$mes[$mes_nro-1].$ano; 
  
 

  $testigo=$dato->testigo;
  $marihuana=$dato->marihuana;
  $cocaina=$dato->cocaina;
  $opiaceos=$dato->opiaceos;

  if ($marihuana!=NULL) {
    $marihuana="POSITIVO";
  }
  else{
    $marihuana="NEGATIVO";
  }
  if ($cocaina!=NULL) {
    $cocaina="POSITIVO";
  }
  else{
    $cocaina="NEGATIVO";
  }
  if ($opiaceos!=NULL) {
    $opiaceos="POSITIVO";
  }
  else{
    $opiaceos="NEGATIVO";
  }


  //usuario quien realizo el acta de peritacion
  $id_usuario=$dato->id_usuario;
  $usuario = $this->ion_auth->user($id_usuario)->row(); 





}
 
 
$html = '

<table  border="1"   >
<tr>
      <td style="text-align:left;"><h3>NUMERO REGISTRO: '.$nro_acta.'</h3></td> 
      <td   style="text-align:center;"><h3>ACTA DE TOMA DE MUESTRA TOXICOLÓGICA <br>(Art. 153, 195 DEL C.O.P.P y Art. Núm. 3 de la C.R.B.V)</h3></td> 
      <td style="text-align:center;"><h3>LCCT-DQ-FIE-014-1</h3></td> 
</tr> 
</table>

<table  border="0"   >
<tr>
      <td style="text-align:justify; ">
      <p></p>
      Quien Suscribe: '.$usuario->grado.' '.$usuario->last_name.' '.$usuario->first_name.''.$experto.' a la División de Química, del Laboratorio Criminalístico Cientifico y Tecnológico N° 43, cumpliendo instrucciones del ciudadano: '.$quien_autoriza.', Director del Laboratorio Criminalistico Cientifico y Tecnológico N° 43 de la Guardia Nacional Bolivariana, a solicitud realizada por el ciudadano: '.$solicitante.', mediante oficio de solicitud N° '.$nro_oficio.', de fecha '.$fecha_oficio.', procedimos a la realización de análisis Quimico-Toxicológico a una muestra de orina colectada a la persona que más adelante se identifica. '.$damos.' fé del resultado obtenido de dicho análisis; y yo '.$ciudadano.' de nacionalidad '.$nacio_ciu.', portador de la cédula de identidad Nro. '.$cedula_ciu.', domiciliado en '.$domicilio_ciu.', hago constar que la muestra de orina, que fue colectada para el análisis químico toxicológico, es de mi procedencia y la misma fue tomada de manera voluntaria; de igual manera expreso, que no fui objeto de ningún maltrato físico, ni verbal. Dejo constancia de esto el día '.$fecha_hora_militar.'
      </td>
</tr> 
</table>
  
';

$pdf->writeHTML($html, true, false, true, false, '');


$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => "black");


$pdf->Text(10, 130, 'CONFORME:');
$pdf->Text(60, 140, 'P.I:');
$pdf->Text(160, 140, 'P.D:');


//BORDES PAGINA
$pdf->Line(10, 45, 10, 265, $style); //IZQUIERDO
$pdf->Line(206, 45, 206, 265, $style); //DERECHO
$pdf->Line(10, 265, 206, 265, $style); //ABAJO

//LINEA MEDIA BLANCA


//pulgar izquierda
$pdf->Line(45, 150, 45, 190, $style); //IZQUIERDO
$pdf->Line(80, 150, 80, 190, $style); //DERECHO
$pdf->Line(45, 150, 80, 150, $style); //ARRIBA
$pdf->Line(45, 190, 80, 190, $style); //ABAJO


//pulgar derecho
$pdf->Line(145, 150, 145, 190, $style); //IZQUIERDO
$pdf->Line(180, 150, 180, 190, $style); //DERECHO
$pdf->Line(145, 150, 180, 150, $style); //ARRIBA 
$pdf->Line(145, 190, 180, 190, $style); //ABAJO 



$pdf->Text(85, 165, '___________________________');
$pdf->Text(105, 170, 'FIRMA');


$pdf->Text(80, 180, 'C.I. NRO.');
$pdf->Text(95, 180, '_______________________');



//DATOS FINALES
$pdf->Text(10, 200, 'HORA DE LA COLECCIÓN DE LA MUESTRA: '.$hora_tox.'');
$pdf->Text(10, 210, 'TESTIGO: '.$testigo.'');
$pdf->Text(10, 220, 'RESULTADO(S): ');

$pdf->Text(10, 230, 'MARIHUANA: '.$marihuana.'        /        COCAINA: '.$cocaina.'        /        OPIÁCEOS: '.$opiaceos.'');



$pdf->Output('Reporte.pdf', 'I');
?>