<div class="wrapper fadeInDown">
  <div id="formContent"> 

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?php echo base_url()?>public/images/slct.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="<?php echo base_url()?>login"  method="post">
      <input type="text" id="campousuario" class="fadeIn second" name="campousuario" placeholder="Usuario">
      <input type="password" id="campoclave" name="campoclave" class="fadeIn third" placeholder="Contraseña">
      <input type="submit" class="fadeIn fourth" value="ENTRAR">
    </form>
  </div>
</div>    

