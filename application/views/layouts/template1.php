<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>SLCCT-GNB</title>
    
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />

    <link href="<?php echo base_url()?>public/css/estilos.css" rel='stylesheet' type='text/css' media='all' />
    <script type="text/javascript" src="<?php echo base_url()?>public/js/funciones.js"></script>



     <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
 
    <link rel="icon" type="image/png" href="<?php echo base_url()?>public/images/slcct.png" />

 <link rel="stylesheet" href="<?php echo base_url()?>public/AdminLTE-2.4.18/dist/css/AdminLTE.min.css">

    <!--**********colores del template*****************
        para cambiar el menu de arriba
    amarrillo: yellow
    azul: blue
    rojo: red
    verde: green
    purpura: purple
    negro: black

    si desea cambiar el menu lateral  (-light) 
    **********fin colores del template*****************-->
    <?php
    $color="blue";
    ?>


    <!--******CONFIGURAR EL TIPO DE TEMPLATE QUE SE QUIERE*****************
    fixed: se queda inmoviles el menu superior y lateral  alñ mover el scrol
    layout-boxed:  se hace una caja el template
    sidebar-collapse: el menu lateral nace colapsado
    layout-top-nav: revisar el codigo de este tipo (por ahora se colapsa el diseño)

    ********** FIN CONFIGURAR EL TIPO DE TEMPLATE QUE SE QUIERE*****************-->
    <?php
    $config_template="sidebar-collapse fixed";
    ?>

 


    <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/dist/css/skins/skin-<?php echo $color ?>.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/plugins/iCheck/square/<?php echo $color ?>.css" rel="stylesheet" type="text/css" />

    <!-- DATA TABLES --> 
  <link href="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!--*************auxiliares*****************--> 

    
    

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>public/AdminLTE-2.4.18/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>        

    
<?php echo $this->layout->css; ?> 

<?php echo $this->layout->js; ?>
  
<!--**********fin auxiliares*****************--> 
</head>

<style type="text/css">
    #contenedor_carga{
        background-color: rgba(250,240,245,0.9);
        height: 100%;
        width: 100%;
        position: fixed;
        transition: all 1s ease;
        z-index: 100000; 
    }

    #carga{
        border: 15px solid #ccc;
        border-top-color: #F4266A;
        border-top-style: groove;
        height: 100px;
        width: 100px;
        border-radius: 100%;

        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        animation: girar 1.5s linear infinite
    }

    @keyframes girar{
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
<body class="skin-<?php echo $color.' '.$config_template?> sidebar-mini ">
    <!-- Site wrapper -->
    <div class="wrapper">
        <div id="contenedor_carga">
            <div id="carga">                
            </div>
        </div>
        <?php echo $content_for_layout; ?>
    </div> 

    <!-- AdminLTE App -->
     

    
    <script src="<?php echo base_url()?>public/AdminLTE-2.4.18/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>public/AdminLTE-2.4.18/dist/js/demo.js"></script>

    <script type="text/javascript">
        window.onload = function () {
            var contenedor = document.getElementById('contenedor_carga');
            contenedor.style.visibility = 'hidden';
            contenedor.style.opacity = '0';
        }

    </script>

    


</body>
</html>