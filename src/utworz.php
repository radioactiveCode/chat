<?php
    include_once 'polacz.php';

    $rozmowa_ID = 'rozmowa_'.str_replace("/", "_", date("d/m/Y")); 
    $zapytanie_SQL_tresc = 'show tables like '."'".$rozmowa_ID."'";

    $_SESSION['data_rozmowy'] = $rozmowa_ID; 
        
    $zapytanieSQL = $polaczenie->prepare($zapytanie_SQL_tresc);
    $zapytanieSQL->execute();

    // utwórz tablę dla dzisiejszej rozmowy jeżeli nie istnieje
    if ($zapytanieSQL->rowCount() == 0)
    {
        $nowa_rozmowa_SQL = 
        "CREATE TABLE $rozmowa_ID 
        (
           id int NOT NULL AUTO_INCREMENT,
           czas char(8) NOT NULL,
           wiadomosc varchar(200) NOT NULL,
           osoba char(10) NOT NULL,
           PRIMARY KEY (id)
         );"; 
        
       $zapytanieSQL = $polaczenie->prepare($nowa_rozmowa_SQL);
       $zapytanieSQL->execute();
    }
?>
