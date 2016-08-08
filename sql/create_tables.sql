CREATE TABLE User(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Customer(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	address varchar(120),
	city varchar(50),
	postnumber INTEGER
);

CREATE TABLE Employee(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
   user_id INTEGER REFERENCES User(id)
);

CREATE TABLE Manager(
   id SERIAL PRIMARY KEY,
   name varchar(50) NOT NULL,
   user_id INTEGER REFERENCES User(id)
);

CREATE TABLE Customervisit(
	id SERIAL PRIMARY KEY,
	customer_id INTEGER REFERENCES Asiakas(id),
	employee_id INTEGER REFERENCES Tyontekija(id),
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	start_time TIME NOT NULL,
	end_time TIME NOT NULL
);
