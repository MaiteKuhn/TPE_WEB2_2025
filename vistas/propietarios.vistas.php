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

    public function mostrarError($mensaje) {
        $error = $mensaje; 
        require './templates/mostrarError.phtml';
    }
}
