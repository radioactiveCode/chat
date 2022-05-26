<?php
    include_once 'polacz.php';

    if (!isset($_SESSION['zalogowany']))            
    {
        przekieruj('index.php');
    }

    if (isset($_POST['chat_wiadomosc_do_wyslania']) && !($_POST['chat_wiadomosc_do_wyslania'] == ""))
    {
        $dzisiejsza_rozmowa = $_SESSION['data_rozmowy'];
        $czas = date("H:i:s");  
        $wiadomosc = $_POST['chat_wiadomosc_do_wyslania']; 
        $osoba = $_SESSION['login'];

        $zapytanieSQL = $polaczenie->prepare("INSERT INTO $dzisiejsza_rozmowa VALUES (null, :czas, :wiadomosc, :osoba)");
        $zapytanieSQL->bindValue(':czas', $czas);
        $zapytanieSQL->bindValue(':wiadomosc', $wiadomosc);  
        $zapytanieSQL->bindValue(':osoba', $osoba);  
        $zapytanieSQL->execute();
    }
    else
    {
        przekieruj('chat.php');
    }
?>
