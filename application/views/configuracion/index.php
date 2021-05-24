<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

 

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CONFIGURACIONES DEL SISTEMA
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
		<section class="content">
          <!-- Your Page Content Here -->
      <div class="box">
              <div class="box-header">
                  <h3 class="box-title">ELABORACION DE ACTAS</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <div class="row">
                  

                  <!-- USUARIOS --> 
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3><?php    echo $this->ion_auth->users()->num_rows();  ?></h3>
                        <p>USUARIOS</p>
                      </div>
                      <div class="icon">
                        <i class="fa  fa-users"></i>
                      </div>
                      <a href="<?php echo base_url()?>auth/" class="small-box-footer">
                        MAS INFORMACIÓN <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div><!-- ./col --> 

                  <!-- GRUPOS --> 
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3><?php 
                        $query = $this->db->query('SELECT * FROM groups'); 
                         echo $query->num_rows(); 
                        ?></h3>
                        <p>GRUPOS</p>
                      </div>
                      <div class="icon">
                        <i class="fa   fa-briefcase"></i>
                      </div>
                      <a href="<?php echo base_url()?>configuracion/grupos" class="small-box-footer">
                        MAS INFORMACIÓN <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div><!-- ./col --> 

                  <!-- INSTITUCIONES --> 
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3><?php
                        $query = $this->db->query('SELECT * FROM div_inf_for.institucion_solicitante'); 
                         echo $query->num_rows(); 
                         ?></h3>
                        <p>INSTITUCIONES</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-university"></i>
                      </div>
                      <a href="<?php echo base_url()?>configuracion/instituciones" class="small-box-footer">
                        MAS INFORMACIÓN <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div><!-- ./col -->

                  <!-- UNIDADES ACTUANTES --> 
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3><?php
                        $query = $this->db->query('SELECT * FROM div_inf_for.unidad_solicitante'); 
                         echo $query->num_rows(); 
                         ?></h3>
                        <p>UNIDADES ACTUANTES</p>
                      </div>
                      <div class="icon">
                        <i class="fa  fa-empire"></i>
                      </div>
                      <a href="<?php echo base_url()?>configuracion/unidades" class="small-box-footer">
                        MAS INFORMACIÓN <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div><!-- ./col -->


                  <!-- TIPO DE EXPERTICIAS --> 
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                      <div class="inner">
                        <h3><?php
                        $query = $this->db->query('SELECT * FROM div_inf_for.tipo_experticia'); 
                         echo $query->num_rows(); 
                         ?></h3>
                        <p>TIPO DE EXPERTICIAS</p>
                      </div>
                      <div class="icon">
                        <i class="fa  fa-empire"></i>
                      </div>
                      <a href="<?php echo base_url()?>configuracion/experticias" class="small-box-footer">
                        MAS INFORMACIÓN <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div><!-- ./col -->
 
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

 
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>