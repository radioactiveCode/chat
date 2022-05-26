// sprawdzanie pól tekstowych
Array.from(document.querySelectorAll('input[type="text"]')).forEach(element => 
{
        element.addEventListener('blur', sprawdzTekst);
});
    
function sprawdzTekst()
{
    // sprawdzam, czy tekst nie zawiera niedozwolonych znaków
    sprawdzZnaki(this.value, this.id);
}

// sprawdzanie pól haseł
Array.from(document.querySelectorAll('input[type="password"]')).forEach(element => 
{
    element.addEventListener('blur', sprawdzHaslo);
});

function sprawdzHaslo()
{
    // najpierw sprawdzam, czy hasła są identyczne
    let hasla_ok = true;

    if (this.id == "nowe_haslo2")
    {
        let pierwsze_haslo = document.getElementById("nowe_haslo1");

        if (this.value !== pierwsze_haslo.value)
        {
            alert("Wpisane hasła nie są identyczne!");
            this.style.backgroundColor = "#a41d2d";
            pierwsze_haslo.style.backgroundColor = "#a41d2d";
            this.value = "";
            hasla_ok = false;
        }
        else
        {
            this.style.backgroundColor = "white";
            pierwsze_haslo.style.backgroundColor = "white";
        }
    }

    // sprawdzam, czy hasła nie zawierają niedozwolonych znaków
    if (hasla_ok)
    {
        sprawdzZnaki(this.value, this.id)
    }
}

// funkcja sprawdzająca, czy wpisany teskt zawiera niedozwolone znaki
function sprawdzZnaki(tekst, ID)
{
    let litery_cyfry = /^[a-zA-ZąĄćĆęĘóÓłŁśŚźŹżŻńŃ0-9]*$/;
    let pole_formularza = document.getElementById(ID);

    if (litery_cyfry.test(tekst))
    {
       pole_formularza.style.backgroundColor = "white";
    }
    else
    {
       alert("Pole zawiera niedozwolne znaki specjalne! Dozwolone znaki to litery oraz cyfry.");
       pole_formularza.style.backgroundColor = "#a41d2d";
    }    
}
