<?php



$conexion = pg_connect("host=192.168.33.10 dbname=bd_slcctgnb_produccion user=u_slcct password=admin");

$hojas = array(174);

for ($i=0; $i < count($hojas); $i++) { 

  $sql= "UPDATE quimica.remision_dictamen SET fecha_entrega='2021-03-25', hora_entrega='13:00', nombre_entrega='KIMBERLY VALESKA VELIZ', cargo_entrega='FISCAL 156', ced_entrega='18529700', telf_entrega='0424-956591', obs_remision='SE ENTREGO SIN NOVEDAD',  status_remi='3' WHERE remision_ano='2021' and tipo_acta='PERITACION' AND id_remision_q='$hojas[$i]';";


  $consulta = pg_query($conexion, $sql);
}

?>