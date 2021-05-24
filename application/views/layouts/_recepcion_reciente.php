<!-- /. ACTIVIDAD RECIENTE -->
              <div class=" tab-pane" id="recepcion_reciente">
                <!-- The timeline -->
                <?php
                  $fecha_servidor=date('d/m/Y');
                  $user = $this->ion_auth->user()->row();  
                  $query = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where tipo_acta='RECEPCION' AND id_usuario='$user->id' AND fecha_acta='$fecha_servidor'  order by fecha_acta desc, nro_acta desc");  
                  $resultado=$query->result();  
                ?>


                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <?php
                  //esto es para comparar las fechas de las actas registradas si se repiten pues solo se mostrara una sola vez
                  $comparar=0; 
                  foreach ($resultado as $key) {
                    if ($comparar!=$key->fecha_acta)
                    {
                      $comparar=$key->fecha_acta;
                    
                  ?>
                    <li class="time-label">
                          <span class="bg-red">
                            <?php  echo $comparar; ?>
                          </span>
                    </li>
                 <?php  
                    } 

                    $nro_acta=$key->nro_acta;
                        $tipo_acta='RECEPCION';
                        $fecha_a=substr($comparar, 0,4) ;
                        
                        $where = array(
                          'id_remision_q' => $nro_acta,
                          'tipo_acta' => $tipo_acta,
                          'remision_ano' => $fecha_a
                        );
                      $acta_remitida=$this->acta_recepcion_model->buscar('quimica.remision_dictamen',$where,false); 



                      $where = array(
                          'id_institucion_solicitante' => $key->id_institucion_solicitante
                        );
                      $des_institucion_solicitante=$this->acta_recepcion_model->buscar('div_inf_for.institucion_solicitante',$where,false);

                      $where = array(
                          'id_unidad_solicitante' => $key->id_unidad_solicitante
                        );
                      $des_unidad_solicitantente=$this->acta_recepcion_model->buscar('div_inf_for.unidad_solicitante',$where,false);

                      $where = array(
                          'id_tipo_experticia' => $key->id_tipo_experticia
                        );
                      $des_experticia=$this->acta_recepcion_model->buscar('div_inf_for.tipo_experticia',$where,false);




                        if ($acta_remitida!=null) {
                          $documento=base_url()."uploads/archivos_secretaria/".$acta_remitida->archivo_pdf;
                          $check_editar=1;
                          $titulo_pdf="VER DOCUMENTO";
                        }
                        else{
                          $documento=base_url()."acta_recepcion/pdf/".$key->nro_acta.'/'.$tipo_acta.'/'.$key->fecha_acta;
                          $check_editar=0;
                          $titulo_pdf="VER PDF";
                        }
 
                  ?>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-file-word-o bg-blue"></i>

                    <div class="timeline-item"> 

                      <h3 class="timeline-header"><a href="#">Numero de Registro: </a> <?php  echo $key->nro_acta; ?></h3>

                      <div class="timeline-body">
                        <div class="row">
                          <div class="col-md-12  ">
                            <table class="table  table-bordered table-striped  " border="3">
                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><strong>TIPO DE ACTA </strong></td>
                                <td><strong>INSTITUCION SOLICITANTE </strong></td>
                                <td><strong>UNIDAD ACTUANTE </strong></td>
                                <td><strong>DEPENDENCIA </strong></td>
                              </tr>
                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><?php  echo $key->tipo_acta; ?>  </td> 
                                <td><?php  echo $des_institucion_solicitante->des_institucion_solicitante; ?>  </td> 
                                <td><?php  echo $des_unidad_solicitantente->des_unidad_solicitantente; ?>  </td> 
                                <td><?php  echo $key->dependencia_unidad; ?>  </td>
                              </tr>

                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><strong>NUMERO DE OFICIO </strong></td>
                                <td><strong>FECHA OFICIO </strong></td> 
                                <td><strong>NRO DE EXPEDIENTE </strong></td>
                                <td><strong>TIPO DE EXPERTICIA </strong></td>
                              </tr>
                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><?php  echo $key->nro_oficio; ?>  </td> 
                                <td><?php  echo $key->fecha_oficio; ?>  </td>  
                                <td><?php  echo $key->nro_expediente; ?>  </td>
                                <td><?php  echo $des_experticia->des_experticia;; ?>  </td> 
                              </tr> 
                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><strong>CEDULA DE IDENTIDAD </strong></td>
                                <td ><strong>APELLIDOS Y NOMBRES  </strong></td>
                                <td><strong>CARGO  </strong></td> 
                                <td><strong>TELEFONO  </strong></td> 
                              </tr>
                              <tr style='text-align: center; vertical-align: middle;'>
                                <td><?php  echo $key->cedula_jefe; ?>  </td> 
                                <td><?php echo  $key->ape_nom_jefe; ?>  </td> 
                                <td><?php echo  $key->cargo_jefe; ?>  </td> 
                                <td><?php  echo $key->telefono_jefe; ?>  </td>  
                              </tr>

                            </table>
                            
                          </div>  
                        </div> 
                        
                        
                      </div>
                      <div class="timeline-footer">
                      <?php if($check_editar==0){ ?> 
                        <a   class="btn btn-primary btn-xs" href="<?php echo base_url().'acta_recepcion/editar/'.$key->nro_acta.'/'.$key->tipo_acta.'/'.$key->fecha_acta ?>"> <i class="fa fa-edit"></i>EDITAR</a> 
                      <?php } ?>
                        <a class="btn btn-danger btn-xs" target="v"  href="<?php echo $documento ?>"><i class="fa fa-file-pdf-o "></i> <?php echo $titulo_pdf; ?></a>
                      </div>
                    </div>
                  </li>
                   <?php  
                  } 
                  ?>
                  <!-- END timeline item -->
                   
                  <li> 
                    <i class="fa fa-clock-o bg-gray"></i>
                    <div class="timeline-item"> 
                      <?php if(!$resultado){ ?> 
                        <h3 class="timeline-header">No se ha realizado ninguna actividad reciente en el area de Recepción </h3>
                      <?php } ?> 
                    </div>

                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <!-- /.FIN ACTIVIDAD RECIENTE -->