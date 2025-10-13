<?php
class VistaPropiedades {
    public function __construct() {}

    public function mostrarPropiedades($propiedades, $usuario = null){
         if (!isset($usuario)) $usuario = null;
         // Hacemos disponible $usuario en la plantilla
         require './templates/listar_propiedades.phtml';
    }
    public function mostrarPropiedadPorId($id_propiedad){
         require_once './templates/mostrar_propiedad.phtml';
    }

    public function formularioAgregarPropiedad(){
         require_once './templates/form_agregar_propiedades.phtml';

    }

    public function forumularioEditarPropiedad($propiedad, $propietarios){
         require_once './templates/form_editar_propiedad.phtml';
    }

    public function mostrarErrorEditar( $id_propiedad){
        echo("No se encontro propiedad con el ID: " . $id_propiedad);
    }

    public function mostrarErrorEliminar(){
        echo("No se pudo eliminar la propiedad");
    }

}