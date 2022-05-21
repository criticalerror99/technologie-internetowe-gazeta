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
              echo("<h1>Panel administracyjny</h1><div class='artykul'><p>");
              echo($lista);

              $query = $connect->prepare("SELECT `nazwa_szkoly`, `komunikat` FROM `ustawienia`");
              $query->execute();
              $info = $query->fetch();
              $uczelnia = $info['nazwa_szkoly'];
              $komunikat = $info['komunikat'];

              echo("<hr/><p><form action='index.php?m=settingse' method='post'><input type='text' name='uname' placeholder='Nazwa uczelni' value='" . $uczelnia . "' size='40' required></input><hr/><input type='text' placeholder='Kolor nagłówka (pusty=domyślny, format: #FF00FF)'name='kolor' size='40'></input><hr/><input type='text' name='info' placeholder='Ważna informacja' value='" . $komunikat . "' size='40'></input><hr/></p><button type='submit'>Zapisz</button></div>");
              break;
            }
          }
          case "settingse": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
            $uname = $_POST["uname"];
            $kolor = $_POST["kolor"];
            $komunikat = $_POST["info"];
            $sql = "UPDATE `ustawienia` SET `nazwa_szkoly` = '$uname', `kolor_glowny` = '$kolor', `komunikat` = '$komunikat'";   
            $query = $connect->prepare($sql);
            $query->execute();
            header("location:index.php?m=admin" . $art);
            break;
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
            $lista = "<h1>Lista artykułów </h1><div class='artykul'><p>";
        
            foreach($query as $rec) {
                $lista = $lista . '<a href="index.php?m=d&art=' . $rec['id'] . '">' . $rec['naglowek'] . '</a><br/>';
            }
            echo($lista);
            echo("</p></div>");
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
                break;
              }
            }
          }
          case "e": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
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

                $art = $_GET["art"];

                echo("<h1>Edycja artykułu " . $naglowek . "</h1><div class='artykul'><p><form action='index.php?m=se&art=" . $_GET["art"] . "' method='post'><input type='text' name='head' value='" . $naglowek . "' size='40'></input><hr/><input type='text' value='" . $tekst . "'name='tekst' size='40' required><hr/><input type='text' placeholder='Link do obrazka (opcjonalne)' name='image' value='" . $img . "'size='40'></input></p><a href='index.php?m=del&art=" . $art . "'>Usuń artykuł<br/><br/><button type='submit'>Wyślij</button></div>");

              }
            }
            break;
          }
          case "se": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
            $new_art = $_POST["tekst"];
            $new_img = $_POST["image"];
            $head = $_POST["head"];
            if(isset($_GET["art"])) {
              $sql = "SELECT `id` FROM `artykuly` WHERE id = " . $_GET["art"];
              $query = $connect->prepare($sql);
              $query->execute();
              $ilosc = $query->rowCount();
              $meter = $query->fetch();
              if($ilosc > 0) {
                $art = $_GET["art"];
                $sql = "UPDATE `artykuly` SET `naglowek` = '$head', `tekst` = '$new_art', `img` = '$new_img' WHERE id = $art";   
                $query = $connect->prepare($sql);
                $query->execute();
                header("location:index.php?m=d&art=" . $art);
                break;             
              }
              else {
                header("location:index.php");
                break;                
              }
            }
          }
          case "add": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
            echo("<h1>Tworzenie nowego artykułu</h1><div class='artykul'><p><form action='index.php?m=sa' method='post'><input type='text' name='head' placeholder='Nagłówek' size='40'></input><hr/><input type='text' placeholder='Treść' name='tekst' size='40' required><hr/><input type='text' placeholder='Link do obrazka (opcjonalne)' name='image' size='40'></input></p><br/><button type='submit'>Wyślij</button></div>");
            break;
          }
          case "sa": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
            $art = $_POST["tekst"];
            $img = $_POST["image"];
            $head = $_POST["head"];
            $sql = "SELECT MAX(`id`) AS `max_id` FROM `artykuly`";
              $query = $connect->prepare($sql);
              $query->execute();
              $row = $query->fetch();
              $max = $row["max_id"];
              $sql = "INSERT INTO `artykuly` (id, naglowek, tekst, img) VALUES (" . $max+1 . ", '" . $head . "', '" . $art . "', '" . $img . "')";   
              $query = $connect->prepare($sql);
              $query->execute();
              header("location:index.php?m=d&art=" . $max+1);
              break;             
          }
          case "del": {
            if(!isLogged()) {
              header("location:index.php");
              break;
            }
            if(isset($_GET["art"])) {
              $sql = "DELETE FROM `artykuly` WHERE id = " . $_GET["art"];
              $query = $connect->prepare($sql);
              $query->execute();
              $sql = "UPDATE `artykuly` SET id = id-1 WHERE id >" . $_GET["art"];
              $query = $connect->prepare($sql);
              $query->execute(); 
              header("location:index.php?m=admin");
              break;             
            }
            else {
              header("location:index.php");
              break;                
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