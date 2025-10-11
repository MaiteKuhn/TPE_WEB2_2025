<?php
require_once './config/config.php';
class ModeloPropiedades {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alquilertemp;charset=utf8', 'root', '');
    }

    public function obtenerPropiedades() {
        $query = $this->db->prepare('SELECT * FROM propiedades');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerPropietarios() {
    $query = $this->db->prepare("SELECT id, nombre FROM propietarios");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

    public function obtenerPropiedadPorId($id_propiedad) {
        $query = $this->db->prepare('SELECT * FROM propietarios WHERE id_propiedad = ?');
        $query->execute([$id_propiedad]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function agregarPropiedad($id_propietario, $tipo_propiedad, $ubicacion, $habitaciones, $metros_cuadrados) {
        $query = $this->db->prepare('INSERT INTO propiedades (id_propietario_fk, tipo_propiedad, ubicacion, habitaciones, metros_cuadrados) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$id_propietario, $tipo_propiedad, $ubicacion, $habitaciones, $metros_cuadrados]);
    }

    public function editarPropiedad($id_propiedad, $id_propietario, $tipo_propiedad, $ubicacion, $habitaciones, $metros_cuadrados) {
        $query = $this->db->prepare('UPDATE propiedades SET id_propietario_fk = ?, tipo_propiedad = ?, ubicacion = ?, habitaciones = ?, metros_cuadrados = ? WHERE id_propiedad = ?');
        $query->execute([$id_propiedad, $id_propietario, $tipo_propiedad, $ubicacion, $habitaciones, $metros_cuadrados]);
    }

    public function eliminarPropiedad($id_propiedad) {
        $query = $this->db->prepare('DELETE FROM propiedad WHERE id_propiedad = ?');
        $query->execute([$id_propiedad]);
    }
}
