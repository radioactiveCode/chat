<?php
    include_once 'polacz.php';

    if (isset($_SESSION['zalogowany']))            
    {
        przekieruj('chat.php');
    }
?>

<!DOCTYPE html>
<html lang = "pl">

<head>
    <meta charset = "UTF-8">
    <title>Chat PAW - Strona logowania</title>
    <link rel = "stylesheet" href = "index.css">
</head>

<body>
    <img src = 'logo.png' alt = 'logo studiów PAW'></img>
    <p id = "tytul">Chat studentów kierunku Programowanie Aplikacji Webowych</p>
    <div id = "chat_logowanie">
        <form method = "post" action = "zaloguj.php">
            <input type = "text" id = "index_login" name = "index_login" maxlength = "10" placeholder = "login"> <br>
            <input type = "password" id = "index_haslo"  name = "index_haslo" maxlength = "10" placeholder = "hasło"><br>
            <?php
                if (isset($_SESSION['blad']))            
                {
                    echo '<p id = "blad">'.$_SESSION['blad'].'</p>';
                    unset($_SESSION['blad']);
                }
            ?>
            <input type = "submit" value = "Zaloguj się">
        </form>
    </div>
</body>

</html>