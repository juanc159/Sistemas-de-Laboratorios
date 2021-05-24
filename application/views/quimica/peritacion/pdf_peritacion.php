 
<?php 
class MYPDF extends TCPDF {

  public $acta_contenido="";
 

    //Page header
    public function Header() {



      if ($this->page==1)
      {
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
          $this->Cell(20, 25, 'DEPARTAMENTO DE QUÍMICA', 0, 1, 'C');  
      }
      else{
        //AGREGANDO MARGENES 
          $this->SetTopMargin(15);


          $html2 = '
          <table  border="1"   >
          <tr>
                <td style="text-align:left; font-size:10px"><h3>REGISTRO: '.$this->acta_contenido.'</h3></td> 
                <td style="text-align:center; font-size:8px"><h3>ACTA DE PERITACION <br>(Art. 223,224,225 del COPP)</h3></td> 
                <td style="text-align:center; font-size:8px"><h3>LCCT-DQ-FIE-014-1</h3></td> 
                <td style="text-align:right; font-size:10px"><h3>PAGINA '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</h3></td> 
          </tr> 
          </table>';

          $this->writeHTML($html2, true, false, true, false, '');

          //AGREGANDO MARGENES 
          $this->SetTopMargin(25);


        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => "");
        $style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => "");
          //BORDES PAGINA
          $this->Line(10, 15, 10, 265, $style); //IZQUIERDO
          $this->Line(206, 15, 206, 265, $style); //DERECHO
          $this->Line(10, 15, 206, 15, $style2); //ARRIBA
          $this->Line(10, 265, 206, 265, $style); //ABAJO


      }
          
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

//*************
ob_end_clean(); //rompimiento de pagina
//*************

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
 
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
 

$pdf->AddPage();
 // Set some content to print    
$pdf->SetFont('helvetica', 'B', 10); 

// set margins 



function cambiarFecha($fecha) {
  return implode("-", array_reverse(explode("-", $fecha)));
} 


$nro_acta=$this->uri->segment(3);
$pdf->acta_contenido=$nro_acta;
$fecha_ano=$this->uri->segment(4);
$where = array(
                'nro_acta' =>$nro_acta,
                'fecha_acta' =>$fecha_ano,
            );
$datos=$this->quimica_model->buscar_acta($where);

foreach($datos as $dato)
{

  //INSITUCION SOLICITANTE
  $id_institucion_solicitante=$dato->id_institucion_solicitante;
  $datos2=$this->acta_recepcion_model->buscar2('div_inf_for.institucion_solicitante','id_institucion_solicitante',$id_institucion_solicitante);
  foreach($datos2 as $dato2)
  {
    $des_institucion_solicitante=$dato2->des_institucion_solicitante;
  }

  //UNIDAD ACTUANTE
  $id_unidad_solicitante=$dato->id_unidad_solicitante;
  $datos2=$this->acta_recepcion_model->buscar2('div_inf_for.unidad_solicitante','id_unidad_solicitante',$id_unidad_solicitante);
  foreach($datos2 as $dato2)
  {
    $des_unidad_solicitantente=$dato2->des_unidad_solicitantente;
  }


  $dependencia_unidad=$dato->dependencia_unidad;

  // EL RESTO DE LA INFORMACION
  $fecha_oficio=$dato->fecha_oficio;
  $fecha_acta=$dato->fecha_acta;
  $nro_oficio=$dato->nro_oficio;
  $fecha_oficio=$dato->fecha_oficio;
  $tipo_acta=$dato->tipo_acta;
  $num_causa=$dato->num_causa;
  $num_expediente=$dato->num_expediente;
  $nombre_imputado=$dato->nombre_imputado;
  $cedula_imputado=$dato->cedula_imputado;
  $evidencia=$dato->evidencia;  
  $jefe_nombre=$dato->jefe_nombre; 
  $jefe_cedula=$dato->jefe_cedula; 
  $jefe_telf=$dato->telefono_jefe; 

  //usuario quien realizo el acta de peritacion
  $id_usuario=$dato->id_usuario;
  $usuario = $this->ion_auth->user($id_usuario)->row(); 
}


$html = '
<style type="text/css">
 
tr, td { 
  vertical-align: bottom;
}
</style>

<table  border="1"   >
<tr>
      <td style="text-align:left;"><h3>REGISTRO: '.$nro_acta.'</h3></td> 
      <td   style="text-align:center; font-size:8px"><h3>ACTA DE PERITACION <br>(Art. 223,224,225 del COPP)</h3></td> 
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
      <td style="font-size:8px;">'.$des_institucion_solicitante.' / '.$des_unidad_solicitantente.' / '.$dependencia_unidad.'</td> 
      <td style="font-size:8px;">'.cambiarFecha($fecha_oficio).' / '.$nro_oficio.'</td> 
      <td style="font-size:8px;">'.$usuario->grado.' '.$usuario->last_name.' '.$usuario->first_name.'</td> 
      <td style="font-size:8px;">'.cambiarFecha($fecha_acta).'</td> 
</tr> 
</table>

<table  border="1" style="text-align:center;"  >
<tr>
      <td>NRO. CAUSA / EXPEDIENTE</td> 
      <td>NOMBRE Y APELLIDO DE O LOS IMPUTADOS</td> 
      <td>N° CI DEL IMPUTADO</td>  
</tr> 
<tr>
      <td style="font-size:9px">'.$num_causa.' / '.$num_expediente.'</td> 
      <td style="font-size:9px">'.$nombre_imputado.'</td> 
      <td style="font-size:9px">'.$cedula_imputado.'</td>  
</tr> 
</table>

 <table  border="1">
<tr style="text-align:left;">
      <td>DESCRIPCION DE LA EVIDENCIA:</td>  
</tr> 
 
 <tr>
      <td >'.$evidencia.'</td>  
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
          <td style="border-top:solid black 1px;"><p>EXPERTO QUE RECIBE LA EVIDENCIA</p></td> 
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
        <td style="border-top:solid black 1px;"><p>JEFE DE LA COMISIÓN <br> '.$jefe_telf.'</p></td>
      </tr>   
    </table>

    </td>
  </tr>
</table>
';
 
$pdf->writeHTML($html, true, false, true, false, '');


$style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => "");

$pdf->setPage(1, true);
//BORDES PAGINA
$pdf->Line(10, 45, 10, 265, $style); //IZQUIERDO
$pdf->Line(206, 45, 206, 265, $style); //DERECHO
$pdf->Line(10, 265, 206, 265, $style); //ABAJO
 

 

$pdf->Output('Reporte.pdf', 'I');
?>