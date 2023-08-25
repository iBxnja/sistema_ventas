<?php

include_once "config.php";
include_once "entidades/usuario.php";

$usuario = new Usuario();
$usuario->usuario = "benja123";
$usuario->clave = password_hash("admin123", PASSWORD_DEFAULT);
$usuario->nombre = "benjamin";
$usuario->apellido = "";
$usuario->correo = "benjavallory@hotmail.com";
$usuario->insertar();

echo "Usuario insertado.";
?>