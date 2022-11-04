<?php
	include('Sitio.php');
	Sitio::eliminar($_GET['id']);
	header('Location:http://localhost/turismoULS/index.php');
?>