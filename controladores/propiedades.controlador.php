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
        $usuario = $request->user ?? null;
        $this->vista->mostrarPropiedades($propiedades, $usuario);
    }

    public function mostrarPropiedadPorId($id_propiedad) {
        $propiedad = $this->modelo->obtenerPropiedadPorId($id_propiedad);
        if ($propiedad) {
            $propietario = $this->modelo->obtenerPropietarioPorId($propiedad->id_propietario_fk);
            $this->vista->mostrarPropiedadPorId($propiedad, $propietario);
        } else {
            $this->vista->mostrarError("No se puede mostrar la propiedad");
        }
    }

    public function agregarPropiedad() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (!isset($_POST['id_propietario_fk']) || empty($_POST['id_propietario_fk'])) {
            $this->vista->mostrarError('ingrese el propietario');
            return;
        }
        if (!isset($_POST['tipo_propiedad']) || empty($_POST['tipo_propiedad'])) {
            $this->vista->mostrarError('ingrese tipo de propiedad');
            return;
        }
        if (!isset($_POST['ubicacion']) || empty($_POST['ubicacion'])) {
            $this->vista->mostrarError('ingrese ubicacion');
            return;
        }
        if (!isset($_POST['habitaciones']) || empty($_POST['habitaciones'])) {
            $this->vista->mostrarError('ingrese cantidad de habitaciones');
            return;
        }
        if (!isset($_POST['metros_cuadrados']) || empty($_POST['metros_cuadrados'])) {
            $this->vista->mostrarError('ingrese cantidad de metros cuadrados');
            return;
        }
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
            if (!isset($_POST['id_propietario_fk']) || empty($_POST['id_propietario_fk'])) {
            $this->vista->mostrarError('ingrese el propietario');
            return;
        }
        if (!isset($_POST['tipo_propiedad']) || empty($_POST['tipo_propiedad'])) {
            $this->vista->mostrarError('ingrese tipo de propiedad');
            return;
        }
        if (!isset($_POST['ubicacion']) || empty($_POST['ubicacion'])) {
            $this->vista->mostrarError('ingrese ubicacion');
            return;
        }
        if (!isset($_POST['habitaciones']) || empty($_POST['habitaciones'])) {
            $this->vista->mostrarError('ingrese cantidad de habitaciones');
            return;
        }
        if (!isset($_POST['metros_cuadrados']) || empty($_POST['metros_cuadrados'])) {
            $this->vista->mostrarError('ingrese cantidad de metros cuadrados');
            return;
        }
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
            if (!$propiedad) {
                $this->vista->mostrarError("No se pudo editar");
                return;
            }
            $propietarios = $this->modelo->obtenerPropietarios(); 
            $this->vista->forumularioEditarPropiedad($propiedad, $propietarios);
        }
    }

    public function eliminarPropiedad($id_propiedad) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->eliminarPropiedad($id_propiedad);
            header('Location:' . BASE_URL . 'propiedades');
            exit();
            } else {
                $this->vista->mostrarError("No se pudo eliminar la propiedad");
            }
        }
    }
