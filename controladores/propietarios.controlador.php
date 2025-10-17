<?php
require_once './modelos/propietarios.model.php';
require_once './vistas/propietarios.vistas.php';

class ControladorPropietario {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new ModeloPropietario();
        $this->vista = new VistasPropietario(); 
    }

    public function mostrarPropietarios($request = null) {
        $propietarios = $this->modelo->obtenerPropietarios();
        $usuario = $request->user ?? null;
        $this->vista->mostrarPropietarios($propietarios, $usuario);
    }
    
    public function mostrarPropietarioPorId($id_propietario) {
        $propietario = $this->modelo->obtenerPropietarioPorId($id_propietario);
        if ($propietario) {
            $propiedades = $this->modelo->obtenerPropiedadesPorPropietario($id_propietario);
            $this->vista->mostrarPropietarioPorId($propietario, $propiedades);
        } else {
            $this->vista->mostrarError("No se encontró el propietario con ID $id_propietario");
        }
    }

    public function agregarPropietario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                $this->vista->mostrarError('Debe ingresar el nombre del propietario');
                return;
            }
            if (!isset($_POST['telefono']) || empty($_POST['telefono'])) {
                $this->vista->mostrarError('Debe ingresar un teléfono válido');
                return;
            }
            if (!isset($_POST['mail']) || empty($_POST['mail'])) {
                $this->vista->mostrarError('Debe ingresar un correo electrónico');
                return;
            }
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail']; 
            $this->modelo->agregarPropietario($nombre, $telefono, $mail);
            header('Location: ' . BASE_URL . 'propietarios');
            exit();
        } else {
            $this->vista->formularioAgregarPropietario();
        }
    }

    public function mostrarFormularioEditarPropietario($id_propietario) {
        $propietario = $this->modelo->obtenerPropietarioPorId($id_propietario);
        if ($propietario) {
            $this->vista->formularioEditarPropietario($propietario);
        } else {
            $this->vista->mostrarError("No se encontró el propietario a editar (ID $id_propietario)");
        }
    }

    public function editarPropietario($id_propietario) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                $this->vista->mostrarError('Debe ingresar el nombre del propietario');
                return;
            }
            if (!isset($_POST['telefono']) || empty($_POST['telefono'])) {
                $this->vista->mostrarError('Debe ingresar un teléfono válido');
                return;
            }
            if (!isset($_POST['mail']) || empty($_POST['mail'])) {
                $this->vista->mostrarError('Debe ingresar un correo electrónico');
                return;
            }
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $this->modelo->editarPropietario($id_propietario, $nombre, $telefono, $mail);
            header('Location: ' . BASE_URL . 'propietarios');
            exit();
        } else {
            $this->mostrarFormularioEditarPropietario($id_propietario);
        }
    }

    public function eliminarPropietario($id_propietario) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $totalPropiedades = $this->modelo->contarPropiedadesPorPropietario($id_propietario);
            if ($totalPropiedades == 0) {
                $this->modelo->eliminarPropietario($id_propietario);
                header('Location:' . BASE_URL . 'propietarios');
                exit();
            } else {
                $this->vista->mostrarError('No se puede eliminar el propietario porque tiene propiedades asociadas.');
            }
        } else {
            $this->vista->mostrarError("Acción inválida. No se pudo eliminar el propietario.");
        }
    }
}