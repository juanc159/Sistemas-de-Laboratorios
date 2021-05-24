<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>  


<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pagina Princial
            <small>DEMO</small>
          </h1>
        </section>

      <!-- Main content -->
      <section class="content">
        <?php
          $user = $this->ion_auth->user()->row(); 
        ?> 
        <div class="row">
          <div class="col-md-4  col-lg-4">
            <!-- PERFIL DE USUARIO -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>public/images/user.png" alt="User profile picture">
                <h3 class="profile-username text-center"><?php echo $user->grado.' '.$user->last_name.' '.$user->first_name?></h3>
                <p class="text-muted text-center"><?php echo $user->cedula?></p>
                <a href="<?php echo base_url().'auth/edit_user/'.$user->id ?>" class="btn btn-primary btn-block"><b>Editar Información</b></a>
              </div>
              <!-- /.box-body -->
              <div class="box-header with-border">
                <h3 class="box-title"><strong><i class="fa fa-book margin-r-5"></i> Información Personal</strong></h3>
              </div>
              <!-- /.box-header -->

              <div class="box-body">
                <strong><i class="fa fa-envelope-o margin-r-5"></i> Correo Electrónico: </strong>
                <p class="text-muted"><?php echo $user->email?></p>
                  <hr>
                  <strong><i class="fa fa-phone margin-r-5"></i> Telefono: </strong>
                  <p class="text-muted"><?php echo $user->phone?></p>
                  <hr>
                  <strong><i class="fa fa-users margin-r-5"></i> Grupo: </strong>
                   
                    <?php 
                      $user->groups=$this->ion_auth->get_users_groups($user->id)->result();
                      foreach ($user->groups as $group):?> 
                        <li class="list-group-item">
                          <?php echo "<p class='text-muted'>".$group->description."</p>"; ?> 
                        </li>
                    <?php endforeach?> 
                  <hr> 
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- FIN PERFIL DE USUARIO -->
          </div>



        <!-- /.col -->
        <div class="col-md-8 col-lg-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <?php
                $group = array(5);
                if ($this->ion_auth->in_group($group) )
                { 
              ?>
              <li>
                <a href="#peritacion_reciente" data-toggle="tab"> Peritación Reciente  &nbsp;
                  <?php
                        $fecha_servidor=date('d/m/Y');
                        $user = $this->ion_auth->user()->row();  
                        $query = $this->db->query("SELECT * FROM quimica.acta_peritacion where tipo_acta='PERITACION' AND id_usuario='$user->id' AND fecha_acta='$fecha_servidor'");  
                        $resultado=$query->num_rows();
                        if (!$resultado)
                          $bg_color='bg-red';
                        else
                          $bg_color='bg-green'; 
                      ?>

                  <span class="pull-right-container">
                    <span class="label <?php echo $bg_color; ?>     pull-right" style="font-size: 14px;"> 
                    <?php echo $resultado; ?>                       
                      </span>
                  </span>
                </a>
              </li>
              <?php 
                }
              ?>
              <?php
                $group = array(4,5,6,7);
                if ($this->ion_auth->in_group($group) )
                { 
              ?>
              <li >
                <a href="#recepcion_reciente" data-toggle="tab">Recepción Reciente &nbsp;
                  <?php
                          $fecha_servidor=date('d/m/Y');
                          $user = $this->ion_auth->user()->row();  
                          $query = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where tipo_acta='RECEPCION' AND id_usuario='$user->id' AND fecha_acta='$fecha_servidor'");  
                          $resultado=$query->num_rows();; 
                          if (!$resultado)
                            $bg_color='bg-red';
                          else
                            $bg_color='bg-green';
                        ?>

                  <span class="pull-right-container">
                      <span class="label <?php echo $bg_color; ?> pull-right" style="font-size:14px;">
                        <?php echo $resultado; ?>       
                          
                        </span>
                    </span>
                  </a>
              </li> 
              <li class="active"><a href="#progreso_anual" data-toggle="tab">Progreso Anual</a></li> 
              <?php 
                }
              ?>
            </ul>
            <div class="tab-content">  
              <?php
                $group = array(4,5,6,7);
                if ($this->ion_auth->in_group($group) )
                { 
                  $this->load->view('layouts/_recepcion_reciente');
                  $this->load->view('layouts/_progreso_anual');
                }
                // solo puede ver y acceder el departamento de quimica
                $group = array(5);
                if ($this->ion_auth->in_group($group) )
                {
                  $this->load->view('layouts/_peritacion_reciente');
                }
                
              ?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->  



        </div><!-- FIN ROW 1 -->


      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<?php $this->load->view('layouts/_footer') ?>

