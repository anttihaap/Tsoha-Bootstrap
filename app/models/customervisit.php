<?php

class Customervisit extends BaseModel {

	public $id, $customer_id, $employee_id, $start_date, $start_time, $end_date, $end_time, $description, $employee_first_name, $employee_last_name, $customer_name;

	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array('validate_start_date', 'validate_start_time', 'validate_end_date', 'validate_end_time');
	}

	public static function all($options) {
		$query_string = 'SELECT Customervisit.id, Customervisit.customer_id, Customervisit.employee_id, Customervisit.start_date, Customervisit.start_time, Customervisit.end_date, Customervisit.end_time, Customervisit.description, Employee.last_name AS employee_last_name, Employee.first_name AS employee_first_name, Customer.name AS customer_name FROM Customervisit
		INNER JOIN Customer
		ON Customervisit.customer_id=Customer.id
		INNER JOIN Employee 
		ON Customervisit.employee_id=Employee.id';

		$where_options = array();
		if (isset($options['customer_id'])) {
			$where_options[] = 'customer_id = ' . $options['customer_id'];
		}
		if (isset($options['employee_id'])) {
			$where_options[] = 'employee_id = ' . $options['employee_id'];
		}

		$query_string .= ' ORDER BY Customervisit.start_date, Customervisit.start_time';
		$query = DB::connection()->prepare($query_string);
		$query->execute($options);
		$rows = $query->fetchAll();

		$customer_visits = array();
		foreach ($rows as $row) {
			$customer_visits[] = new self(array(
				'id' => $row['id'],
				'customer_id' => $row['customer_id'],
				'employee_id' => $row['employee_id'],
				'start_date' => DateTimeParser::sql_date_to_date($row['start_date']),
				'start_time' => DateTimeParser::sql_time_to_time($row['start_time']),
				'end_date' => DateTimeParser::sql_date_to_date($row['end_date']),
				'end_time' => DateTimeParser::sql_time_to_time($row['end_time']),
				'description' => $row['description'],
				'employee_first_name' => $row['employee_first_name'],
				'employee_last_name' => $row['employee_last_name'],
				'customer_name' => $row['customer_name']
				));
		}
		return $customer_visits;
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT Customervisit.id, Customervisit.customer_id, Customervisit.employee_id, Customervisit.start_date, Customervisit.start_time, Customervisit.end_date, Customervisit.end_time, Customervisit.description, Employee.last_name AS employee_last_name, Employee.first_name AS employee_first_name, Customer.name AS customer_name FROM Customervisit
			INNER JOIN Customer
			ON Customervisit.customer_id=Customer.id
			INNER JOIN Employee 
			ON Customervisit.employee_id=Employee.id
			WHERE Customervisit.id = :id
			LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if ($row) {
			$customervisit = new self(array(
				'id' => $row['id'],
				'customer_id' => $row['customer_id'],
				'employee_id' => $row['employee_id'],
				'start_date' => DateTimeParser::sql_date_to_date($row['start_date']),
				'start_time' => DateTimeParser::sql_time_to_time($row['start_time']),
				'end_date' => DateTimeParser::sql_date_to_date($row['end_date']),
				'end_time' => DateTimeParser::sql_time_to_time($row['end_time']),
				'description' => $row['description'],
				'employee_first_name' => $row['employee_first_name'],
				'employee_last_name' => $row['employee_last_name'],
				'customer_name' => $row['customer_name']
				));

			return $customervisit;
		}

		return null;
	}

	public function update() {
		$query = DB::connection()->prepare('UPDATE Customervisit SET customer_id=:customer_id, start_date=:start_date, start_time=:start_time, end_date=:end_date, end_time=:end_time, description=:description WHERE id = :id');
		$query->execute(array('customer_id' => $this->customer_id, 'start_date' => $this->start_date, 'start_time' => $this->start_time, 'end_date' => $this->end_date, 'end_time' => $this->end_time, 'description' => $this->description, 'id' => $this->id));
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Customervisit WHERE id=:id');
		$query->execute(array('id' => $this->id));
	}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Customervisit (customer_id, employee_id, start_date, start_time, end_date, end_time, description) VALUES (:customer_id, :employee_id, :start_date, :start_time, :end_date, :end_time, :description) RETURNING ID');

		$start_date = DateTimeParser::date_to_sql_date($this->start_date);
		$start_time = DateTimeParser::time_to_sql_time($this->start_time);
		$end_date = DateTimeParser::date_to_sql_date($this->end_date);
		$end_time = DateTimeParser::time_to_sql_time($this->end_time);

		$query->execute(array('customer_id' => $this->customer_id, 'employee_id' => $this->employee_id, 'start_date' => $start_date, 'start_time' => $start_time, 'end_date' => $end_date, 'end_time' => $end_time, 'description' => $this->description));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public static function search($options) {
		$query_string = 'SELECT Customervisit.id, Customervisit.customer_id, Customervisit.employee_id, Customervisit.start_date, Customervisit.start_time, Customervisit.end_date, Customervisit.end_time, Customervisit.description, Employee.last_name AS employee_last_name, Employee.first_name AS employee_first_name, Customer.name AS customer_name
		FROM Customervisit
		INNER JOIN Customer
		ON Customervisit.customer_id=Customer.id
		INNER JOIN Employee
		ON Customervisit.employee_id=Employee.id
		';
		$where_statement = 'WHERE';
		if (isset($options['customer_id'])) {
			$where_statement  .= ' Customervisit.customer_id = ' . $options['customer_id'] . ' AND ';
		}
		if (isset($options['employee_id'])) {
			$where_statement .= ' Customervisit.employee_id = ' . $options['employee_id'] . ' AND ';
		}
		if (isset($options['start_date'])) {
			$where_statement .= " Customervisit.start_date >= '" . DateTimeParser::date_to_sql_date($options['start_date']) . "' AND ";
		}
		if (isset($options['start_time'])) {
			$where_statement .= " Customervisit.start_time >='" . DateTimeParser::time_to_sql_time($options['start_time']) . "' AND ";
		}
		if (isset($options['end_date'])) {
			$where_statement .= " Customervisit.start_date <= '" . DateTimeParser::date_to_sql_date($options['end_date']) . "' AND ";
		}
		if (isset($options['end_time'])) {
			$where_statement .= " Customervisit.start_time <= '" . DateTimeParser::time_to_sql_time($options['end_time']) . "' AND ";
		}

		//DDD - Deadline Driven Development
		$where_statement .= ' 1=1';
		$query_string .= $where_statement;
		$query = DB::connection()->prepare($query_string);
		$query->execute();
		$rows = $query->fetchAll();

		$customer_visits = array();
		foreach ($rows as $row) {
			$customer_visits[] = new self(array(
				'id' => $row['id'],
				'customer_id' => $row['customer_id'],
				'employee_id' => $row['employee_id'],
				'start_date' => DateTimeParser::sql_date_to_date($row['start_date']),
				'start_time' => DateTimeParser::sql_time_to_time($row['start_time']),
				'end_date' => DateTimeParser::sql_date_to_date($row['end_date']),
				'end_time' => DateTimeParser::sql_time_to_time($row['end_time']),
				'description' => $row['description'],
				'employee_first_name' => $row['employee_first_name'],
				'employee_last_name' => $row['employee_last_name'],
				'customer_name' => $row['customer_name']
				));
		}
		return $customer_visits;
		
	}

	public function validate_start_date() {
		$errors = array();
		if (!DateValidator::date_is_valid($this->start_date)) {
			$errors[] = 'Alkamispäivämäärän tulee olla muotoa pp.kk.yyyy';
		}
		return $errors;
	}

	public function validate_end_date() {
		$errors = array();
		if (!DateValidator::date_is_valid($this->end_date)) {
			$errors[] = 'Loppumispäivämäärän tulee olla muotoa pp.kk.yyyy';
		}
		return $errors;
	}

	public function validate_start_time() {
		$errors = array();
		if (!DateValidator::time_is_valid($this->start_time)) {
			$errors[] = 'Alkamisajan tulee olla muotoa HH:MM';
		}
		return $errors;
	}

	public function validate_end_time() {
		$errors = array();
		if (!DateValidator::time_is_valid($this->end_time)) {
			$errors[] = 'Loppumisajan tulee olla muotoa HH:MM';
		}
		return $errors;
	}

}