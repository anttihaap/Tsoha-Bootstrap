CREATE TABLE Account(
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
	account_id INTEGER REFERENCES Account(id)
);

CREATE TABLE Manager(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	account_id INTEGER REFERENCES Useraccount(id)
);

CREATE TABLE Customervisit(
	id SERIAL PRIMARY KEY,
	customer_id INTEGER REFERENCES Customer(id),
	employee_id INTEGER REFERENCES Employee(id),
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	start_time TIME NOT NULL,
	end_time TIME NOT NULL
);