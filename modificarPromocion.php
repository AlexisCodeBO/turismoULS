<?php
	include('Promocion.php');
	$prom = new Promocion($_POST['temporada'],$_POST['porcentaje'],$_POST['id']);
	echo $prom->actualizar();
?>