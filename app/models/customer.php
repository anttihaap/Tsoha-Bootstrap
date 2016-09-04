<?php
require 'lib/string_validator.php';
class Customer extends BaseModel {
  public $id, $active, $name, $address, $city, $postnumber;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_postnumber');
  }

  public static function all($options) {
    $query_string = 'SELECT * FROM Customer';
    if (isset($options['active'])) {
      $query_string .= ' WHERE active = :active';
    }
    $query_string .= ' ORDER BY name';
    $query = DB::connection()->prepare($query_string);
    $query->execute($options);
    $rows = $query->fetchAll();

    $asiakkaat = array();
    foreach ($rows as $row) {
      $asiakkaat[] = new self(array(
        'id' => $row['id'],
        'active' => $row['active'],
        'name' => $row['name'],
        'address' => $row['address'],
        'city' => $row['city'],
        'postnumber' => $row['postnumber'],
        ));
    }
    return $asiakkaat;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Customer WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if ($row) {
      $asiakas = new self(array(
        'id' => $row['id'],
        'active' => $row['active'],
        'name' => $row['name'],
        'address' => $row['address'],
        'city' => $row['city'],
        'postnumber' => $row['postnumber'],
        ));

      return $asiakas;
    }

    return null;
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO Customer (active, name, address, city, postnumber) VALUES (True, :name, :address, :city, :postnumber) RETURNING id');
    $query->execute(array('name' => $this->name, 'city' => $this->city, 'address' => $this->address, 'postnumber' => intval($this->postnumber)));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update() {
    $query = DB::connection()->prepare('UPDATE Customer SET name=:name, address=:address, city=:city, postnumber=:postnumber WHERE id = :id');
    $query->execute(array('id' => $this->id, 'active' => $this->active, 'name' => $this->name, 'city' => $this->city, 'address' => $this->address, 'postnumber' => intval($this->postnumber)));
  }

  public function destroy() {
    $query = DB::connection()->prepare('DELETE FROM Customer WHERE id=:id');
    $query->execute(array('id' => $this->id));
  }

  public function set_active($id, $bool_int) {
    $query = DB::connection()->prepare('UPDATE Customer SET active=:bool_int WHERE id=:id');
    $query->execute(array('id' => $id, 'bool_int' => $bool_int));
  }

  //Checks if customer is in customervisits. If it is, you cant delete.
  public function can_destroy() {
    $query = DB::connection()->prepare('SELECT * FROM Customervisit WHERE customer_id=:id LIMIT 1');
    $query->execute(array('id' => $this->id));
    $row = $query->fetch();
    //There should be no customervisits for customer.
    return empty($row);
  }

  public function validate_name() {
    $errors = array();
    if ($this->name == '' || $this->name == null) {
      $errors[] = 'Nimi ei saa olla tyhjä!';
    }
    if (strlen($this->name) < 4) {
      $errors[] = 'Nimen pituuden tulee olla vähintään 4 merkkiä!';
    }
    return $errors;
  }

  public function validate_postnumber() {
    $errors = array();
    //postnumber can be empty
    if ($this->postnumber == '') {
      return $errors;
    }
    if (!ctype_digit($this->postnumber) || intval($this->postnumber) >= 9999 || intval($this->postnumber) < 0) {
      $errors[] = 'Postinumeron tulee olla väliltä 0000-9999 tai tyhjä.';
    }
    return $errors;
  }

}