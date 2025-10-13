<?php
require_once './modelos/propiedades.model.php';
require_once './vistas/propiedades.vistas.php';

class ControladorPropiedades {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new ModeloPropiedades();
        $this->vista = new VistaPropiedades(); 
    }

    public function mostrarPropiedades($request = null) {
        $propiedades = $this->modelo->obtenerPropiedades();
        $usuario = null;
        if ($request && isset($request->user) && $request->user != null) {
            $usuario = $request->user;
        }
        $this->vista->mostrarPropiedades($propiedades, $usuario);
    }

    public function mostrarPropiedadPorId() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_propiedad = $_POST['id_propiedad'];
        }
        $propiedades = $this->modelo->obtenerPropiedadPorId($id_propiedad);
        $this->vista->mostrarPropiedadPorId($id_propiedad);
    }


    public function agregarPropiedad() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_propietario = $_POST['id_propietario_fk'];
            $tipo_propiedad = $_POST['tipo_propiedad'];
            $ubicacion= $_POST['ubicacion'];
            $habitaciones = $_POST['habitaciones'];
            $metros_cuadrados = $_POST['metros_cuadrados'];

            $this->modelo->agregarPropiedad($id_propietario, $tipo_propiedad,$ubicacion,$habitaciones,$metros_cuadrados);
            header('Location: ' . BASE_URL . 'propiedades');
            exit();
        } else {
            $propietarios = $this->modelo->obtenerPropietarios();
            $this->vista->formularioAgregarPropiedad($propietarios);
        }
    }

    public function editarPropiedad($id_propiedad) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_propietario = $_POST['id_propietario_fk'];
            $tipo_propiedad = $_POST['tipo_propiedad'];
            $ubicacion= $_POST['ubicacion'];
            $habitaciones = $_POST['habitaciones'];
            $metros_cuadrados = $_POST['metros_cuadrados'];
            $this->modelo->editarPropiedad($id_propiedad, $id_propietario, $tipo_propiedad, $ubicacion, $habitaciones, $metros_cuadrados);
            header('Location: ' . BASE_URL . 'propiedades');
            exit();
        } else {
            $propiedad = $this->modelo->obtenerPropiedadPorId($id_propiedad);
            $propietarios = $this->modelo->obtenerPropietarios(); 
            $this->vista->forumularioEditarPropiedad($propiedad, $propietarios);
        }
    }

    public function eliminarPropiedad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_propiedad = $_POST['id_propiedad'];
            $this->modelo->eliminarPropiedad($id_propiedad);
            header('Location:' . BASE_URL . 'propiedades');
            exit();
            } else {
                $this->vista->mostrarErrorEliminar();
            }
        }
    }
