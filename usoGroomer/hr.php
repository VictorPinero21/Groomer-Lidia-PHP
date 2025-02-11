<?php
$host = 'localhost';
$dbname = 'mi_base_de_datos';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    // Capturar y mostrar cualquier error en la conexión
    echo "Error en la conexión: " . $e->getMessage();
}
