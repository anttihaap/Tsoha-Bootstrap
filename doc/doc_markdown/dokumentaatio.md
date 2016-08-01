# Asiakaskäyntikirjausjärjestelmä

Järjestelmällä pitää kirjaa asiakkaista, työntekijöistä ja työntekijöiden suorittamista asiakaskäynneistä.

Tarkoituksena on helpottaa yrityksen kirjanpitoa työntekijöiden asiakaskäynneistä ja luoda työntekjöille helppokäyttöinen portaali, johon he voivat kirjata omia asiakskäyntejään, muokata asiakkaiden tietoja ja lisätä uusia työntekijöitä. Mahdollisesti järjestelmällä voi tulevaisuudessa luoda automaattisesti laskut asiakkaille ja palkkaerittelyt työntekijöille.

Järjestelmä toteutetaan php:lla ja tietokanta toimii PostgreSQL:llä. Toimintaympäristönä users.cs.helsinki.fi -palvelin. Käyttö onnistuu millä tahansa modernilla web-selaimella, jossa on javascript tuki.

## Käyttäjäryhmät

* Työntekijä - suorittaa fyysisesti asiakaskäynnit, jotka hän kirjaa ylös järjestelmään.
* Johto - hallinnoi työntekijöitä: voi lisätä työntekijöitä, muuttaa työntekijöiden käyttäjätunnusten tietoja.

## Käyttötapaukset 

* Asiakkaan lisääminen - työntekijä/johto
* Asiakkaan tietojen muokkaaminen - työntekijä/johto
* Asiakkaan tarkastelu - työntekijä/johto
* Asiakaskäynnin lisääminen - työntekijä/johto
* Asiakaskäynnin muokkaaminen - työntekijä/johto
* Asiakaskäynnin tarkastelu - työntekijä/johto
* Asiakaskäyntien haku - työntekijä/johto

(toteutetaan jos kerkiää: )

* Työntekijän lisääminen - johto
* Työntekijän käyttäjätunnuksen tietojen muokkaaminen - johto
* Työntekijän poistaminen - johto




