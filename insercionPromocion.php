<?php
	include('Promocion.php');
	$promocion = new Promocion($_POST['temporada'],$_POST['porcentaje']);
	echo $promocion->insertar();
?>