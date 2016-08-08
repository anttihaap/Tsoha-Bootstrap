CREATE TABLE User(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Customer(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	address varchar(100),
	city varchar(50),
	postnumber INTEGER
);

CREATE TABLE Employee(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL
);

CREATE TABLE Customervisit(
	id SERIAL PRIMARY KEY,
	customer_id INTEGER REFERENCES Asiakas(id),
	employee_id INTEGER REFERENCES Tyontekija(id),
	start_date DATE,
	end_date DATE,
	start_time TIME,
	end_time TIME
);
