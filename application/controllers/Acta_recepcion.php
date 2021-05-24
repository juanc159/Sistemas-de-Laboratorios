<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acta_recepcion extends CI_Controller {

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



  public function pdf()
  {
    if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

    $this->load->view('acta_recepcion/v_report'); 
  }
 



  public function index()
  {
    if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
 
          $this->layout->view('index');         
        

  }

  public function registros()
  {
    if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));

        $fecha_ano=$this->uri->segment(3);

        $datos=$this->acta_recepcion_model->getActas('RECEPCION',$fecha_ano);
        $datos2=$this->acta_recepcion_model->getActas('DEVOLUCION',$fecha_ano);
        $this->layout->view('registros',compact("datos","datos2"));     
  }





  public function nuevo()
  {
    
    if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


      $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
      $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
      $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
      $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
      $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 
        
    
      $nro_acta=$this->input->post("nro_acta",true);

      //VALIDA SI EL FORMATO ES 1 ENTONCES MUESTRA PO PRIMERA VEZ EL FORMATO ESCRITO EN EL TEXTAREA SI ES CERO NO LO MUESTRA
            $this->session->set_userdata('formato', '1');
            $this->formato=$this->session->userdata('formato');
            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id;



    //VALIDA SI EL FORMATO ES 1 ENTONCES MUESTRA PO PRIMERA VEZ EL FORMATO ESCRITO EN EL TEXTAREA SI ES CERO NO LO MUESTRA
    $this->session->set_userdata('formato', '1');
    $this->formato=$this->session->userdata('formato');


    if($this->input->post())
    {
      $this->session->set_userdata('formato', '0');
      $this->formato=$this->session->userdata('formato');
      if ($this->form_validation->run("actas_dev_recep/validar"))
      {
        
        $this->session->set_userdata('formato', '0');
        $this->formato=$this->session->userdata('formato');
        $user = $this->ion_auth->user()->row(); //usuario logeado

        //calcular el numero de acta que viene, contando
              // todas las actas que existen
              $may=1;
              $tipo_acta=$this->input->post("tipo_acta",true);
              $fecha_ano=$this->uri->segment(3); 
              $datos=$this->acta_recepcion_model->contar_actas($tipo_acta,$fecha_ano);
              if ($datos) {
                  foreach($datos as $dato)
                  {
                      $nro_acta=$dato->nro_acta;
                      if ($nro_acta>=$may) {
                          $may=$nro_acta+1;
                      }
                  }
              }
              
              //proceso la imagen
              $tipo_acta=$this->input->post("tipo_acta",true);
              $nombre_carpeta='evidencia-'.$tipo_acta.'-'.$may.'-'.date('Y-m-d');
                   
              // Estructura de la carpeta deseada
              $estructura = 'uploads/fotos_evidencias/'.$nombre_carpeta.'/';
              //mkdir($estructura);
              if(!mkdir($estructura, 0777, true)) {
                die('Fallo al crear las carpetas...');
              } 

              $error=NULL;
              //valido la foto
              //if($this->input->post('foto_evidencia'))
              //{ 
                  $number_of_files = sizeof($_FILES['foto_evidencia']['tmp_name']);
                  $files = $_FILES['foto_evidencia'];
                  //for ($i=0; $i < $number_of_files; $i++) { 
                      //if ($_FILES['foto_evidencia']['error'][$i]!=0) {
                       // $this->form_validation->set_message('foto_evidencia','no se subio foto');
                       // return false;
                      //}
                 // }

                  

                  $config['upload_path'] = $estructura;
                  $config['allowed_types'] = 'jpg|png|jpeg|bmp|gif';

                  

                  for ($i=0; $i < $number_of_files; $i++) { 
                    $_FILES['foto_evidencia']['name'] = $files['name'][$i];
                    $_FILES['foto_evidencia']['type'] = $files['type'][$i];
                    $_FILES['foto_evidencia']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['foto_evidencia']['error'] = $files['error'][$i];
                    $_FILES['foto_evidencia']['size'] = $files['size'][$i];
    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('foto_evidencia')){

                    }
                  }
               // }

              //$config['max_size'] = 0; 
              //$config["overwrite"]=true;
              //$config['encrypt_name'] = false; 
              //$config['file_name'] = $nombre_file; 
              //$config['remove_spaces'] = true;
              //$this->load->library('upload', $config);

              //if ( ! $this->upload->do_upload('foto_evidencia'))
              //{
                 // $error = array('error' => $this->upload->display_errors());
                      //$this->session->set_flashdata('ControllerMessage', $error["error"]);
             // }
              //if($error==null)
              //{
              //    $ima = $this->upload->data();
               //   $file_name = $ima['file_name'];
              //}


              $nro_acta=$may; 
        $fecha_acta=date('d-m-y');
        $data = array(  
            'nro_acta' => $nro_acta, 
            'fecha_acta' => date('d-m-Y'), 
            'tipo_acta' => $this->input->post("tipo_acta",true), 
            'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true),
            'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),
            'dependencia_unidad' => $this->input->post("dependencia_unidad",true),
            'nro_expediente' => $this->input->post("nro_expediente",true),
            'nro_oficio' => $this->input->post("nro_oficio",true),
            'fecha_oficio' => $this->input->post("fecha_oficio",true),
            'id_tipo_experticia' => $this->input->post("id_tipo_experticia",true),  
            'informacion_acta' => $_POST['editor'],   
            'id_usuario' => $user->id,
            'cedula_jefe' => $this->input->post("cedula_jefe",true),
            'ape_nom_jefe' => $this->input->post("ape_nom_jefe",true),
            'cargo_jefe' => $this->input->post("cargo_jefe",true),
            'telefono_jefe' => $this->input->post("telefono_jefe",true)
        );

        $tipo_a=$this->input->post("tipo_acta",true);
        $guardar=$this->db->insert('div_inf_for.acta_recepcion', $data);
        $fecha_acta=date('Y-m-d'); 
        if($guardar)
        {
          $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>"); 
                                    redirect(base_url().'acta_recepcion/editar/'.$nro_acta.'/'.$tipo_a.'/'.$fecha_acta,  301);
        }else
        {
          $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'acta_recepcion',  301);
        }  
      }
    } 

    //muestra las unidaddes solicitantes agregadas
    $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
    $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();

    $user = $this->ion_auth->user()->row();  
    $id_grupo = 0;


    $user->groups=$this->ion_auth->get_users_groups($user->id)->result();
    foreach ($user->groups as $group){ 
      if ($group->id=='4' or $group->id=='5' or $group->id=='6' or $group->id=='7')
        $id_grupo=$group->id;
    } 



    $experticias=$this->acta_recepcion_model->mostrar_tipo_experticia($id_grupo);
    $this->layout->view('nuevo',compact("unidades_act","instituciones","experticias"));
  }


  public function editar()
    {
      if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 


        

      $nro_acta=$this->uri->segment(3);
      $tipo_a=$this->uri->segment(4);
      $fecha_a=$this->uri->segment(5);
       
      
      if($this->input->post())
      { 
        if ($this->form_validation->run("actas_dev_recep/validar"))
        {

        //proceso la imagen 
        $nombre_carpeta='evidencia-'.$tipo_a.'-'.$nro_acta.'-'.$fecha_a;
         // Estructura de la carpeta deseada 
         $estructura = base_url().'uploads/fotos_evidencias/'.$nombre_carpeta.'/';
         //if(!mkdir($estructura, 0777, true)) {
           //die('Fallo al crear las carpetas...');
         //}     

        $error=NULL;
        //valido la foto
        $files = $_FILES['foto_evidencia'];    
         //valido la foto
         //if($this->input->post('foto_evidencia'))
         //{ 
             $number_of_files = sizeof($_FILES['foto_evidencia']['tmp_name']);
             $files = $_FILES['foto_evidencia'];
             //for ($i=0; $i < $number_of_files; $i++) { 
                 //if ($_FILES['foto_evidencia']['error'][$i]!=0) {
                   //$this->form_validation->set_message('foto_evidencia','no se subio foto');
                   //return false;
                 //}
             //}

             

             $config['upload_path'] = $estructura;
             $config['allowed_types'] = 'jpg|png|jpeg|bmp|gif';

             

             for ($i=0; $i < $number_of_files; $i++) { 
               $_FILES['foto_evidencia']['name'] = $files['name'][$i];
               $_FILES['foto_evidencia']['type'] = $files['type'][$i];
               $_FILES['foto_evidencia']['tmp_name'] = $files['tmp_name'][$i];
               $_FILES['foto_evidencia']['error'] = $files['error'][$i];
               $_FILES['foto_evidencia']['size'] = $files['size'][$i];

               $this->load->library('upload', $config);
               $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('foto_evidencia')){

               }
             }
           //}


          $datos = array(    
              'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true),
              'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),
              'dependencia_unidad' => $this->input->post("dependencia_unidad",true),
          'nro_expediente' => $this->input->post("nro_expediente",true),
              'nro_oficio' => $this->input->post("nro_oficio",true),
              'fecha_oficio' => $this->input->post("fecha_oficio",true),
              'id_tipo_experticia' => $this->input->post("id_tipo_experticia",true),  
              'informacion_acta' => $_POST['editor'],  
              'cedula_jefe' => $this->input->post("cedula_jefe",true),
              'ape_nom_jefe' => $this->input->post("ape_nom_jefe",true),
              'cargo_jefe' => $this->input->post("cargo_jefe",true),
              'telefono_jefe' => $this->input->post("telefono_jefe",true)
          ); 

          $id_p=$this->uri->segment(3);
          $tipo_a=$this->uri->segment(4);
          $fecha_a=$this->uri->segment(5);
          $guardar=$this->acta_recepcion_model->modificar_acta_recepcion($id_p,$tipo_a,$fecha_a,$datos);  
          if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'acta_recepcion/editar/'.$id_p.'/'.$tipo_a.'/'.$fecha_a,  301); 
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'acta_recepcion',  301);
                    }  
          
      }
    }

 

      $nro_acta=$this->uri->segment(3);
      $tipo_a=$this->uri->segment(4);
      $fecha_a=$this->uri->segment(5);
      $datos=$this->acta_recepcion_model->buscar_acta('nro_acta',$nro_acta,'tipo_acta',$tipo_a,$fecha_a);



      //muestra las unidaddes solicitantes agregadas
      $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
      $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();


      $user = $this->ion_auth->user()->row();  
    $id_grupo = 0;


    $user->groups=$this->ion_auth->get_users_groups($user->id)->result();
    foreach ($user->groups as $group){ 
      if ($group->id=='4' or $group->id=='5' or $group->id=='6' or $group->id=='7')
        $id_grupo=$group->id;
    } 


      $experticias=$this->acta_recepcion_model->mostrar_tipo_experticia($id_grupo);


      $this->layout->view('editar',compact("datos","unidades_act","instituciones","experticias"));
    }








  public function eliminar()
    {
      if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $id_p=$this->uri->segment(3);

        $tipo_a=$this->uri->segment(4);

        $fecha_a=$this->uri->segment(5);
        $fecha_link=substr($fecha_a, 0,4);

        $eliminar=$this->acta_recepcion_model->eliminar_acta_recepcion($id_p,$tipo_a,$fecha_a); 
        redirect(base_url().'acta_recepcion/registros/'.$fecha_link,  301);
    }
}
