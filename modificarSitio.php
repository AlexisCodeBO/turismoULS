<?php
	include('Sitio.php');
	if ($_FILES['foto']['name']!='') {
		$dir = 'img/'.$_FILES['foto']['name'];
		move_uploaded_file($_FILES['foto']['tmp_name'],$dir);
	}
	else{
		$dir = $_POST['dir'];
	}
	$sitio = new Sitio($_POST['nombre'],$_POST['descripcion'],$dir,$_POST['id']);
	echo $sitio->modificar();
?>