<div class="container">
  <div class="img">
    <img src="<?php echo base_url()?>public/login/img/undraw_report_mx0a.svg">
	</div>
	<div class="login-content">
    <!-- Login Form -->
    <?php echo form_open("auth/login");?>
      <img src="<?php echo base_url()?>public/login/img/escudo.png">
      <img src="<?php echo base_url()?>public/login/img/slcct.png">
			<h2 class="title">SLCCT-GNB</h2>
      <div class="input-div one">
        <div class="i">
          <i class="fas fa-user"></i>
        </div>
        <div class="div">
          <h5>Email / Usuario</h5> 
          <?php echo form_input($identity);?>
        </div>
      </div>
      <div class="input-div pass">
        <div class="i"> 
          <i class="fas fa-lock"></i>
        </div>
        <div class="div">
          <h5>Contraseña</h5> 
          <?php echo form_input($password);?>
        </div>
      </div> 
      <input type="submit" class="btn" value="Ingresar"> 
    <?php echo form_close();?>
  </div>
</div>
 