  <!-- Left side column. contains the logo or sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu"> 


            <?php
            $group = array(4,5,6,7);
            if ($this->ion_auth->in_group($group) )
            { 
            ?>
            <!--LINK AL MODULO DE INFORMATICA FORENSE -->
            <li class="active">
              <a href="<?php echo base_url()?>acta_recepcion">
                <i class="glyphicon glyphicon-paperclip"></i> <span>ACTAS</span>
              </a>
            </li>
            <?php 
            }
            ?>


            <?php
            $group = array(3);
            if ($this->ion_auth->in_group($group) )
            { 
            ?>
            <!--LINK AL MODULO DE SECRETARIA -->
            <li class="active">
              <a href="<?php echo base_url()?>secretaria">
                <i class="fa fa-clipboard"></i> <span>SECRETARIA</span>
              </a>
            </li>
            <?php 
            }
            ?>


            <?php
            $group =array(4);
            if ($this->ion_auth->in_group($group) )
            { 
            ?>
            <!--LINK AL MODULO DE INFORMATICA FORENSE -->
            <li class="active">
              <a href="<?php echo base_url()?>acta_recepcion">
                <i class="fa fa-desktop"></i> <span>INFORMATICA FORENSE</span>
              </a>
            </li>
            <?php 
            }
            ?>


            <?php
            $group = array(5);
            if ($this->ion_auth->in_group($group) )
            { 
            ?>
            <!--LINK AL MODULO DE QUIMICA -->
            <li class="active">
              <a href="<?php echo base_url()?>quimica">
                <i class="fa fa-flask"></i> <span>QUÍMICA</span>
              </a>
            </li>
            <?php 
            }
            ?>


            <?php
            $group = array(6);
            if ($this->ion_auth->in_group($group) )
            { 
            ?>
            <!--LINK AL MODULO DE BIOLOGIA -->
            <li class="active">
              <a href="<?php echo base_url()?>acta_recepcion">
                <i class="fa fa-eyedropper"></i> <span>BIOLOGIA</span>
              </a>
            </li>
            <?php 
            }
            ?>


            <?php
            $group = array(7);
            if ($this->ion_auth->in_group($group))
            { 
            ?>
            <!--LINK AL MODULO DE FISICA -->
            <li class="active">
              <a href="<?php echo base_url()?>acta_recepcion">
                <i class="fa fa-cubes"></i> <span>FISICA</span>
              </a>
            </li>
             <?php 
            }
            ?>

            <?php
            $group = array(9);
            if ($this->ion_auth->in_group($group))
            { 
            ?>
            <!--LINK AL MODULO DE REPORTES -->
            <li class="active">
              <a href="<?php echo base_url()?>reportes">
                <i class="fa fa-bar-chart"></i> <span>REPORTE</span>
              </a>
            </li>
             <?php 
            }
            ?>


            <?php
            if ($this->ion_auth->is_admin())
            { 
            ?>
         <!--   LINK AL MODULO DE CONFIGURACIONES   --> 
            <li class="active">
              <a href="<?php echo base_url()?>configuracion">
                <i class="fa fa-cogs"></i> <span>CONFIGURACION</span>
              </a>
            </li>
             <?php 
            }
            ?>

 

          </ul><!-- /.sidebar-menu-->
        </section>
        <!-- /.sidebar -->
      </aside>

 