<?php
require_once 'config/config.php';
class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );

        $this->deploy();
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            // Usamos heredoc con comillas simples para que los hashes no se interpreten
            $sql = <<<'SQL'
CREATE TABLE propietarios (
  id_propietario INT(11) NOT NULL AUTO_INCREMENT,
  id_propiedad INT(11) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  telefono INT(11) NOT NULL,
  mail VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_propietario)
);

CREATE TABLE propiedades (
  id_propiedad INT(11) NOT NULL AUTO_INCREMENT,
  id_propietario_fk INT(11) NOT NULL,
  tipo_propiedad VARCHAR(20) NOT NULL,
  ubicacion VARCHAR(50) NOT NULL,
  habitaciones INT(11) NOT NULL,
  metros_cuadrados INT(11) NOT NULL,
  PRIMARY KEY (id_propiedad),
  CONSTRAINT fk_propiedades_propietarios FOREIGN KEY (id_propietario_fk)
    REFERENCES propietarios (id_propietario)
);

CREATE TABLE usuarios (
  id_usuario INT(11) NOT NULL AUTO_INCREMENT,
  usuario TEXT NOT NULL,
  password VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_usuario)
);

INSERT INTO propietarios (id_propietario, id_propiedad, nombre, telefono, mail) VALUES
(1, 2, 'Maite', 541538, 'maikuhn@live.com'),
(2, 3, 'Pilar costa bauer', 1875, 'ouefhbi'),
(4, 0, 'Silvina', 2147483647, 'sdi_luca@live.com');

INSERT INTO propiedades (id_propiedad, id_propietario_fk, tipo_propiedad, ubicacion, habitaciones, metros_cuadrados) VALUES
(5, 2, 'DUPLEX', 'Chacabuco 156', 10, 20),
(7, 1, 'CASA', '25 de mayo n254', 4, 25),
(8, 1, 'DEPARTAMENTO', 'Bulnes 136', 3, 30);

INSERT INTO usuarios (id_usuario, usuario, password) VALUES
(1, 'webadmin', '$2y$10$cym22VMuiSdoq1GlvdK0c.S9D5ZO2tzyWwr.HGQikBRCefg0GQBqS'),
(2, 'Maite', '$2y$10$zq6BxTRaOZKNbSNVRBKNjuU5wXnToGRZYGggLlsouZuAOoNlPQAbK'),
(3, 'Pilar', '$2y$10$A2Hcu6/sUoVL0VoypdP6aOIEkudC.Hrs7QiPb2ffasDO3OeB73nFK');
SQL;

            $this->db->exec($sql);
        }
    }
}
