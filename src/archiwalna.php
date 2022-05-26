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
    <title>Chat PAW - Rozmowa archiwalna</title>
    <link rel = "stylesheet" href = "archiwalna.css">
</head>

<body>
    <?php
        if (isset($_SESSION['przekazane_ID']))
        {
            // wyświetl tabelę z treścią rozmowy przy II wywołaniu
            $ID_rozmowy =  $_SESSION['przekazane_ID'];
            $zapytanie_SQL = $polaczenie->prepare("SELECT * FROM $ID_rozmowy");
            $zapytanie_SQL->execute();

            echo '<p id = "archiwalna_wybrana">Treść rozmowy z dnia '.str_replace("_", "-", substr($ID_rozmowy, 8)).'</p>';

            echo '<table>
                    <tr>
                        <th>Login</th>
                        <th>Czas</th>
                        <th>Wiadomość</th>
                    </tr>';

            while ($wynik =$zapytanie_SQL->fetchObject())
            {
                echo '<tr>
                          <td>'.$wynik->osoba.'</th>
                          <td>'.$wynik->czas.'</th>
                          <td>'.$wynik->wiadomosc.'</th>
                      </tr>';
            }
            echo '</table>';
            
            echo '<input type = "button" id = "archiwalne_zamknij" value = "Zamknij okno" onclick = "window.close()">';
            unset($_SESSION['przekazane_ID']);
        }
        else
        {
            // ustaw zmienną sesyjną przy I wywołaniu za pomocą fetch
            if (isset($_POST['archiwalne_ID_do_wyslania']))
            {
                $_SESSION['przekazane_ID'] = $_POST['archiwalne_ID_do_wyslania'];
            }
            else
            {
                przekieruj('chat.php');
            }
        }
    ?>
</body>

</html>