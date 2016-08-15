<?php

class Employee extends BaseModel {

	public $id, $name;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Employee ORDER BY name');
		$query->execute();
		$rows = $query->fetchAll();

		$employees = array();
		foreach ($rows as $row) {
			$employees[] = new self(array(
				'id' => $row['id'],
				'name' => $row['name'],
				));
		}
		return $employees;
	}
}