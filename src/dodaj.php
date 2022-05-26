<?php
    include_once 'polacz.php';

    if (!isset($_SESSION['zalogowany']))            
    {
        przekieruj('index.php');
    }

    if (isset($_SESSION['zalogowany']) && !($_SESSION['login'] == 'Admin'))            
    {
        przekieruj('chat.php');
    }

    if (isset($_POST['nowy_login']) && !($_POST['nowy_login'] == "") &&
        isset($_POST['nowe_haslo1']) && !($_POST['nowe_haslo1'] == "") &&
        isset($_POST['nowe_haslo2']) && !($_POST['nowe_haslo2'] == ""))
    {
        $login = $_POST['nowy_login']; 
        $haslo1 = $_POST['nowe_haslo1']; 
        $haslo2 = $_POST['nowe_haslo2'];
        
        if (!($haslo1 == $haslo2))
        {
                $_SESSION['blad'] = 'Wpisane hasła nie są identyczne!';
                przekieruj('admin.php');
        }

        $zapytanieSQL = $polaczenie->prepare("SELECT * FROM uzytkownicy WHERE login = :login");
        $zapytanieSQL->bindValue(':login', $login);
        $zapytanieSQL->execute();
 
         if ($zapytanieSQL->rowCount() == 1)
         {
            $_SESSION['blad'] = 'Użytkownik o takiej nazwie już istnieje!';
            przekieruj('admin.php');   
         }

        $zapytanieSQL = $polaczenie->prepare("INSERT INTO uzytkownicy VALUES (null, :login, :haslo)");
        $zapytanieSQL->bindValue(':login', $login);
        $zapytanieSQL->bindValue(':haslo', md5($haslo1));  
        $zapytanieSQL->execute();

        $_SESSION['blad'] = 'Dodano uzytkownika '.$login.' !';
        przekieruj('admin.php');
    }
    else
    {
        $_SESSION['blad'] = 'Uzupełnj wszystkie pola formularza!';
        przekieruj('admin.php');
    }
?>
