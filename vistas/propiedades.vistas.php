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

    public function mostrarErrorEditar( $id_propiedad){
        echo "<h2>No se encontro propiedad con el ID: " . $id_propiedad . "</h2>";
    }

    public function mostrarErrorEliminar(){
        echo "<h2>No se pudo eliminar la propiedad</h2>";
    }

}