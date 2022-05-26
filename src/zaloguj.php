<?php
    include_once 'polacz.php';

    if (isset($_SESSION['zalogowany']))            
    {
        przekieruj('chat.php');
    }

    if (isset($_POST['index_login']) && isset( $_POST['index_haslo']))
    {
        $_SESSION['login'] = $_POST['index_login'];
        $_SESSION['haslo'] = $_POST['index_haslo'];

        if (($_SESSION['login'] == '') || ($_SESSION['haslo'] == ''))
        {
            $_SESSION['blad'] = 'Poroszę uzupełnić oba pola formularza!';
            przekieruj('index.php');
        }

       $zapytanieSQL = $polaczenie->prepare("SELECT * FROM uzytkownicy WHERE login = :login");
       $zapytanieSQL->bindValue(':login', $_SESSION['login']);
       $zapytanieSQL->execute();

        if ($zapytanieSQL->rowCount() == 1)
        {
            $wynik = $zapytanieSQL->fetchObject();

            if ($wynik->haslo == md5($_SESSION['haslo']))
            {
                $_SESSION['zalogowany'] = true;
                require_once 'logowania.php';

                if ($_SESSION['login'] == 'Admin')
                {
                    przekieruj('admin.php');
                }
                else
                {
                    require_once 'utworz.php';
                    przekieruj('chat.php');
                }
            }
            else
            {
                $_SESSION['blad'] = 'Niepoprawne hasło!';
                przekieruj('index.php');
            }
        }
        else
        {
            $_SESSION['blad'] = 'Niepoprawna nazwa użytkownika!';
            przekieruj('index.php');
        }
    }
    else
    {
        przekieruj('index.php');
    }
?>