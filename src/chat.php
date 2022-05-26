<?php
    include_once 'polacz.php';

    if (!isset($_SESSION['zalogowany']))            
    {
        przekieruj('index.php');
    }
?>

<!DOCTYPE html>
<html lang = "pl">

<head>
    <meta charset = "UTF-8">
    <title>Chat PAW - rozmowa dzisiejsza</title>
    
    <link rel = "stylesheet" href = "archiwalna.css">
    <link rel = "stylesheet" href = "chat.css">

    <script>
        const ja_login = <?php echo json_encode($_SESSION['login']); ?>;
    </script>

    <script src = "chatFunkcje.js" defer></script>
    <script src = "ajaxPobierz.js" defer></script>
    <script src = "ajaxWyslij.js" defer></script>
</head>

<body>
    <div id = "grid_kontener">

        <!-- lewy -->
        <div id = chat_panel>
            <img src = 'logo.png' alt = 'logo studiów PAW'></img>
            <div class = "menu_opcja">
                <?php echo 'Witaj '.$_SESSION['login'].'!'; ?>
            </div>
            <div class = "menu_opcja">
                <?php echo 'Data ostatniego logowania: <br><p>'.$_SESSION['$ostatnie_logowanie'].'</p>'; ?>
            </div>
            <div class = "menu_opcja">
                <label> 
                    <input type = "checkbox" id = "czat_autoodswiezanie" checked>
                    Automatyczne przewijanie okna
                </label>
            </div>
            <div class = "menu_opcja">
                <label> 
                    <input type = "checkbox" id = "chat_klawisz_enter">
                    Klawisz Enter wysyła wiadomość
                </label>
            </div>
            <div id = "archiwalne_rozwin" class = "menu_opcja">Rozmowy archiwalne</div>
            <div id = "chat_status" class = "menu_opcja"></div>
            <a href="wyloguj.php">
                <div class = "menu_opcja" id = "chat_wyloguj">
                    Wyloguj się
                </div>
            </a>
            <p id = "chat_ile_znakow"></p>
        </div> 

        <!-- prawy -->
        <div id = chat_okno>
            <div id = "archiwalne_okno">
                <div id = "archiwalne_lista">
                    <?php include_once 'historia.php'; ?>
                </div>
                <div id = "archiwalne_zwin">Zwinń listę</div>
            </div>
            <div id = "chat_rozmowa"></div>
            <div id = "chat_formularz">
                <input type = "text" id = "chat_wiadomosc_do_wyslania" placeholder = "Tutaj wpisz wiadomość (maksymalnie 200 znaków)" maxlength = "200">
                <input type = "button" id = "chat_wiadomosc_wyslij" value = "Wyślij" >
            </div>     
        </div>

    </div>
</body>

</html>