// funkcja wywoływana ze skryptu ajaxPobierz
function odswiezCzat(tresc_rozmowy, blad_odczytu)
{   
    if (!blad_odczytu)
    {
        // wyświetlanie statusu połączenia - OK
        odczytBlad(blad_odczytu);

        // czyszczenie okna przy ładowaniu nowej treści rozmowy
        let chat_rozmowa_DIV = document.getElementById("chat_rozmowa");
        while (chat_rozmowa_DIV.firstChild) 
        {
            chat_rozmowa_DIV.removeChild(chat_rozmowa_DIV.firstChild);
        }

        // odczytaj JSON i przypisz właściwą klasę CSS 
        for (let i = 0; i < tresc_rozmowy.length; i++)
        {
            let tresc_wypowiedzi = document.createElement('div');

            (tresc_rozmowy[i].slice(0, tresc_rozmowy[i].indexOf('|') - 1).toUpperCase() == ja_login.toUpperCase()) ? tresc_wypowiedzi.setAttribute("class", "uczestnik_A") : tresc_wypowiedzi.setAttribute("class", "uczestnik_B");
            tresc_wypowiedzi.textContent = tresc_rozmowy[i];
            chat_rozmowa_DIV.appendChild(tresc_wypowiedzi);
            
            // automatyczne przewjanie okna 
            if (przewinChat())
            {
                chat_rozmowa_DIV.scrollTop = chat_rozmowa_DIV.scrollHeight;
            }   
        }
    }
    else
    {
        // wyświetlanie statusu połączenia - nie OK
        odczytBlad(blad_odczytu);
    }
}

// sprawdzanie checkboxa od automatycznego przewijania okna
function przewinChat()
{
    let przycisk_autoodswiezanie = document.getElementById("czat_autoodswiezanie");
    
    if (przycisk_autoodswiezanie.checked == true)
    { 
        return true 
    }
    else
    { 
        return false 
    }
}

// wyświetlanie statusu połączenia
function odczytBlad(blad_odczytu)
{
    let komunikat = document.getElementById("chat_status");

    if (blad_odczytu)
    {
        komunikat.style.color = "red";
        komunikat.textContent = "Połączenie z serwerem jest nieaktywne";
    }
    else
    {
        komunikat.style.color = "green";
        komunikat.textContent = "Połączenie z serwerem jest aktywne";
    }
}

// rozwijanie okna z rozmowami archiwalnymi
document.getElementById("archiwalne_rozwin").addEventListener('click', pokazArchiwalne);
function pokazArchiwalne()
{
    let menu_archiwalne = document.getElementById("archiwalne_okno");

    menu_archiwalne.style.opacity == 0 ? menu_archiwalne.style.opacity = 100 : menu_archiwalne.style.opacity = 0;
}

// zwijanie okna z rozmowami archiwalnymi
document.getElementById("archiwalne_zwin").addEventListener('click', zwinArchiwalne);
function zwinArchiwalne()
{
    let menu_archiwalne = document.getElementById("archiwalne_okno");

    menu_archiwalne.style.opacity = 0;
}

// wyświetlane w nowym oknie treści rozmowy archiwalnej
Array.from(document.getElementsByClassName("archiwalne_link")).forEach(element =>
{
    element.addEventListener('click', wyswietlArchiwalne);
});
function wyswietlArchiwalne()
{   
    let menu_archiwalne = document.getElementById("archiwalne_okno");

    // reaguj gdy okno jest widoczne, bo nie używam visible w CSS
    if (menu_archiwalne.style.opacity == 100)
    {
        const adres = 'http://localhost/chat/archiwalna.php';
        let ID_do_wyslania = this.id;

        let formData = new FormData();
        formData.set('archiwalne_ID_do_wyslania', ID_do_wyslania);
        
        fetch(adres,
        {
            method: "POST",
            mode: 'no-cors',
            body: formData,
        })
        .catch((error) => 
        {
            console.error("Treść błędu: " + error);
        }); 

        window.open('http://localhost/chat/archiwalna.php','_blank');
    }
}

// sprawdzanie, ile znaków można jeszcze wpisać (maks 200 znaków)
document.getElementById("chat_wiadomosc_do_wyslania").addEventListener('keyup', ileZnakow);
function ileZnakow()
{
    let do_wyslania = document.getElementById("chat_wiadomosc_do_wyslania");
    let komunikat_ile_znakow = document.getElementById("chat_ile_znakow");

    let limit_znakow = 200;
    let pozostalo_znakow = limit_znakow - do_wyslania.value.length;
    let komunikat = "możesz jeszcze wpisać " + pozostalo_znakow + " znaków";

    if (do_wyslania.value.length != 0)
    {
        komunikat_ile_znakow.style.display = "block";
        komunikat_ile_znakow.textContent = komunikat;
    }
    else
    {
        komunikat_ile_znakow.style.display = "none";
    }
}
