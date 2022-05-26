<?php
    include_once 'polacz.php';
    
    $kto = $_SESSION['login'];
    $kiedy = date('H:i:s').' '.date('d/m/Y');

    // zapisz datę logowania
    $zapytanieSQL_1 = $polaczenie->prepare("INSERT INTO logowania VALUES (null, :kto, :kiedy)");
    $zapytanieSQL_1->bindValue(':kto', $kto);
    $zapytanieSQL_1->bindValue(':kiedy', $kiedy); 
    $zapytanieSQL_1->execute();

    // pobierz datę ostatniego logowania
    $zapytanieSQL_2 = $polaczenie->prepare("SELECT kiedy FROM logowania WHERE kto = :login ORDER BY id DESC limit 1 OFFSET 1");
    $zapytanieSQL_2->bindValue(':login', $kto);
    $zapytanieSQL_2->execute();

    $wynik = $zapytanieSQL_2->fetch();
    $_SESSION['$ostatnie_logowanie'] = $wynik[0];
?>




