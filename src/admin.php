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
?>

<!DOCTYPE html>
<html lang = "pl">

<head>
    <meta charset = "UTF-8">
    <title>Chat PAW - Panel Administratora</title>
    <link rel = "stylesheet" href = "admin.css">

    <script src = "admin.js" defer></script>
</head>

<body>
    <img src = 'logo.png' alt = 'logo studiów PAW'></img>
    <p id = "tytul">Chat PAW - Panel Administratora</p>
    <div id = "admin_panel">
        <form method = "post" action = "dodaj.php">
            <div class = "wiersz"><p class = "etykieta">Hasło:</p><input type = "password" id = "nowe_haslo1" name = "nowe_haslo1" maxlength = "10" placeholder = "hasło"></div> 
            <div class = "wiersz"><p class = "etykieta">Powtórz hasło:</p><input type = "password" id = "nowe_haslo2"  name = "nowe_haslo2" maxlength = "10" placeholder = "powtórz hasło"></div> 
            <div class = "wiersz"><p class = "etykieta">Nazwa użytkownika:</p><input type = "text" id = "nowy_login"  name = "nowy_login" maxlength = "10" placeholder = "nazwa użytkownika"></div> 
            <?php
                if (isset($_SESSION['blad']))            
                {
                    echo '<p id = "blad">'.$_SESSION['blad'].'</p>';
                    unset($_SESSION['blad']);
                }
            ?>
            <input type = "submit" value = "Dodaj użytkownika chatu">
        </form>
        <a href="wyloguj.php">
            <div id = "admin_wyloguj">Wyloguj się</div>
        </a>
    </div>
</body>

</html>