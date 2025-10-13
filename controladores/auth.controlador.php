<?php
require_once './modelos/auth.model.php';
require_once './vistas/auth.vista.php';

class AuthController {
    private $modelo;
    private $vista;


    function __construct() {
        $this->modelo = new ModeloAuth();
        $this->vista = new VistaAuth();
    }

    public function showLogin($request) {
        $this->vista->mostrarLogin("", $request->user);
    }

    public function doLogin($request) {
        if(empty($_POST['usuario']) || empty($_POST['password'])) {
            return $this->vista->mostrarLogin("Faltan datos obligatorios", $request->user);
        }

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $userFromDB = $this->modelo->getByUser($usuario);


        //aca usar password verify
        if ($userFromDB && $password === $userFromDB->password) {
            $_SESSION['USER_ID'] = $userFromDB->id;
            $_SESSION['USER_NAME'] = $userFromDB->usuario;
            header("Location: ".BASE_URL."propiedades");
            return;
        } else {
            return $this->vista->mostrarLogin("Usuario o contraseña incorrecta", $request->usuario);
        }
    }
}    
