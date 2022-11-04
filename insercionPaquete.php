<?php
	include('Paquete.php');
	$paquete = new Paquete($_POST['fechaSalida'],$_POST['fechaRetorno'],$_POST['precio'],$_POST['numeroPlazas'],$_POST['idPromocion'],$_POST['idSitio']);
	echo $paquete->insertar();
?>