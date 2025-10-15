<?php
require_once './controladores/propietarios.controlador.php';
require_once './modelos/propietarios.model.php';
require_once './controladores/auth.controlador.php';
require_once './modelos/auth.model.php';
require_once './controladores/propiedades.controlador.php';
require_once './modelos/propiedades.model.php';
require_once './middleware/session.middleware.php';
require_once './middleware/guard.middleware.php';

session_start();
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controlador = new ControladorPropiedades();
        $controlador->mostrarPropiedades($request);
        break;
    case 'propietarios':
        $controladorPropietarios = new ControladorPropietario();
        $controladorPropietarios->mostrarPropietarios($request);
        break;
    case 'detallePropietario':
        $controladorPropietarios = new ControladorPropietario();
        $id = $params[1] ?? null;
        if ($id) {
            $controladorPropietarios->mostrarPropietarioPorId($id);
        } else {
            echo "Propietario no encontrado";
        }
        break;
    case 'login':
        $controlador = new AuthController();
        $controlador->showLogin($request);
        break;
    case 'do_login':
        $controlador = new AuthController();
        $controlador->doLogin($request);
        break;
    case 'logout':
        $controlador = new AuthController();
        $controlador->logout();
        break;
    case 'propiedades':
        $controlador = new ControladorPropiedades();
        $controlador->mostrarPropiedades($request);
        break;
    case 'detallePropiedad':
        $controlador = new ControladorPropiedades();
         $id = $params[1] ?? null;
        if ($id) {
            $controlador->mostrarPropiedadPorId($id);
        } else {
            echo "Propiedad no encontrada";
        }
        break;
    case 'agregarPropiedad':
        $request = (new GuardMiddleware())->run($request);
        $controlador = new ControladorPropiedades();
        $controlador->agregarPropiedad($request);
        break;
   case 'editarPropiedad':
        $request = (new GuardMiddleware())->run($request);
        $controlador = new ControladorPropiedades();
        $id = $params[1] ?? null;
        $controlador->editarPropiedad($id);
        break;
    case 'eliminarPropiedad':
        $request = (new GuardMiddleware())->run($request);
        $controlador = new ControladorPropiedades();
        $id = $params[1] ?? null;
        if ($id) {
            $controlador->eliminarPropiedad($id);
        } else {
            echo "ID de propiedad no proporcionado";
        }
        break;
    case 'agregarPropietario':
        $request = (new GuardMiddleware())->run($request); // solo usuarios logueados
        $controladorPropietarios = new ControladorPropietario();
        $controladorPropietarios->agregarPropietario();
        break;
    case 'editarPropietario':
        $request = (new GuardMiddleware())->run($request); // solo usuarios logueados
        $controladorPropietarios = new ControladorPropietario();
        $id = $params[1] ?? null;
        if ($id) {
            $controladorPropietarios->editarPropietario($id);
        } else {
            echo "Propietario no encontrado";
        }
        break;
    case 'eliminarPropietario':
        $request = (new GuardMiddleware())->run($request); // solo usuarios logueados
        $controladorPropietarios = new ControladorPropietario();
        $id = $params[1] ?? null;
        if ($id) {
            $controladorPropietarios->eliminarPropietario($id);
        } else {
            echo "Propietario no encontrado";
        }
        break;
    default:
            echo "Página no encontrada";
            break;
}