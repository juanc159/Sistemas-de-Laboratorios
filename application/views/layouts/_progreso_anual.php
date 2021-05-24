<?php
//agregar aqui en este arreglo el año o años que desee generar estadistica
$periodo = array('2021','2020','2019');





// NO TOCAR NADA DE AQUI ABAJO A MENOS QUE DESEE MODIFICAR LA MANERA DE VISUALIZAR LAS ESTADISTICAS O AGREGAR MAS ESTADISTICAS
?>
 



 <!-- /.PROGRESO ANUAL -->
              <div class="active tab-pane" id="progreso_anual">
                <div class="row"> 


<?php
foreach ($periodo as $key => $value) {
?>
                <div class="col-xs-6  ">

<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><strong><i class="fa  fa-file-pdf-o margin-r-5"></i> Actas Registradas <?php echo $value?></strong></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <?php
    $user = $this->ion_auth->user()->row(); 
      $fecha=0;

      $query1 = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where  tipo_acta='RECEPCION' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where tipo_acta='RECEPCION' AND id_usuario='$user->id' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado2=$query2->num_rows(); 
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>

      <div class="progress-group">
        <span class="progress-text">Recepción</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>


      <?php
      $calculo=0;
      $query1 = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where  tipo_acta='DEVOLUCION' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM div_inf_for.acta_recepcion where tipo_acta='DEVOLUCION' AND id_usuario='$user->id' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado2=$query2->num_rows(); 
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>
      <!-- /.progress-group -->
      <div class="progress-group">
        <span class="progress-text">Devolución</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>  

      <?php
      $calculo=0;
      $query1 = $this->db->query("SELECT * FROM quimica.acta_peritacion where  tipo_acta='PERITACION' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM quimica.acta_peritacion where tipo_acta='PERITACION' AND id_usuario='$user->id' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado2=$query2->num_rows(); 
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>

      <div class="progress-group">
        <span class="progress-text">Peritación</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>


      <?php
      $calculo=0;
      $query1 = $this->db->query("SELECT * FROM quimica.barrido where  fecha_barrido>='01-01-$value' AND fecha_barrido<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM quimica.barrido where id_usuario='$user->id' AND fecha_barrido>='01-01-$value' AND fecha_barrido<='31-12-$value'");  
      $resultado2=$query2->num_rows(); 
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>
      <!-- /.progress-group -->
      <div class="progress-group">
        <span class="progress-text">Barrido</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>  

      <?php
      $calculo=0;
      $query1 = $this->db->query("SELECT * FROM quimica.descarte where  tipo_acta='DESCARTE' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM quimica.descarte where tipo_acta='DESCARTE' AND id_usuario='$user->id' AND fecha_acta>='01-01-$value' AND fecha_acta<='31-12-$value'");  
      $resultado2=$query2->num_rows();    
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>

      <div class="progress-group">
        <span class="progress-text">Descarte</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>

      <?php
      $calculo=0;
      $query1 = $this->db->query("SELECT * FROM quimica.toxicologia where  fecha_tox>='01-01-$value' AND fecha_tox<='31-12-$value'");  
      $resultado1=$query1->num_rows();

      $query2 = $this->db->query("SELECT * FROM quimica.toxicologia where id_usuario='$user->id' AND fecha_tox>='01-01-$value' AND fecha_tox<='31-12-$value'");  
      $resultado2=$query2->num_rows(); 
      if ($resultado1!=0)
        $calculo=$resultado2*100/$resultado1;
    ?>

      <div class="progress-group">
        <span class="progress-text">Toxicología</span>
        <span class="progress-number"><b><?php echo $resultado2 ; ?></b>/<?php echo $resultado1 ; ?></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-black" style="<?php echo "width:".$calculo."%"; ?>"></div>
        </div>
      </div>


    <strong><i class="fa fa-file-text-o margin-r-5"></i> Nota</strong>

    <p>Porcentaje de Actas registradas por el usuario durante el año <?php echo $value?></p>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->  

<?php

}
?>




        </div><!-- FIN ROW 1 -->
                 

                 
              </div>
              <!-- /.tab-pane -->
              <!-- /.FIN PROGRESO ANUAL -->