<?php
session_start();
if (!$_SESSION['id'] ?? null) {
    header('Location:../index.html');
}

$db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');
try {
    $stmt = $db->prepare("INSERT INTO cart VALUE (:product_id, :user_id)");
    $stmt->execute(['product_id' => $_GET['id'], 'user_id' => $_SESSION['id']]);
} catch (Exception $exc) {
    exit('Error: ' . $exc->getMessage());
}

header('Location:../items.php');
