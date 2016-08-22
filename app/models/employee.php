<?php

class Employee extends BaseModel {

	public $id, $first_name, $last_name;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Employee ORDER BY last_name, first_name');
		$query->execute();
		$rows = $query->fetchAll();

		$employees = array();
		foreach ($rows as $row) {
			$employees[] = new self(array(
				'id' => $row['id'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name']
				));
		}
		return $employees;
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Employee WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if ($row) {
			$employee = new self(array(
				'id' => $row['id'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name']
				));

			return $employee;
		}

		return null;
	}

	public static function find_by_account_id($id) {
		$query = DB::connection()->prepare('SELECT * FROM Employee WHERE account_id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if ($row) {
			$employee = new self(array(
				'id' => $row['id'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name']
				));

			return $employee;
		}

		return null;
	}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Employee (first_name, last_name, city, postnumber) VALUES (:name, :address, :city, :postnumber) RETURNING id');
		$query->execute(array('name' => $this->name, 'city' => $this->city, 'address' => $this->address, 'postnumber' => intval($this->postnumber)));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}