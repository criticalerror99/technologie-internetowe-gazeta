<?php
  require 'includes/mysql.php';

  $query = $connect->prepare("SELECT `nazwa_szkoly`, `kolor_glowny` FROM `ustawienia`");
  $query->execute();
  $meter = $query->fetch();
  $nazwa_szkoly = $meter['nazwa_szkoly'];
  $header_bg = $meter['kolor_glowny'];
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
<?php 
  if(strlen($header_bg) > 6) { // sprawdzenie, czy w bazie znajduje się niestandardowy kolor tła dla górnej belki
    echo("<div class='header' style='background-color:$header_bg;'>"); // pobranie koloru z bazy
  }
  else {
    echo("<div class='header' style='background-color:seagreen;'>"); // standardowy kolor, gdy nie ma niestandardowego
  }
?>


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

  <div class="col-4">
    <?php
      $query = $connect->prepare("SELECT `naglowek`, `tekst`, `img` FROM `artykuly` ORDER BY `id` DESC LIMIT 1");
      $query->execute();
      $ilosc = $query->rowCount();
      $meter = $query->fetch();
      if($ilosc > 0) {
        $naglowek = $meter['naglowek'];
        $tekst = $meter['tekst'];
        $img = $meter['img'];    
        echo("<h1>" . $naglowek . "</h1><div class='artykul'>");
        if(strlen($img) > 1) {
          echo("<img src='$img' width='200' height='200'></img>");
        }
        echo('<p>' . $tekst . '</p>');
      }
      else {
        echo("<h1>Brak artykułów w bazie danych</h1><div class='artykul'>
        <p>W bazie danych nie znajduje się obecnie żaden artykuł. Stwórz nowy artykuł korzystając z panelu administracji.</p>");
      }
    ?>
    </div>
  </div>
</div>

</body>
</html>
