<?php
require_once './config/config.php';
class ModeloAuth{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alquilertemp;charset=utf8', 'root', '');
    }

     public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$user]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }


}