<?php
$is_valid = true;

foreach ($_POST as $key => $val) {
    // echo "$key = $val";
    if (str_starts_with($key, 'photo') && empty($valu)) {
        echo 'Dodoaj wszystkie zdjęcia';
        $is_valid = false;
        break;
    } else if ($key == 'category' && empty($val)) {
        echo 'Wybierz kategorię';
        $is_valid = false;
        break;
    } else if ($key == 'mark' && empty($val)) {
        echo 'Podaj markę';
        $is_valid = false;
        break;
    } else if ($key == 'model' && $_POST['category'] != 'Nawozy' && $_POST['category'] != 'Rośliny' && empty($val)) {
        echo 'Podaj model';
        $is_valid = false;
        break;
    } else if ($key == 'workingWidth' && $_POST['category'] != 'Traktory' && $_POST['category'] != 'Przyczepa' && $_POST['category'] != 'Paszowozy' && $_POST['category'] != 'Nawozy' && $_POST['category'] != 'Rośliny' && empty($val)) {
        echo 'Podaj szerokość roboczą';
        $is_valid = false;
        break;
    } else if ($key == 'fromCountry' && empty($val)) {
        echo 'Podaj kraj pochodzenia';
        $is_valid = false;
        break;
    } else if ($key == 'price' && empty($val)) {
        echo 'Podaj cenę';
        $is_valid = false;
        break;
    } else if ((is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'carSeatVersion') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'lightingVersion') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'equipmentVersion') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'priceOfEquipmentSpecification') && empty($val))) {
        echo 'Uzupełnij wszystkie pola w opcjach wyposażenia';
        $is_valid = false;
        break;
    } else if ((is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'enginePower') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'displacement') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'numberOfCylinders') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'priceOfEngineSpecification') && empty($val)) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'fuelTank') && empty($val))) {
        echo 'Uzupełnij wszystkie pola w opcjach wyposażenia';
        $is_valid = false;
        break;
    }
}

if ($is_valid) {
    $db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');

    // * Query for category_id
    try {
        $stmt = $db->prepare("SELECT id FROM categories WHERE name = :name");
        $stmt->execute(['name' => $_POST['category']]);
    } catch (Exception $exc) {
        exit('Error: ' . $exc->getMessage());
    }

    foreach ($stmt->fetchAll() as $d) {
        $categoryId = $d['id'];
    }

    // * Setting price brutto with VAT and duty
    if (strtoupper($_POST['fromCountry']) == 'USA' || strtoupper($_POST['fromCountry']) == 'STANY ZJEDNOCZONE') {
        $priceBrutto = ($_POST['price'] * 1.33);
    } else {
        $priceBrutto = ($_POST['price'] * 1.23);
    }

    try {
        $stmt = $db->prepare("INSERT INTO products VALUE (NULL, :mark, :model, :from_country, :price_netto, :price_brutto, :photo_1, :photo_2, :photo_3, :photo_4, :category_id)");
        $stmt->execute(['mark' => $_POST['mark'], 'model' => $_POST['model'] ?? 'Brak Modelu', 'from_country' => $_POST['fromCountry'], 'price_netto' => $_POST['price'], 'price_brutto' => $priceBrutto, 'photo_1' => addslashes(file_get_contents($_FILES['photo1']['tmp_name'])), 'photo_2' => addslashes(file_get_contents($_FILES['photo2']['tmp_name'])), 'photo_3' => addslashes(file_get_contents($_FILES['photo3']['tmp_name'])), 'photo_4' => addslashes(file_get_contents($_FILES['photo4']['tmp_name'])), 'category_id' => $categoryId]);
    } catch (Exception $exc) {
        exit('Error: ' . $exc->getMessage());
    }

    $productId = $db->lastInsertId();
    $specification = array();
    $engine = array();

    foreach ($_POST as $key => $val) {
        if ($key == 'workingWidth' && $_POST['category'] != 'Traktory' && $_POST['category'] != 'Przyczepa' && $_POST['category'] != 'Paszowozy' && $_POST['category'] != 'Nawozy' && $_POST['category'] != 'Rośliny') {
            try {
                $stmt = $db->prepare("INSERT INTO properities VALUE (:product_id, :working_width)");
                $stmt->execute(['product_id' => $productId, 'working_width' => $_POST['workingWidth']]);
            } catch (Exception $exc) {
                exit('Error: ' . $exc->getMessage());
            }
        } else if ((is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'carSeatVersion')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'lightingVersion')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'equipmentVersion')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'priceOfEquipmentSpecification'))) {
            $specification[substr($key, -1, 1)][substr($key, 0, -1)] = $val;
        } else if ((is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'enginePower')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'displacement')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'numberOfCylinders')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'priceOfEngineSpecification')) || (is_numeric(substr($key, -1, 1)) && str_starts_with($key, 'fuelTank'))) {
            $engine[substr($key, -1, 1)][substr($key, 0, -1)] = $val;
        }
    }

    foreach ($specification as $d) {
        try {
            $stmt = $db->prepare("INSERT INTO specification VALUE (:product_id, :car_seat_version, :lighting_version, :equipment_version, :price_of_specification)");
            $stmt->execute(['product_id' => $productId, 'car_seat_version' => $d['carSeatVersion'], 'lighting_version' => $d['lightingVersion'], 'equipment_version' => $d['equipmentVersion'], 'price_of_specification' => $d['priceOfEquipmentSpecification']]);
        } catch (Exception $exc) {
            exit('Error: ' . $exc->getMessage());
        }
    }

    foreach ($engine as $d) {
        try {
            $stmt = $db->prepare("INSERT INTO engine VALUE (:product_id, :engine_power, :displacement, :number_of_cylinders, :fuel_tank, :price_of_specification)");
            $stmt->execute(['product_id' => $productId, 'engine_power' => $d['enginePower'], 'displacement' => $d['displacement'], 'number_of_cylinders' => $d['numberOfCylinders'], 'fuel_tank' => $d['fuelTank'], 'price_of_specification' => $d['priceOfEngineSpecification']]);
        } catch (Exception $exc) {
            exit('Error: ' . $exc->getMessage());
        }
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