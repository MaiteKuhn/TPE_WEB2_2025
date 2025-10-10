<?php
require_once './config/config.php';
class ModeloPropietario {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alquilertemp;charset=utf8', 'root', '');
    }

    public function obtenerPropietarios() {
        $query = $this->db->prepare('SELECT * FROM propietarios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerPropietarioPorId($id_propietario) {
        $query = $this->db->prepare('SELECT * FROM propietarios WHERE id_propietario = ?');
        $query->execute([$id_propietario]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function agregarPropietario($nombre, $telefono, $mail) {
        $query = $this->db->prepare('INSERT INTO propietarios (nombre, telefono, mail) VALUES (?, ?, ?)');
        $query->execute([$nombre, $telefono, $mail]);
    }

    public function editarPropietario($id_usuario, $nombre, $telefono, $mail) {
        $query = $this->db->prepare('UPDATE propietarios SET nombre = ?, telefono = ?, email = ? WHERE id_propietario = ?');
        $query->execute([$nombre, $telefono, $mail, $id_propietario]);
    }

    public function eliminarPropietario($id_propietario) {
        $query = $this->db->prepare('DELETE FROM propietarios WHERE id_propietario = ?');
        $query->execute([$id_propietario]);
    }

    public function contarPropiedadesPorPropietario($id_propietario) {
        $query = $this->db->prepare('SELECT COUNT(*) AS total FROM propiedades WHERE id_propietario_dk = ?');
        $query->execute([$id_propietario]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }
   
    public function obtenerPropiedadesPorPropietario($id_propietario) {
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id_propietario_fk = ?');
        $query->execute([$id_propietario]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}