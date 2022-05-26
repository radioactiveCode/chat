<?php
    include_once 'polacz.php';

    if (!isset($_SESSION['zalogowany']))            
    {
        przekieruj('index.php');
    }

    $dzisiejsza_rozmowa = $_SESSION['data_rozmowy'];
    $tablica = array(); 

    $zapytanieSQL = $polaczenie->prepare("SELECT * FROM $dzisiejsza_rozmowa");
    $zapytanieSQL->execute();

    while ($wynik = $zapytanieSQL->fetchObject())
    {
        $wiersz = $wynik->osoba.' | '.$wynik->czas.' | '.$wynik->wiadomosc;
        array_push($tablica, $wiersz);
    }
    
    $jsonToSend = $tablica;     
    echo json_encode($jsonToSend);
?>