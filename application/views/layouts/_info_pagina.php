<!-- para usar esta barra debe usar el codigo html abajo nombrado
	pero hay que aprender usarlo 
<button class="btn btn-default" data-toggle="control-sidebar">Toggle Right Sidebar</button>
-->

<!-- CONFIGURAR EL COLOR DE LA BARRA  
dark: negro
light: blanca

NOTA: SI DESEA OTRO COLOR O FONDO DEBE CONFIGURARSE EN UN CSS APARTE
-->
<?php
$color_barra_lateral="dark";
?>
<!--FIN  CONFIGURAR EL COLOR DE LA BARRA  -->


<!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-<?php echo $color_barra_lateral?>">
  <!-- Content of the sidebar goes here -->
  EN DESARROLLO

</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>

