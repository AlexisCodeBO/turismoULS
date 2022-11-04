<?php
	include('Usuario.php');
	
	$usuario = new Usuario($_POST['ci'],$_POST['nombre'],$_POST['apPat'],$_POST['apMat'],$_POST['celular'],$_POST['correo'],$_POST['password'],$_POST['idTipo']);
	echo $usuario->insertar();
?>