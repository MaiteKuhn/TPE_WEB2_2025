<?php
class VistasPropietario {
    public function __construct() {}

    public function mostrarPropietarios($propietarios, $usuario = null) {
        require './templates/listar_propietarios.phtml';
    }

    public function mostrarPropietarioPorId($propietario, $propiedades = []) {
        require './templates/mostrar_propietario.phtml';
    }

    public function formularioAgregarPropietario() {
        require './templates/form_agregar_propietario.phtml';
    }

    public function formularioEditarPropietario($propietario) {
        require './templates/form_editar_propietario.phtml';
    }

    public function mostrarErrorEditar($id_propietario) {
        echo "<h2>No se encontró propietario con el ID: " . $id_propietario . "</h2>";
    }

    public function mostrarErrorEliminar() {
        echo "<h2>No se pudo eliminar el propietario</h2>";
    }
}
