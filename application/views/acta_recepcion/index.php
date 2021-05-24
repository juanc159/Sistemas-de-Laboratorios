<?php $this->load->view('layouts/_header') ?>
<?php $this->load->view('layouts/_menu_principal') ?>

<?php
//agregar aqui en este arreglo el año o años que desee generar reporte
$periodo = array('2019','2020','2021');



// NO TOCAR NADA DE AQUI ABAJO A MENOS QUE DESEE MODIFICAR 
?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ACTAS
            <small>DEMO</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
      <div class="box">
              <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">


<?php
for ($i=0; $i < count($periodo) ; $i++) { 
?>
                <!-- ACTAS DE RECEPCION --> 
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3><?php echo $periodo[$i]?></h3>
                    <p> </p>
                  </div>
                  <a href="<?php echo base_url().'acta_recepcion/registros/'.$periodo[$i]?>" >
                    <div class="icon">
                      <i class="fa  fa-file-word-o"></i>
                    </div> 
                    <a href="<?php echo base_url().'acta_recepcion/registros/'.$periodo[$i] ?>" class="small-box-footer"> Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                </a>
                  
                </div>
              </div><!-- ./col -->  

              <?php
              }
              ?>   
 




                </div><!-- /.box-body -->
            </div><!-- /.box -->

 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<?php $this->load->view('layouts/_footer') ?>