<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>


<?php
//agregar aqui en este arreglo el año o años que desee generar reporte
$periodo = array('2021','2020','2019');



// NO TOCAR NADA DE AQUI ABAJO A MENOS QUE DESEE MODIFICAR
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DEPARTAMENTO DE QUÍMICA
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

		<?php
		for ($i=0; $i < count($periodo) ; $i++) { 
		?>
          <!-- Your Page Content Here -->
			<div class="box">
            	<div class="box-header">
                	<h3 class="box-title">ELABORACION DE ACTAS <?php echo $periodo[$i]?>
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
                	<!-- ACTAS DE PERITACION --> 
                <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-aqua">
	                <div class="inner">
	                  <h2>PERITACIÓN <?php echo $periodo[$i]?></h2> 
	                </div>
	                <a href="<?php echo base_url().'quimica/peritacion/'.$periodo[$i]?>" >
	                <div class="icon">
	                  <i class="fa  fa-file-word-o"></i>
	                </div>
	                <a href="<?php echo base_url().'quimica/peritacion/'.$periodo[$i]?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	            </a>
	              </div>
	            </div><!-- ./col -->  

	            <!-- ACTAS DE BARRIDO --> 
                <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-aqua">
	                <div class="inner">
	                  <h2>BARRIDO <?php echo $periodo[$i]?></h2> 
	                </div>
	                <a href="<?php echo base_url().'quimica/barrido/'.$periodo[$i]?>" >
	                <div class="icon">
	                  <i class="fa  fa-file-word-o"></i>
	                </div>
	                <a href="<?php echo base_url().'quimica/barrido/'.$periodo[$i]?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	            </a>
	              </div>
	            </div><!-- ./col -->  
 

	            <!-- ACTAS DE DESCARTE --> 
                <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-aqua">
	                <div class="inner">
	                  <h2>DESCARTES <?php echo $periodo[$i]?></h2> 
	                </div>
	                <a href="<?php echo base_url().'quimica/descarte/'.$periodo[$i]?>" >
	                <div class="icon">
	                  <i class="fa  fa-file-word-o"></i>
	                </div>
	                <a href="<?php echo base_url().'quimica/descarte/'.$periodo[$i]?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	            </a>
	              </div>
	            </div><!-- ./col -->  

	            <!-- ACTAS DE TOMA DE MUESTRA TOXICOLOGICA --> 
                <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-aqua">
	                <div class="inner">
	                  <h2>TOXICOLOGÍA <?php echo $periodo[$i]?></h2> 
	                </div>
	                <a href="<?php echo base_url().'quimica/toxicologico/'.$periodo[$i]?>" >
	                <div class="icon">
	                  <i class="fa  fa-file-word-o"></i>
	                </div>
	                <a href="<?php echo base_url().'quimica/toxicologico/'.$periodo[$i]?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	            </a>
	              </div>
	            </div><!-- ./col -->  
 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
			<?php
              }
              ?> 

 

 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>