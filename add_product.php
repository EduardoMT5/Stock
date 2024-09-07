<?php
session_start();
require 'config/db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Procesar el formulario de adición de producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $cantidad = $_POST['cantidad'];
    $calidad = $_POST['calidad'];

    try {
        $stmt = $pdo->prepare('INSERT INTO products (nombre, marca, modelo, cantidad, calidad) VALUES (:nombre, :marca, :modelo, :cantidad, :calidad)');
        $stmt->execute([
            ':nombre' => $nombre,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':cantidad' => $cantidad,
            ':calidad' => $calidad,
        ]);

        header('Location: manage_products.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
