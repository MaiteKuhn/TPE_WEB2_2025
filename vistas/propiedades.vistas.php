<?php
class VistaPropiedades {
    public function __construct() {}

    public function mostrarPropiedades($propiedades){
         require_once './templates/listar_propiedades.phtml';
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