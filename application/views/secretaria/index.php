<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php
//agregar aqui en este arreglo el año o años que desee generar reporte
$periodo = array('2021','2020');



// NO TOCAR NADA DE AQUI ABAJO A MENOS QUE DESEE MODIFICAR 
?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SECRETARIA
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->

          <?php
for ($i=0; $i < count($periodo) ; $i++) { 
?>

			<div class="box">
            	<div class="box-header">
                	<h3 class="box-title">ACTAS <?php echo $periodo[$i] ?>
                  <?php
                    $date = date('Y');
                    if($date==$periodo[$i])
                    {
                    ?>
                      <a class="btn btn-danger btn-xs">NUEVO</a>
                    <?php
                    }
                  ?>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                <!-- ACTAS DE RECEPCION --> 
                <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              
	              <div class="small-box bg-aqua">
	              	
	                <div class="inner">
	                  <h3>RECEPCIÓN</h3>
	                  <p> SOLICITUDES <?php echo $periodo[$i] ?> </p>
	                </div>
	                <a href="<?php echo base_url()?>secretaria/remision/RECEPCION/".$periodo[$i] >
		                <div class="icon">
		                  <i class="fa  fa-file-word-o"></i>
		                </div> 
		                <a href="<?php echo base_url().'secretaria/remision/RECEPCION/'.$periodo[$i] ?>" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
	            	</a>
	                
	              </div>
	            </div><!-- ./col -->  

              <!-- ACTAS DE PERITACION --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>PERITACIÓN</h3>
                    <p>SOLITITUDES <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision/PERITACION/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url().'secretaria/remision/PERITACION/'.$periodo[$i] ?>" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  


              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>DICTÁMENES</h3>
                    <p>ENTREGADOS <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/dictamenes_entregados/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url().'secretaria/dictamenes_entregados/'.$periodo[$i] ?>"  class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  

 


            <!-- ACTAS DE DESCARTES --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>DESCARTES</h3>
                    <p> EN ESPERA <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision_descarte/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url().'secretaria/remision_descarte/'.$periodo[$i] ?>"   class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->



            <!-- ACTAS DE toxicologico --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>TOXICOLÓGICOS</h3>
                    <p> EN ESPERA <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision_toxicologico/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url().'secretaria/remision_toxicologico/'.$periodo[$i] ?>" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->




            <!-- ACTAS DE devolcucion y recepcion --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>DEVOLUCIÓN</h3>
                    <p> EN ESPERA <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision_recep_devol/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 

                    <a href="<?php echo base_url().'secretaria/remision_recep_devol/'.$periodo[$i] ?>" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->


               <!-- ACTAS DE devolcucion y recepcion --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>BARRIDOS</h3>
                    <p> EN ESPERA <?php echo $periodo[$i] ?></p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision_barrido/".$periodo[$i] >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div>  
                    <a href="<?php echo base_url().'secretaria/remision_barrido/'.$periodo[$i] ?>"  class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->




                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <?php
              }
              ?> 

              
             <!-- Your Page Content Here -->
      <div class="box">
              <div class="box-header">
                  <h3 class="box-title">ACTAS 2019</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <!-- ACTAS DE RECEPCION --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>RECEPCIÓN</h3>
                    <p>SOLICITUDES 2019</p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision/RECEPCION/2019" >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url()?>secretaria/remision/RECEPCION/2019" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  

              <!-- ACTAS DE PERITACION --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>PERITACIÓN</h3>
                    <p>SOLITITUDES 2019</p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision/PERITACION/2019" >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url()?>secretaria/remision/PERITACION/2019" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  


              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>DICTÁMENES</h3>
                    <p>ENTREGADOS 2019</p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/dictamenes_entregados/2019" >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url()?>secretaria/dictamenes_entregados/2019" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  

 
  
 




            <!-- ACTAS DE devolcucion y recepcion --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3>DEVOLUCIÓN</h3>
                    <p> 2019</p>
                  </div>
                  <a href="<?php echo base_url()?>secretaria/remision_recep_devol/2019" >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url()?>secretaria/remision_recep_devol/2019" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->




                </div><!-- /.box-body -->
            </div><!-- /.box -->

 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>