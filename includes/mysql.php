<?php 
    $host = "localhost"; // adres IP bazy danych MySQL
    $dbname = "kiosk"; // nazwa bazy danych MySQL
    $user = "root"; // u�ytkownik bazy danych MySQL
    $passwd = ""; // has�o do u�ytkownika bazy danych MySQL
    $connect=new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
?>