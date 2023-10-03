<?php
session_start();

$db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');
try {
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $_POST['email']]);
} catch (Exception $exc) {
    exit('Error: ' . $exc->getMessage());
}

foreach ($stmt->fetchAll() as $d) {
    $passHash = $d['password'];
    $id = $d['id'];
}

if (password_verify($_POST['password'], $passHash)) {
    $_SESSION['id'] = $id;
    header('Location:../index.html');
} else {
    header('Location:../login.php?error=Błędny login lub hasło');
}
