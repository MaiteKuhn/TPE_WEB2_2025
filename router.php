<?php
require_once './controladores/ControladorPropietario.php';
require_once './controladores/ModeloPropietario.php';
require_once './middleware/session.middleware.php';
require_once './middleware/guard.middleware.php';
session_start();




define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

$action = 'home';
$res = new Response();
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($params[0]) {
    case 'home':
        # code...
        break;
    case 'login':
        $controlador = new AuthController();
        $controlador->showLogin($request);
        break;
    case 'do_login':
        $controlador = new AuthController();
        $controlador->doLogin($request);
        break;
    case 'propiedades':
        $controlador = new ControladorPropiedades();
        $controlador->mostrarPropiedades($request);
        break;
    case 'agregarPropiedad':
        $request = (new GuardMiddleware())->run($request);
       $controlador = new ControladorPropiedades();
        $controlador->agregarPropiedad($request);
        break;
    case 'editarPropiedad':
        break;
    case 'eliminarPropiedad':
        $request = (new GuardMiddleware())->run($request);
        $controlador = new ControladorPropiedades();
        $request->id = $params[1];
        $controlador->eliminarPropiedad($request);
        break;

                
                


}