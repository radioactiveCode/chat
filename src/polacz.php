<?php
    session_start();

    include_once 'dane.php';

    try
    {    
        $zrodlo = "mysql:host=$host; dbname=$baza_danych; charset=utf8";
        $polaczenie = new PDO($zrodlo, $uzytkownik, $haslo, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
     
    catch (PDOException $error) 
    {   
        echo $error;
        echo '<br>';
        echo '<br>';
        echo $error->getMessage();
        echo '<br>';
        echo '<br>';
        exit('Wystąpił problem z połączeniem. Skontaktuj się z administratorem: administrator@chat.pl');
    }

    function przekieruj($gdzie)
    {
        header("Location: ".$gdzie);
        exit();
    }
?>