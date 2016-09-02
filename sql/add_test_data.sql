-- ACCOUNTS
INSERT INTO Account (name, password) VALUES ('Testi','salasana'); --Antti Työläinen, id = 1
INSERT INTO Account (name, password) VALUES ('Testi2','salasana'); --Pekka Työläinen, id = 2

-- CUSTOMERS
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (True, 'Matti Meikäläinen', 'Mannerheimintie 1 A 1', 'Helsinki', 0);
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (True, 'Pentti Penttinen', 'Mannerheimintie 1 A 1', 'Helsinki', 1);
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (False, 'Epäaktiivinen asiakas', 'Mannerheimintie 1 A 1', 'Helsinki', 1);

-- EMPLOYEES
INSERT INTO Employee (first_name, last_name, account_id) VALUES ('Pentti', 'Työläinen',2); --id = 1
INSERT INTO Employee (first_name, last_name, account_id) VALUES ('Antti', 'Työläinen',1); --id = 2
INSERT INTO Employee (first_name, last_name) VALUES ('Pekka', 'Työläinen'); --id = 3



-- CUSTOMERVISITS
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (1,1,'2016-1-1','08:00:00','2016-1-1','12:00:00', 'Pekan käynti1');
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (1,1,'2016-1-2','08:00:00','2016-1-1','12:00:00', 'Pekan käynti2');
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (1,1,'2016-1-3','08:00:00','2016-1-1','12:00:00', 'Pekan käynti3');
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (2,2,'2016-1-1','09:00:00','2016-1-1','10:00:00', 'Pesukone korjattu jne. emt.');