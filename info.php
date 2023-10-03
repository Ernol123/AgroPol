<?php
$db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');
try {
  $stmt = $db->prepare("SELECT * FROM products WHERE id= :id");
  $stmt->execute(['id' => $_GET['id']]);
} catch (Exception $exc) {
  exit('Error: ' . $exc->getMessage());
}

foreach ($stmt->fetchAll() as $d) {
  $photo1 = '<img width="500px" src="data:image/jpeg;base64,' . base64_encode($d['photo_1']) . '"/>';
  $photo2 = '<img width="500px" src="data:image/jpeg;base64,' . base64_encode($d['photo_2']) . '"/>';
  $photo3 = '<img width="500px" src="data:image/jpeg;base64,' . base64_encode($d['photo_3']) . '"/>';
  $photo4 = '<img width="500px" src="data:image/jpeg;base64,' . base64_encode($d['photo_4']) . '"/>';

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $d['mark'] ?></title>
  </head>

  <body>
    <?= $photo1 ?>
    <?= $photo2 ?>
    <?= $photo3 ?>
    <?= $photo4 ?>
    <table border="1">
      <tbody>
        <tr>
          <th>Marka</th>
          <td><?= $d['mark'] ?></td>
        </tr>
        <tr>
          <th>Model</th>
          <td><?= $d['model'] ?></td>
        </tr>
        <tr>
          <th>Kraj pochodzenia</th>
          <td><?= $d['from_country'] ?></td>
        </tr>
        <tr>
          <th>Cena Netto</th>
          <td><?= $d['price_netto'] ?> zł</td>
        </tr>
        <tr>
          <th>Cena Brutto</th>
          <td><?= $d['price_brutto'] ?> zł</td>
        </tr>
        <?php
        try {
          $stmt = $db->prepare("SELECT * FROM engine WHERE product_id= :id");
          $stmt->execute(['id' => $d['id']]);
        } catch (Exception $exc) {
          exit('Error: ' . $exc->getMessage());
        }
        $i = 0;
        foreach ($stmt->fetchAll() as $x) {
          $i++
        ?>
          <tr>
            <th colspan="2">Wersja <?= $i ?></th>
          </tr>
          <tr>
            <th>Moc Silnika</th>
            <td><?= $x['engine_power'] ?></td>
          </tr>
          <tr>
            <th>Pojemność silnika</th>
            <td><?= $x['displacement'] ?> cm3</td>
          </tr>
          <tr>
            <th>Ilość cylindrów</th>
            <td><?= $x['number_of_cylinders'] ?></td>
          </tr>
          <tr>
            <th>Zbiornik paliwa</th>
            <td><?= $x['fuel_tank'] ?></td>
          </tr>
          <tr>
            <th>Cena wersji</th>
            <td><?= $x['price_of_specification'] ?> zł</td>
          </tr>
        <?php } ?>
        <?php
        try {
          $stmt = $db->prepare("SELECT * FROM specification WHERE product_id= :id");
          $stmt->execute(['id' => $d['id']]);
        } catch (Exception $exc) {
          exit('Error: ' . $exc->getMessage());
        }
        $i = 0;
        foreach ($stmt->fetchAll() as $x) {
        ?>
          <tr>
            <th colspan="2">Wersja <?= $x['equipment_version'] ?></th>
          </tr>
          <tr>
            <th>Rodzaj siedzenia</th>
            <td><?= $x['car_seat_version'] ?></td>
          </tr>
          <tr>
            <th>Ilość świateł</th>
            <td><?= $x['lighting_version'] ?></td>
          </tr>
          <tr>
            <th>Cena wersji</th>
            <td><?= $x['price_of_specification'] ?> zł</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </body>

  </html>
<?php } ?>