<?php

class Account extends BaseModel {

  public $id, $name, $password;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array();
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if ($row) {
      $account = new self(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
        ));

      return $account;
    }

    return null;
  }

  public static function authenticate($name, $password) {
    $query = DB::connection()->prepare('SELECT * FROM Account WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if ($row) {
      $account = new self(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
        ));

      return $account;
    } else {
      return null;
    }
  }
}