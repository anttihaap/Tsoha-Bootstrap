<?php

class Customervisit extends BaseModel {

	public $id, $customer_id, $employee_id, $start_date, $start_time, $end_date, $end_time, $description, $employee_first_name, $employee_last_name, $customer_name;

	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array('validate_start_date', 'validate_start_time', 'validate_end_date', 'validate_end_time');
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT Customervisit.id, Customervisit.customer_id, Customervisit.employee_id, Customervisit.start_date, Customervisit.start_time, Customervisit.end_date, Customervisit.end_time, Customervisit.description, Employee.last_name AS employee_last_name, Employee.first_name AS employee_first_name, Customer.name AS customer_name FROM Customervisit
			INNER JOIN Customer
			ON Customervisit.customer_id=Customer.id
			INNER JOIN Employee 
			ON Customervisit.employee_id=Employee.id');
		$query->execute();
		$rows = $query->fetchAll();

		$customer_visits = array();
		foreach ($rows as $row) {
			$customer_visits[] = new self(array(
				'id' => $row['id'],
				'customer_id' => $row['customer_id'],
				'employee_id' => $row['employee_id'],
				'start_date' => $row['start_date'],
				'start_time' => $row['start_time'],
				'end_date' => $row['end_date'],
				'end_time' => $row['end_time'],
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
				'start_date' => $row['start_date'],
				'start_time' => $row['start_time'],
				'end_date' => $row['end_date'],
				'end_time' => $row['end_time'],
				'description' => $row['description'],
				'employee_first_name' => $row['employee_first_name'],
				'employee_last_name' => $row['employee_last_name'],
				'customer_name' => $row['customer_name']
				));

			return $customervisit;
		}

		return null;
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