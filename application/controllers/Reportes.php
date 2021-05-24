<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
 

        $this->lang->load('auth'); 
        $this->layout->setLayout('template1'); 

        $this->formato = $this->session->userdata('formato');

        //cuadro para mostrar los mensajes de error
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }


     public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->css(array(base_url()."public/modal/sweetalert2.min.css"));
        $this->layout->js(array(base_url()."public/modal/sweetalert2.min.js"));

        $this->layout->js(array(base_url()."public/Chart.js/Chart.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jquery-2.1.4.min.js"));

 
        
        $this->layout->view('index');       
          
    } 
    public function reporteTodo()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $datos_tipo_experticia=$this->acta_recepcion_model->mostrar_tipo_experticia(4);
        $this->layout->view('reporteTodo',compact('datos_tipo_experticia'));       
          
    } 


    public function nuevo_reporte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


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
                  'descripcion' => 'DEPARTAMENTO DE QUÍMICA'),
              array(  'id' => '2',
                  'nombre' => 'FISICA',
                  'descripcion' => 'DEPARTAMENTO DE FÍSICA'),
              array(  'id' => '3',
                  'nombre' => 'INFORMATICA',
                  'descripcion' => 'DEPARTAMENTO DE INFORMÁTICA'),
              array(  'id' => '4',
                  'nombre' => 'BIOLOGIA',
                  'descripcion' => 'DEPARTAMENTO DE BIOLOGÍA'),
              array(  'id' => '5',
                  'nombre' => 'COMISION',
                  'descripcion' => 'COMISIONES')

            );


            $exp= array(
               array('EXPERTICIA DE DROGAS','DESCARTES QUÍMICOS','TOXICOLOGÍA','TEXTILES','ALCOHOLIMETRÍA'),
              array('GRAFOTÉCNICA','RECONOCIMIENTO TÉCNICO','BALÉSTICA','DACTILOSCOPIA','VEHÍCULO','INSPECCIONES TÉCNICAS'),
              array('RECONOCIMIENTO TÉCNICO','EXTRACCIÓN DE CONTENIDO','COHERENCIA TECNICA','ANÁLISIS AUDIOVISUAL'),
              array('MICROBIOLOGÍA','BOTÁNICA','FISICOQUÍMICO','GENÉTICA FORENSE','ANTROPOLOGÍA FORENSE'),
              array('COMISIÓN')
            );

            $fecha_reporte=date('d-m-Y');
            if($this->input->post())
            {
                for ($j=0; $j < 10 ; $j++)
                {
                    $p=0;
                    $d=0;

                    foreach ($exp as $value)
                    {
                        $cexd=count($value);
                        $total=$p+$cexd;

                        for ($y=0; $y < $cexd; $y++)
                        {
                            $cant="dato_".$lab[$j]['numero']."_".$dep[$d]['nombre']."_".$y."";  
                            //echo $cant.' / ';
                            //exit;
                            $data = array(
                                'id_lab' => $lab[$j]['id'],
                                'fecha' => $fecha_reporte,
                                'id_dependencia' => $dep[$d]['id'],
                                'id_exp' => $y,
                                'cant' =>$this->input->post($cant,true)
                            );
                            $guardar=$this->db->insert('public.reporte', $data);
                        }
                        $d++;
                    }

                } 
                if($guardar)
                {
                  $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>"); 
                                            redirect(base_url().'reportes/editar_reporte/'.$fecha_reporte,  301);
                }else
                {
                  $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                               redirect(base_url().'reportes',  301);
                }  
            }


        $fecha_reporte=$this->uri->segment(3);
        $where = array(
            'fecha' => $fecha_reporte
        );
        $datos=$this->acta_recepcion_model->buscar('public.reporte',$where);
        //print_r($datos);
        //exit;

        
        if ($datos){
            redirect(base_url().'reportes/editar_reporte/'.$fecha_reporte,  301); 
        }
        else{
            $this->layout->view('nuevo_reporte');  
        }    
          
    } 


    public function editar_reporte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


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
                  'descripcion' => 'DEPARTAMENTO DE QUÍMICA'),
              array(  'id' => '2',
                  'nombre' => 'FISICA',
                  'descripcion' => 'DEPARTAMENTO DE FÍSICA'),
              array(  'id' => '3',
                  'nombre' => 'INFORMATICA',
                  'descripcion' => 'DEPARTAMENTO DE INFORMÁTICA'),
              array(  'id' => '4',
                  'nombre' => 'BIOLOGIA',
                  'descripcion' => 'DEPARTAMENTO DE BIOLOGÍA'),
              array(  'id' => '5',
                  'nombre' => 'COMISION',
                  'descripcion' => 'COMISIONES')

            );


            $exp= array(
               array('EXPERTICIA DE DROGAS','DESCARTES QUÍMICOS','TOXICOLOGÍA','TEXTILES','ALCOHOLIMETRÍA'),
              array('GRAFOTÉCNICA','RECONOCIMIENTO TÉCNICO','BALÉSTICA','DACTILOSCOPIA','VEHÍCULO','INSPECCIONES TÉCNICAS'),
              array('RECONOCIMIENTO TÉCNICO','EXTRACCIÓN DE CONTENIDO','COHERENCIA TECNICA','ANÁLISIS AUDIOVISUAL'),
              array('MICROBIOLOGÍA','BOTÁNICA','FISICOQUÍMICO','GENÉTICA FORENSE','ANTROPOLOGÍA FORENSE'),
              array('COMISIÓN')
            );

 
            $fecha_reporte=$this->uri->segment(3);
            if($this->input->post())
            {
                for ($j=0; $j < 10 ; $j++)
                {
                    $p=0;
                    $d=0;

                    foreach ($exp as $value)
                    {
                        $cexd=count($value);
                        $total=$p+$cexd;

                        for ($y=0; $y < $cexd; $y++)
                        {
                            $cant="dato_".$lab[$j]['numero']."_".$dep[$d]['nombre']."_".$y."";  
                            //echo $cant.' / ';
                            //exit;
                            $data = array( 
                                'cant' =>$this->input->post($cant,true)
                            ); 

                            $where=array(
                                'id_lab' => $lab[$j]['id'],
                                'fecha' => $fecha_reporte,
                                'id_dependencia' => $dep[$d]['id'],
                                'id_exp' => $y,
                                );
                            $this->db->where($where);
                            $guardar=$this->db->update('public.reporte', $data);  
                        }
                        $d++;
                    }

                } 
                if($guardar)
                {
                  $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>"); 
                                            redirect(base_url().'reportes/editar_reporte/'.$fecha_reporte,  301);
                }else
                {
                  $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                               redirect(base_url().'reportes',  301);
                }  
            }

        
        $this->layout->view('editar_reporte');       
          
    } 



    public function pdf_tabla()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
 

        $this->layout->view('pdf_tabla');       
          
    } 

    public function pdf_tabla_fechas()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
 

        $this->layout->view('pdf_tabla2');       
          
    } 



    public function pdf_grafica_barra()
    {

        $this->layout->js(array(base_url()."public/Chart.js/Chart.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jquery-2.1.4.min.js"));



        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
 
         if ($_POST) {
            $img2 = $_POST['base64_2'];
            //echo "<script>alert('$img2')</script>";
            $img2 = str_replace('data:image/png;base64,', '', $img2);

            $fileData2 = base64_decode($img2);

            $fileName2 = 'Grafica2.png'; 
 
            file_put_contents($fileName2,$fileData2); 
            
            //el archivo se crea en la carpeta raiz del sistema, asi que tenemos que moverlo a la carpeta que deseamos 
            //que se guarden las imagenes de las graficas
         

            rename($_SERVER['DOCUMENT_ROOT']."informatica3/Grafica2.png", $_SERVER['DOCUMENT_ROOT'].'informatica3/public/images/graficas_generadas/Grafica2.png');
         }
            
            

        $this->layout->view('pdf_grafica_barra');       
          
    } 


    public function pdf_grafica_torta()
    {

        $this->layout->js(array(base_url()."public/Chart.js/Chart.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jquery-2.1.4.min.js"));



        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
 
         if ($_POST) {
            $img = $_POST['base64']; 
            //echo "<script>alert('$img2')</script>";
            $img = str_replace('data:image/png;base64,', '', $img);

            $fileData = base64_decode($img);

            $fileName = 'Grafica1.png'; 
 
            file_put_contents($fileName,$fileData);  
            
            //el archivo se crea en la carpeta raiz del sistema, asi que tenemos que moverlo a la carpeta que deseamos 
            //que se guarden las imagenes de las graficas
            rename($_SERVER['DOCUMENT_ROOT']."informatica3/Grafica1.png", $_SERVER['DOCUMENT_ROOT'].'informatica3/public/images/graficas_generadas/Grafica1.png');

         } 
        $this->layout->view('pdf_grafica_torta');       
          
    } 


	
}
