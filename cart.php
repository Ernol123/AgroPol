<?php
session_start();
if (!($_SESSION['id'] ?? null)) {
  header('Location:./index.html');
}
$db = new PDO('mysql:host=localhost; dbname=agropol', 'root', '');
try {
  $stmt = $db->prepare("SELECT * FROM cart WHERE user_id='{$_SESSION['id']}'");
  $stmt->execute();
} catch (Exception $exc) {
  exit('Error: ' . $exc->getMessage());
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agropol | Strona Główna</title>
  <link rel="icon" href="./github/logo.jpg" type="image/jpg" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="https://kit.fontawesome.com/74557bc5d4.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav>
    <div class="logo">AGRO<span>POL</span></div>
    <div class="nav_items">
      <a href="./index.html" class="active">Strona Główna</a>
      <a href="./items.php">Sklep</a>
      <a href="./cart.php">Koszyk</a>
      <a href="./form.html">Dodaj</a>
    </div>
    <div class="login">
      <i class="fa-solid fa-user"></i>
      <a href="./login.php">Logowanie</a>
      <a href="./php/logout.php">Wyloguj</a>
    </div>
  </nav>
  <div class="border"></div>

  <h1 class="info">Koszyk</h1>
  <div class="border80"></div>

  <main>
    <?php foreach ($stmt->fetchAll() as $d) {
      try {
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $d['product_id']]);
      } catch (Exception $exc) {
        exit('Error: ' . $exc->getMessage());
      }
      foreach ($stmt->fetchAll() as $x) {
        $photo = '<img width="500px" src="data:image/jpeg;base64,' . base64_encode($x['photo_1']) . '"/>';
    ?>
        <div class="engine1">
          <a href="info.php?id=<?= $x['id'] ?>"><i class="fa-solid fa-circle-info"></i></a>
          <?php echo $photo ?>
          <h1><?php echo "$x[mark] $x[model]" ?></h1>
          <h2><?= $x['price_brutto'] ?> zł</h2>
        </div>
      <?php } ?>

      </div>

    <?php } ?>

  </main>
</body>

</html>