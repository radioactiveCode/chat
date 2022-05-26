setInterval(pobierzDane, 1000); 

function pobierzDane()
{
    const adres = 'http://localhost/chat/pobierz.php';
    let blad_odczytu = false;
    let tresc_rozmowy = "";

    fetch(adres,
    {
        mode: 'no-cors', 
    })
    .then(response => response.json())
    .then(data => 
    { 
        tresc_rozmowy = data;
        odswiezCzat(tresc_rozmowy, blad_odczytu);
        console.log("Dane pobrano pomyślnie!");
    })
    .catch((error) => 
    {
        odswiezCzat(null, !blad_odczytu);
        console.error("Treść błędu: " + error);
    });    
};




