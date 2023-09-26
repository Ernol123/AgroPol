<?php
// if (!empty($_FILES['myFile'])) {
// }
// $db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');

// try {
//     $stmt = $db->prepare("INSERT INTO test VALUE ('" . addslashes(file_get_contents($_FILES['myFile']['tmp_name'])) . "')");
//     $stmt->execute();
// } catch (Exception $exc) {
//     exit('Error: ' . $exc->getMessage());
// }

print_r($_POST);

// try {
//     $stmt = $db->prepare("SELECT file FROM test");
//     $stmt->execute();
// } catch (Exception $exc) {
//     exit('Error: ' . $exc->getMessage());
// }
// foreach ($stmt->fetchAll() as $d) {
//     $photo = '<img src="data:image/jpeg;base64,' . base64_encode($d['file']) . '"/>';
// }
