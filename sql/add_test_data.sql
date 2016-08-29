-- ACCOUNTS
INSERT INTO Account (name, password) VALUES ('Testi','salasana');

-- CUSTOMERS
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (True, 'Matti Meikäläinen', 'Mannerheimintie 1 A 1', 'Helsinki', 0);
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (True, 'Pentti Penttinen', 'Mannerheimintie 1 A 1', 'Helsinki', 1);
INSERT INTO Customer (active, name, address, city, postnumber) VALUES (False, 'Epäaktiivinen asiakas', 'Mannerheimintie 1 A 1', 'Helsinki', 1);

-- EMPLOYEES
INSERT INTO Employee (first_name, last_name) VALUES ('Pentti', 'Työläinen');
INSERT INTO Employee (first_name, last_name) VALUES ('Pekka', 'Työläinen');
INSERT INTO Employee (first_name, last_name, account_id) VALUES ('Antti', 'Työläinen',1);



-- CUSTOMERVISITS
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (1,1,'2016-1-1','08:00:00','2016-1-1','12:00:00', 'Lamppu tippu katosta, no nyt se on katossa taas.');
INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (2,2,'2016-1-1','09:00:00','2016-1-1','10:00:00', 'Pesukone korjattu jne. emt.');