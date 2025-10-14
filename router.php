<?php
require_once './controladores/ControladorPropietario.php';
require_once './controladores/ModeloPropietario.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';
$res = new Response();
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        # code...
        break;
    case 'propietarios':
        $controladorPropietarios = new ControladorPropietario();
        $controladorPropietarios->mostrarPropietarios();
        break;
    case 'propiedadesPropietario':
        $controladorPropietarios = new ControladorPropietario();
        $controladorPropietarios->mostrarPropiedadesPropietario();
        break;
}