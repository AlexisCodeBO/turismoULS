<?php
 include('Usuario.php');
 $arr = Usuario::seleccionarUsuarioMail($_POST['usuario']);
 
if (isset($_POST['usuario']) && isset($_POST['password']))
    {
        
    if (($_POST['usuario']==$arr[0]->getCorreo())&&(password_verify($_POST['password'],$arr[0]->getPassword())))
        {
        session_start();
        $_SESSION['usuario']=$arr[0]->getCorreo();
        $_SESSION['tipo']=$arr[0]->getTipo();
        $_SESSION['tiempo']=time();
        
        header('Location: http://localhost/turismoULS/index.php');
        }
    else
        header('Location: http://localhost/turismoULS/index.php');
 
    }
else
    {
        header('Location: http://localhost/turismoULS/index.php');
    }