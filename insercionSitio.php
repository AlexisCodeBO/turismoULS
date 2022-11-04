<?php
	include('Sitio.php');
	/*echo $_POST['nombre']; 
	echo $_POST['descripcion'];
	echo $_FILES['foto']['name'];*/
	$dir = 'img/'.$_FILES['foto']['name'];
	move_uploaded_file($_FILES['foto']['tmp_name'],$dir);
	$sitio = new Sitio($_POST['nombre'],$_POST['descripcion'],$dir);
	echo $sitio->insertar();
?>