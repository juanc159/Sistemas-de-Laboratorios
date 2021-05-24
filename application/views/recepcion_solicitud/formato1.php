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
          $this->Image($image_file2,10,12, 30,25);

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
          $this->Cell(20, 25, 'DIRECCIÓN', 0, 1, 'C');  
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
   
 
$html = <<<EOD
 
EOD;

 

 

$nro_acta=$this->uri->segment(3);
$datos=$this->acta_recepcion_model->buscar_acta('nro_acta',$nro_acta);
 

foreach($datos as $dato)
{
  $tipo_acta=$dato->tipo_acta;
    $id_unidad_solicitante=$dato->id_unidad_solicitante;
        $id_tipo_experticia=$dato->id_tipo_experticia;
        $id_exp_desig=$dato->id_exp_desig;
        
//UNIDAD SOLICITANTE
    $datos2=$this->acta_recepcion_model->buscar('div_inf_for.unidad_solicitante','id_unidad_solicitante',$id_unidad_solicitante);
    foreach($datos2 as $dato2)
        {
          $des_unidad_solicitantente=$dato2->des_unidad_solicitantente;
        }
    //EXPERTICIAS
    $datos3=$this->acta_recepcion_model->buscar('div_inf_for.tipo_experticia','id_tipo_experticia',$id_tipo_experticia);
    foreach($datos3 as $dato3)
        {
          $des_experticia=$dato3->des_experticia;
        }
        //EXPERTO DESIGNADO
    $datos4=$this->acta_recepcion_model->buscar('div_inf_for.experto_designado','id_exp_desig',$id_exp_desig);
    foreach($datos4 as $dato4)
        {
          $des_exp_desig=$dato4->des_exp_desig;
        }

            //EVIDENCIAS
            $fecha_acta=$dato->fecha_acta;
            $nro_oficio=$dato->nro_oficio;
            $fecha_oficio=$dato->fecha_oficio;



      //EVIDENCIAS
      $datos5=$this->acta_recepcion_model->buscar('div_inf_for.evidencia','nro_acta',$nro_acta);
      $i=0;
      foreach($datos5 as $dato5)
      {
            $des_evidencia[$i]=$dato5->des_evidencia;
            $i++;
      }

      //OBSERVACIONES
      $datos6=$this->acta_recepcion_model->buscar('div_inf_for.observaciones','nro_acta',$nro_acta);
      $i=0;
      foreach($datos6 as $dato6)
      {
            $des_observaciones[$i]=$dato6->des_observaciones;
            $i++;
      }

}

$html = '
<table style="text-align:center;" border="0"   >
<tr>
      <td><h3>RECEPCIÓN DE SOLICITUD</h3><p></p></td> 
</tr> 
</table>

<table  border="0"   >
<tr>
      <td style="text-align:left;">PROCEDENCIA:  </td> 
</tr> 
</table>


<table style="text-align:center;" border="1"   >
  <tr>
        <th  style="background-color:#B9B8C2;" colspan="8"><h3>OFICIO SOLICITUD</h3></th> 
  </tr> 
  <tr style="background-color:#B9B8C2;">
        <td colspan="4">IDENTIFICACIÓN </td> 
        <td colspan="4">RECEPCIÓN</td>  
  </tr> 
  <tr>
        <td colspan="2">NRO DE SOLICITUD </td> 
        <td>DIA</td> 
        <td>MES</td>
        <td>AÑO</td>
        <td>DIA</td>
        <td>MES</td>
        <td>AÑO</td> 
  </tr>
   <tr>
        <td colspan="2"> </td> 
        <td></td> 
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td> 
  </tr>
</table>

<p></p>

<table style="text-align:center;" border="1"   >
  <tr>
        <th  style="background-color:#B9B8C2;" colspan="17"><h3>TIPO DE EXPERTICIA</h3></th> 
  </tr> 
  <tr style="background-color:#B9B8C2;">
        <td colspan="5">FISICA </td> 
        <td colspan="5">QUIMICA</td>  
        <td colspan="3">BIOLOGIA </td> 
        <td colspan="4">INFORMATICA</td>  
  </tr> 
  <tr style="font-size: 5.9px;">
        <td>REC </td> 
        <td>DAC</td> 
        <td>VEH</td>
        <td>BALI</td>
        <td>GRAF</td> 
        
        <td>DES</td> 
        <td>BARRI</td> 
        <td>QUIMICO</td>
        <td>BOTA</td>
        <td>TOXIC</td> 
        
        <td >MICROB</td> 
        <td>ANTRO</td>  
        <td>BOTA</td> 
        
        <td>REC. TEC</td> 
        <td>EXT. INFO</td> 
        <td>VAC. CONT</td>
        <td>FIJ. FOTO</td> 
  </tr>
  <tr>
        <td></td> 
        <td></td> 
        <td></td>
        <td></td>
        <td></td> 
        
        <td></td> 
        <td></td> 
        <td></td>
        <td></td>
        <td></td> 
        
        <td></td> 
        <td></td>  
        <td></td> 
        
        <td></td> 
        <td></td> 
        <td></td>
        <td></td> 
  </tr>
  <tr style="text-align:left;">
        <td style="height: 35px;" colspan="5">OTRO:</td>  
        
        <td style="height: 35px;" colspan="5">OTRO:</td>
        
        <td style="height: 35px;" colspan="3">OTRO:</td>  
        
        <td style="height: 35px;" colspan="4">OTRO:</td>  
  </tr>
</table>
 
 <p></p>

<table  border="0"   >
<tr>
      <td>DESCRIPCION DE LAS MUESTRAS RECIBIDAS (EVIDENCIAS): </td> 
</tr> 
<tr>
      <td>
        <ol>
        ';


$i=0;
$j=1;
$evi2=''; 
foreach($datos5 as $dato5)
{
      $evi2=$evi2.'<li value='.$j.'>'.$des_evidencia[$i].'</li>';
      $i++;  $j++;  
}


$html=$html.$evi2.'</ol></td></tr>';
$html=$html.'


<tr>
      <td><p></p>NUMERO DE ACTA PROCESAL (CAUSA): </td> 
</tr>
<tr>
      <td>REPRESENTANTE DEL MINISTERIO PUBLICO QUE DIRIGE LA INVESTIGACION: </td> 
</tr>
<tr>
      <td>DATOS DEL (LOS) IMPUTADO (S): </td> 
</tr> 
</table>

<p></p>
<table style="text-align:center;" border="1"   >
<tr>
      <td>GRADO</td>
      <td>APELLIDOS Y NOMBRES</td>
      <td>CARGO</td>
      <td>NUMERO DE CEDULA</td> 
</tr> 
<tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td> 
</tr> 
<tr style="text-align:left;" >
      <td colspan="4">TELEFONOS: </td> 
</tr>
</table>

';


// SALIDA DEL CONTENIDO HTML
$pdf->writeHTML($html, true, false, true, false, '');


// coloca el puntero al final de la hoja
$pdf->lastPage();

//agrega una nueva hoja
$pdf->AddPage();

$html2='
<table style="text-align:center;" border="0"   >
<tr>
      <td><h3 style="text-decoration: underline;">AUTORIZACION DE LA EJECUCION DE LA EXPERTICIA</h3><p></p></td> 
</tr> 
</table>


<table style="text-align:center;" border="1"   >
  <tr>
    <td colspan="4">IDENTIFICACION DE LA AUTORIZACION DEL DIRECTOR</td> 
    <td colspan="2">GRADO / APELLIDOS Y NOMBRES</td> 
  </tr> 
  <tr>
    <td>DIA</td>
    <td>MES</td>
    <td>AÑO</td>
    <td>HORA</td> 
    <td colspan="2" rowspan="2"></td>
  </tr> 
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>  
  </tr>   
</table>
<p></p>

<table style="text-align:left;" border="0"   >
<tr>
      <td>EXPERTO ASIGNADO: </td> 
</tr> 
</table>

<p></p>

<table style="text-align:center;" border="0"   >
<tr>
      <td><h3 style="text-decoration: underline;">IDENTIFICACION DEL OFICIO DE LA REMISION DE LA EXPERTICIA</h3><p></p></td> 
</tr> 
</table>


<table style="text-align:center;" border="1"   >
  <tr>
    <td colspan="2">NUMERO</td> 
    <td colspan="4">FECHA - HORA</td> 
  </tr> 
  <tr>
    <td colspan="2" rowspan="2"> </td>
    <td>DIA</td>
    <td>MES</td>
    <td>AÑO</td>
    <td>HORA</td>  
  </tr> 
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>  
  </tr>   
</table>

<p></p>

<table style="text-align:center;" border="0"   >
<tr>
      <td><h3 style="text-decoration: underline;">ENTREGA DE RESULTADO DE LA EXPERTICIA A LA UNIDAD SOLICITANTE</h3><p></p></td> 
</tr> 
</table>

<table style="text-align:center;" border="1"   >
  <tr> 
    <td colspan="4">FECHA - HORA</td> 
    <td colspan="2">N° OFICIO DE SOLICITUD</td> 
  </tr> 
  <tr>
    <td>DIA</td>
    <td>MES</td>
    <td>AÑO</td>
    <td>HORA</td>  
    <td colspan="2" rowspan="2"> </td>
  </tr> 
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>  
  </tr>   
</table>


<p></p>
<table style="text-align:center;" border="1"   >
<tr>
      <td>GRADO</td>
      <td>APELLIDOS Y NOMBRES</td>
      <td>CARGO</td>
      <td>NUMERO DE CEDULA</td> 
</tr> 
<tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td> 
</tr> 
<tr style="text-align:left;" >
      <td colspan="4">TELEFONOS: </td> 
</tr>
</table>

<p></p>
<table  border="0"   >
<tr>
      <td style="text-align:left;">OBSERVACIONES:  </td> 
</tr> 
</table>



<p></p>
<table style="text-align:center;" border="0" cellspacing="3" cellpadding="4">

  <tr>
        <td>TTE. MORENO GUERRA JUAN CARLOS</td>
        <td>SM/2 NOUEL NOGUERA CESAR RAMON</td>
    </tr>
    <tr>
        <td>C.I. V- 20.123.335</td>
        <td>C.I. V- 15.558.012 <p>TELF: (0412) 3060835</p></td>
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
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Output('Reporte.pdf', 'I');
?>