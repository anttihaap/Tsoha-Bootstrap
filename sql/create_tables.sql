CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	salasana varchar(50) NOT NULL,
);

CREATE TABLE Asiakas(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	osoite varchar(100),
	kaupunki varchar(50),
	postinumero INTEGER
);

CREATE TABLE Tyontekija(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL
);

CREATE TABLE Asiakaskaynti(
	id SERIAL PRIMARY KEY,
	asiakas_id INTEGER REFERENCES Asiakas(id),
	tyontekija_id INTEGER REFERENCES Tyontekija(id),
	paivamaara DATE,
	alkamisaika TIME,
	paattymisaika TIME
);
