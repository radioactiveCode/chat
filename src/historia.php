<?php
    if (isset($polaczenie))
    {     
        $zapytanie_SQL_tresc = "show tables like 'rozmowa%'";
        $zapytanie_SQL = $polaczenie->query($zapytanie_SQL_tresc)->fetchAll();

        foreach($zapytanie_SQL as $wynik)
        {
            $archiwalna_ID = str_replace("_", "-", substr($wynik[0], 8));
            echo "<p class = 'archiwalne_link' id = '".$wynik[0]."'>".$archiwalna_ID.'</p>'; 
        }
    }
    else
    {
        echo "Błąd połączenia";
    }
?>     