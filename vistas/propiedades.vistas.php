<?php
class VistaPropiedades {
    public function __construct() {}

    public function mostrarPropiedades($propiedades, $usuario = null) {
        require './templates/listar_propiedades.phtml';
    }
    public function mostrarPropiedadPorId($propiedad, $propietario){
         require_once './templates/mostrar_propiedad.phtml';
    }

    public function formularioAgregarPropiedad($propietarios){
         require_once './templates/form_agregar_propiedades.phtml';

    }

    public function forumularioEditarPropiedad($propiedad, $propietarios){
         require_once './templates/form_editar_propiedad.phtml';
    }

    public function mostrarError($mensaje) {
        $error = $mensaje; 
        require './templates/mostrarError.phtml';
    }
    

}