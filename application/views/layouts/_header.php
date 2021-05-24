<!-- Main Header -->
<header class="main-header">
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-header">
      <a href="<?php echo base_url()?>principal" class="navbar-brand"><b>Laboratorio Criminalistico Nro.</b> 43</a> 
    </div>
    <!-- Collect the nav links, forms, and other content for toggling  
    <div class="collapse navbar-collapse pull-left" id="navbar-collapse"> 
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control busca" id="navbar-search-input" name="navbar-search-input" placeholder="Buscar...">
        </div>
      </form>
    </div>-->
    <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">  
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="<?php echo base_url()?>principal"   >
              <!-- The user image in the navbar-->
            <img src="<?php echo base_url()?>public/images/user.png" class="user-image" alt="User Image" />
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">
              <?php
              $user = $this->ion_auth->user()->row();
                echo $user->grado.' '.$user->last_name.' '.$user->first_name; 
              ?>
            </span>
          </a>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
            <a href="<?php echo base_url() ?>auth/logout">DESCONECTAR </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
 