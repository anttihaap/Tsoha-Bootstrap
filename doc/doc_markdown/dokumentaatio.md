# Asiakaskäyntikirjausjärjestelmä

Järjestelmällä pitää kirjaa asiakkaista, työntekijöistä ja työntekijöiden suorittamista asiakaskäynneistä.

Tarkoituksena on helpottaa yrityksen kirjanpitoa työntekijöiden asiakaskäynneistä ja luoda työntekjöille helppokäyttöinen portaali, johon he voivat kirjata omia asiakskäyntejään, muokata asiakkaiden tietoja ja lisätä uusia työntekijöitä. Mahdollisesti järjestelmällä voi tulevaisuudessa luoda automaattisesti laskut asiakkaille ja palkkaerittelyt työntekijöille.

Järjestelmä toteutetaan php:lla ja tietokanta toimii PostgreSQL:llä. Toimintaympäristönä users.cs.helsinki.fi -palvelin. Käyttö onnistuu millä tahansa modernilla web-selaimella, jossa on javascript tuki.

## Käyttäjäryhmät

* Työntekijä - suorittaa fyysisesti asiakaskäynnit, jotka hän kirjaa ylös järjestelmään.
* Hallinto - hallinnoi työntekijöitä: voi lisätä työntekijöitä, muuttaa työntekijöiden käyttäjätunnusten tietoja.

## Käyttötapaukset

![](pictures/käyttötapauskaavio.png)

* Asiakkaan lisääminen - työntekijä/hallinto
* Asiakkaan tietojen muokkaaminen - työntekijä/hallinto
* Asiakkaan tarkastelu - työntekijä/hallinto
 * Listaa asiakkaan tiedot ja listaa asiakkaan asiakaskäynnit järjestettynä ajanjakson mukaan.
* Asiakaskäynnin lisääminen - työntekijä/hallinto
* Asiakaskäynnin muokkaaminen - työntekijä/hallinto
* Asiakaskäynnin tarkastelu - työntekijä/hallinto
* Asiakaskäyntien haku - työntekijä/hallinto
 * Tietoja voidaan hakea työntekijän, asiakkaan ja ajan perusteella

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
|Aktiivinen  | Totuusarvo           | Kuvaa onko asiakas aktiivinen (tai "käytössä oleva"). Jos on voidaan: listätä asiakaskäynti, näkyy asiakaslistauksessa (epäaktiivisille oma listaus).
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

**HUOM2. tietokantakaavio on englanniksi, koska ohjelman koodi on englanniksi.**

Kaaviosta huomataan, että käyttäjätunnus (Account) voi liittyä moneen työntekijään tai hallinto-käyttäjään. Mikään ei estä tätä. Pitää selvittää yhden suhde yhteen -liitosta lisää. Varmaan rajoitteella onnistuu.

Henkilötieto taulun, joka sisältää nimen, osoitteen jne., voisi luoda. Sitä pystyisi käyttämään Asiakas (Customer), Työntekijä (Employee) ja Hallinto (Manager) taulut. En ehtinyt toteuttamaan vielä.

## Käynnistys-/käyttöohje

Testialusta: [http://antthaap.users.cs.helsinki.fi/tsoha/](http://antthaap.users.cs.helsinki.fi/tsoha/)

**Käyttjätunnus: Testi, salasana: salasana**

Kirjaudut työntekijänä ja voit:

* Voit muokata/lisätä/poistaa asiakkaita.
* Lisätä **vain omia** asiakaskäyntejä.
* Tarkastella asiakaskäyntejä. Muokkaus/poisto kesken.

Muista laittaa päivämäärät muodossa dd.mm.yyyy ja ajat muodossa hh:mm .

**Ohjeet:**

Paina linkkiä. Käytä hiirtä ja näppäimistöä käyttääksesi sivustoa. Sivut ovat itsestäänsselvät...

## Järjestelmän yleisrakenne

Tietokantasovellusta tehdessä on noudatettu MVC-mallia. Kontrollerit, näkymät ja mallit
sijaitsevat hakemistoissa controllers, views- ja models. Käytetyt apukirjastot on sijoitettu
hakemistoon lib ja asetukset ovat tiedostossa settings.php.

Näkymät on jaettu näkymät-kansiossa mallien perusteella kansoihin.

* Asiakas (customer)
* Asiakaskäynti (customervisit)
* Työntekijä (employee)
* Käyttäjä (user) - järjestelmän käyttäjään liittyvät näkymät (mm. kirjautumissivusto)

Kontrollerit on jaettu mallien perusteella:

* Asiakaskontrolleri (customer_controller.php)
* Asiakaskäyntikontrolleri (customer_visitcontroller.php)
* Käyttäjäkontrolleri (user_controller.php)

#### Istunto

Järjestelmän käytäjällä on käyttäjätunnus, joka on liitetty tietokannassa joko työntekijä tai hallinnonjäsen taulukkoon. (Huom: hallinnonjäsen toiminnot tekemättä, mutta hyvä laajennuksen kohde jos ei valmistu)

Asiakaskäynnin luomisen yhdeydessä valitaan istunnon (sessions) perusteella asiakaskäyntiin oikea työntekijä, eli kirjautumisen perusteella työntekijä. Hallinnon jäsen voi vapaasti luoda asiakaskäyntejä. Työntekijät voivat myös muokata vain omia asiakaskäyntejään (toteuttamatta).

#### Asetukset

Tiedotossa config/enviroment.sh määritetään serveripään käyttäjätunnus. config/database.php luo tietokantayhteyden käyttäen konffattua käyttäjätunnusta.

## Käyttöliittymä ja järjestelmän komponentit

![](pictures/komponentit.png)
