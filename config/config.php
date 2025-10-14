<?php
const MYSQL_USER = 'root';
const MYSQL_PASS = '';
const MYSQL_DB   = 'db_alquilertemp';
const MYSQL_HOST = 'localhost';

function getPDO() {
    $dsn = 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];
    return new PDO($dsn, MYSQL_USER, MYSQL_PASS, $options);
}
