// reakcja na przycisk Wyślij
document.getElementById("chat_wiadomosc_wyslij").addEventListener('click', wyslijDane);
function wyslijDane()
{
    const adres = 'http://localhost/chat/wyslij.php';
    let tekst_do_wyslania = document.getElementById("chat_wiadomosc_do_wyslania");

    let formData = new FormData();
    formData.set('chat_wiadomosc_do_wyslania', tekst_do_wyslania.value);
    tekst_do_wyslania.value = "";
    ileZnakow();

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
}

// reakcja na klawisz Enter
document.addEventListener('keydown', stopEnter);
function stopEnter(e)
{   
    if (e.code == 'Enter') 
    {
        e.preventDefault();
        let przycisk_stopEnter = document.getElementById("chat_klawisz_enter");
        if (przycisk_stopEnter.checked == true)
        {
            wyslijDane();
        }
    }
};
