<?php
  require 'includes/mysql.php';
  require 'includes/admin.php';

  $query = $connect->prepare("SELECT `nazwa_szkoly`, `kolor_glowny`, `komunikat` FROM `ustawienia`");
  $query->execute();
  $meter = $query->fetch();
  $nazwa_szkoly = $meter['nazwa_szkoly'];
  $header_bg = $meter['kolor_glowny'];
  $komunikat = $meter['komunikat'];

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


  <h1><?php echo('<a href="index.php">' . $nazwa_szkoly . '</a>');?></h1>
  <p align="right" id="clock" onload="startTime()"></p>
  <p align="right" id="data" onload="readDate()"></p>
  <p align="right" id="imieniny" onload="printImieniny()"></p>
</div>

<?php
    if(strlen($komunikat) > 1) {
      echo("<div class='col-5'><h1>Ważna informacja</h1><p>$komunikat</p></div>");
    }
  ?>

<div class="row">
  <div class="col-3 menu">
    <ul>
      <li><a href="index.php?m=arch">Archiwum</a></li>
      <li><a href="index.php?m=admin">Administracja</a></li>
    </ul>
  </div>

  <div class="col-4">
    <?php
      if(!isset($_GET["m"])) {

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
      }
      else {
        $m = $_GET["m"];
        switch($m) {
          case "admin": { // panel admina
            if(!isLogged()) {
              echo("<form action='index.php?m=log' method='post'><h1>Logowanie</h1></h1><div class='artykul'><input type='text' placeholder='Login' name='ulog' required><input type='password' placeholder='Hasło' name='upass' required></p><button type='submit'>Zaloguj</button>");
              break;
            }
            else {
              $query = $connect->prepare("SELECT `id`, `naglowek` FROM `artykuly` ORDER BY `id` DESC");
              $query->execute();
              $lista = "";
          
              foreach($query as $rec) {
                  $lista = $lista . '<a href="index.php?m=e&art=' . $rec['id'] . '">' . $rec['naglowek'] . '</a><br/>';
              }
              echo($lista);
              break;
            }
          }
          case "log": {
            $log = $_POST["ulog"];
            $pass = $_POST["upass"];
            if($log == admin_login && $pass == admin_passwd) {
              $_SESSION["admin_log"] = admin_login;
              $_SESSION["admin_pass"] = admin_passwd;
              
              header("location:index.php?m=admin");
              break;
            }
            else {
              echo("<h1>Logowanie</h1><p>Wprowadzono nieprawidłowe dane logowania.</p><a href='index.php?m=admin'><button>Powrót</button></a>");
              break;
            }
          }
          case "arch": {
            $query = $connect->prepare("SELECT `id`, `naglowek` FROM `artykuly` ORDER BY `id` DESC");
            $query->execute();
            $lista = "";
        
            foreach($query as $rec) {
                $lista = $lista . '<a href="index.php?m=d&art=' . $rec['id'] . '">' . $rec['naglowek'] . '</a><br/>';
            }
            echo($lista);
            break;
          }
          case "d": {
            if(isset($_GET["art"])) {
              $sql = "SELECT `naglowek`, `tekst`, `img` FROM `artykuly` WHERE id = " . $_GET["art"];
              $query = $connect->prepare($sql);
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
            }
          }
        }
      }
    ?>
    </div>
  </div>
</div>

</body>
</html>
