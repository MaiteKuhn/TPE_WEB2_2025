<?php
require_once './modelos/ModeloPropietario.php';
require_once './vistas/VistaPropietario.php';

class ControladorPropietario {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new ModeloPropietario();
        $this->vista = new VistaPropietario(); 
    }

    public function mostrarPropietarios() {
        $propietarios = $this->modelo->obtenerPropietarios();
        $this->vista->mostrarPropietarios($propietarios);
    }

    public function mostrarPropiedadesPropietario($id_propietario){//de uno especifico
        $propiedades = $this->modelo->obtenerPropiedadesPorPropietario($id_propietario);
        $propietario = $this->modelo->obtenerPropietarioPorId($id_propietario);
        $this->vista->mostrarPropiedadesPorPropietario($propietario, $propiedades);
    }

    public function agregarPropietario() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $this->modelo->agregarPropietario($nombre, $telefono,$mail);
            header('Location: ' . BASE_URL . 'propietarios');
            exit();
        } else {
            $this->vista->mostrarFormularioAgregarPropietario();
        }
    }

    public function mostrarForumularioEditarPropietario($id_propietario) {
        $propietario = $this->modelo->obtenerPropietarioPorId($id_propietario);
        if($propietario) {
            $this->vista->mostrarForumularioEditarPropietario($propietario);
        } else {
            $this->vista->mostrarError("No se encontro propietario con el ID: " . $id_propietario);
        }
    }

    public function editarPropietario($id_propietario) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $this->modelo->editarPropietario($id_propietario, $nombre, $telefono, $mail);
            header('Location: ' . BASE_URL . 'propietarios');
            exit();
        }
    }

    // Eliminar propietario (solo si no tiene propiedades asociadas)
    public function eliminarPropietario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_propietario'])) {
            $id_propietario = $_POST['id_propietario'];
            $totalPropiedades = $this->modelo->contarPropiedadesPorPropietario($id_propietario);
            if($totalPropiedades == 0) {
                $this->modelo->eliminarPropietario($id_propietario);
                header('Location:' . BASE_URL . 'propietarios');
                exit();
            } else {
                $this->vista->mostrarError("No se puede eliminar el propietario porque tiene propiedades asociadas");
            }
        }
    }
}