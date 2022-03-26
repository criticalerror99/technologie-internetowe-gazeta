<?php
  require 'includes/mysql.php';

  $query = $connect->prepare("SELECT `nazwa_szkoly` FROM `ustawienia`");
  $query->execute();
  $meter = $query->fetch();
  $nazwa_szkoly = $meter['nazwa_szkoly'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<title><?php echo($nazwa_szkoly);?> - InfoKiosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<meta charset="utf-8">

<script src="./js/main.js"></script>
<script src="./js/clock.js"></script>
<script src="./js/imieniny.js"></script>

</head>
<body onload="init()">

<div class="header">
  <h1><?php echo($nazwa_szkoly);?></h1>
  <p align="right" id="clock" onload="startTime()"></p>
  <p align="right" id="data" onload="readDate()"></p>
  <p align="right" id="imieniny" onload="printImieniny()"></p>
</div>

<div class="row">
  <div class="col-3 menu">
    <ul>
      <li>Archiwum</li>
      <li>Administracja</li>
    </ul>
  </div>

  <div class="col-9">
    <h1>Nagłówek</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse blandit blandit neque a luctus. Sed ullamcorper lectus vel quam cursus lobortis. Vivamus congue erat ac eros dictum, eget aliquet dui efficitur. Duis ante eros, tincidunt vitae metus eu, dapibus elementum eros. Cras varius eleifend nulla, non suscipit justo auctor nec. Donec hendrerit orci magna. Ut mollis, magna sed maximus porttitor, tortor tellus euismod enim, sit amet facilisis felis risus sit amet odio. Maecenas varius id sem vitae maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent ornare interdum bibendum. Aenean ultrices ornare ipsum, vitae sagittis ipsum malesuada vel. Integer non interdum sapien, nec consectetur dui. Praesent elementum justo augue, eu iaculis magna pulvinar non. Nunc a convallis orci.</p>
    <p>Curabitur ut nisl in massa ornare vehicula. Nam et mauris sit amet dui dictum suscipit id in dolor. Integer id ante et ligula accumsan euismod. Integer efficitur sem ac malesuada ornare. Proin ut nisl quis nisl vulputate convallis. Duis in tempus sem. Quisque sit amet dolor quis enim vestibulum accumsan et vel lacus. Integer ultricies, tortor et ornare pulvinar, neque elit posuere justo, at vestibulum mauris libero sollicitudin purus. Cras posuere neque ornare, consequat nulla non, pulvinar velit. Nunc erat libero, laoreet in enim in, fringilla dignissim mauris.</p>
  </div>
</div>

</body>
</html>
