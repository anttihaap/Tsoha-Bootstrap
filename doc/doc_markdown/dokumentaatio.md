# Asiakaskäyntikirjausjärjestelmä

Järjestelmällä pitää kirjaa asiakkaista, työntekijöistä ja työntekijöiden suorittamista asiakaskäynneistä.

Tarkoituksena on helpottaa yrityksen kirjanpitoa työntekijöiden asiakaskäynneistä ja luoda työntekjöille helppokäyttöinen portaali, johon he voivat kirjata omia asiakskäyntejään, muokata asiakkaiden tietoja ja lisätä uusia työntekijöitä. Mahdollisesti järjestelmällä voi tulevaisuudessa luoda automaattisesti laskut asiakkaille ja palkkaerittelyt työntekijöille.

Järjestelmä toteutetaan php:lla ja tietokanta toimii PostgreSQL:llä. Toimintaympäristönä users.cs.helsinki.fi -palvelin. Käyttö onnistuu millä tahansa modernilla web-selaimella, jossa on javascript tuki.

## Käyttäjäryhmät

* Työntekijä - suorittaa fyysisesti asiakaskäynnit, jotka hän kirjaa ylös järjestelmään.
* Johto - hallinnoi työntekijöitä: voi lisätä työntekijöitä, muuttaa työntekijöiden käyttäjätunnusten tietoja.

## Käyttötapaukset

![](pictures/käyttötapauskaavio.png)

* Asiakkaan lisääminen - työntekijä/hallinto
* Asiakkaan tietojen muokkaaminen - työntekijä/hallinto
* Asiakkaan tarkastelu - työntekijä/hallinto
* Asiakaskäynnin lisääminen - työntekijä/hallinto
* Asiakaskäynnin muokkaaminen - työntekijä/hallinto
* Asiakaskäynnin tarkastelu - työntekijä/hallinto
* Asiakaskäyntien haku - työntekijä/hallinto
 * Tietoja voidaan hakea asiakkaan ja ajanjakson perusteella.

(toteutetaan jos kerkiää: )

* Työntekijän lisääminen - hallinto
* Työntekijän käyttäjätunnuksen tietojen muokkaaminen - hallinto
* Työntekijän poistaminen - hallinto

## Järjestelmän tietosisältö

![](pictures/järjestelmäntietosisältö.png)

### Tietokohteet

#### Asiakas

|Attribuutti | Arvojoukko           | Kuvailu                             |
|------------|----------------------|-------------------------------------|
|Nimi        | Merkkijono, max 50   | Asiakkaan koko nimi                 |
|Osoite      | Merkkijono, max 120  | Osoite, esim: Mannerheimintie 1 A 1 |
|Kaupunki    | Merkkijono, max 50   | Asiakkaan asuin kotikaupunki        |
|Postinumero | Kokonaisluku         | Asiakkaan postinumero               |

#### Työntekijä

|Attribuutti | Arvojoukko           | Kuvailu                             |
|------------|----------------------|-------------------------------------|
|Nimi        | Merkkijono, max 50   | Työntekijän koko nimi               |

#### Hallinnonjäsen

|Attribuutti | Arvojoukko           | Kuvailu                             |
|------------|----------------------|-------------------------------------|
|Nimi        | Merkkijono, max 50   | Työntekijän koko nimi               |

#### Käyttäjätunnus

|Attribuutti | Arvojoukko           | Kuvailu                             |
|------------|----------------------|-------------------------------------|
|Käytäjätunnus| Merkkijono, max 50  | Käyttäjätunnus                      |
|salasana     | Merkkijono, max 50  | Käyttäjätunnuksen salasana          |

#### Asiakaskäynti

|Attribuutti           | Arvojoukko           | Kuvailu                        |
|----------------------|----------------------|--------------------------------|
|alkamispäivämäärä     | Päivämäärä           | Käynnin alkamispäivämäärä      |
|alkamiskellonaika     | Kellonaika           | Käynnin alkamisen kellonaika   |
|loppumispäivämääärä   | Päivämäärä           | Käynnin loppumisen päivämäärä  |
|loppumiskellonaika    | Kellonaika           | Käynnin loppumisen kellonaika  |

### Relaatiotietokantakaavio

![](pictures/relaatiotietokantakaavio.png)

**Huom. tietokantakaavio on englanniksi, koska ohjelman koodi on englanniksi.**

Kaaviosta huomataan, että käyttäjätunnus (User) voi liittyä moneen työntekijään tai hallinto-käyttäjään. Mikään ei estä tätä. Pitää selvittää yhden suhde yhteen -liitosta lisää. Varmaan rajoitteella onnistuu.

Henkilötieto taulun, joka sisältää nimen, osoitteen jne., voisi luoda. Sitä pystyisi käyttämään Asiakas (Customer), Työntekijä (Employee) ja Hallinto (Manager) taulut. En ehtinyt toteuttamaan vielä.
