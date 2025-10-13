<?php
require_once './config/config.php';

try {
    $pdo = getPDO();
    echo "¡Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
