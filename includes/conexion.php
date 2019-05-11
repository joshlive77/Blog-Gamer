<?php
// conexion a la base de datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "blog_master";

$db = mysqli_connect($servidor, $usuario, $contraseña, $basededatos);

// seteamos la base de datos para que se acepte español
mysqli_query($db, "SET NAMES 'utf8'");

// iniciar la sesion 

if (!isset($_SESSION)) {
    session_start();    
}