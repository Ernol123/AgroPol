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

foreach($_POST as $key => $val){
    // echo "$key = $val";
    if(str_starts_with($key,'photo') && empty($valu)){
        echo 'Dodoaj wszystkie zdjęcia';
        break;
    } else if($key == 'category' && empty($val)){
        echo 'Wybierz kategorię';
        break;
    } else if($key == 'mark' && empty($val)){
        echo 'Podaj markę';
        break;
    } else if($key == 'model' && $_POST['category'] != 'Nawozy' && $_POST['category'] != 'Rośliny' && empty($val)){
        echo 'Podaj model';
        break;
    } else if($key == 'workingWidth' && $_POST['category'] != 'Traktory' && $_POST['category'] != 'Przyczepa' && $_POST['category'] != 'Paszowozy' && $_POST['category'] != 'Nawozy' && $_POST['category'] != 'Rośliny' && empty($val)){
        echo 'Podaj szerokość roboczą';
        break;
    } else if($key == 'fromCountry' && empty($val)){
        echo 'Podaj kraj pochodzenia';
        break;
    } else if($key == 'price' && empty($val)){
        echo 'Podaj kraj pochodzenia';
        break;
    }
}

// try {
//     $stmt = $db->prepare("SELECT file FROM test");
//     $stmt->execute();
// } catch (Exception $exc) {
//     exit('Error: ' . $exc->getMessage());
// }
// foreach ($stmt->fetchAll() as $d) {
//     $photo = '<img src="data:image/jpeg;base64,' . base64_encode($d['file']) . '"/>';
// }
