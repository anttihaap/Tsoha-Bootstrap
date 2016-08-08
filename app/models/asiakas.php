<?php

class Asiakas extends BaseModel {
  public $id, $nimi, $osoite, $kaupunki, $postinumero;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array('validate_name_length');
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Customer');
    $query->execute();
    $rows = $query->fetchAll();

    $asiakkaat = array();
    foreach ($rows as $row) {
      $asiakkaat[] = new self(array(
        'id' => $row['id'],
        'nimi' => $row['name'],
        'osoite' => $row['address'],
        'kaupunki' => $row['city'],
        'postinumero' => $row['postnumber'],
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
        'nimi' => $row['name'],
        'osoite' => $row['address'],
        'kaupunki' => $row['city'],
        'postinumero' => $row['postnumber'],
        ));

      return $asiakas;
    }

    return null;
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO Customer (name, address, city, postnumber) VALUES (:name, :address, :city, :postnumber) RETURNING id');
    $query->execute(array('name' => $this->nimi, 'city' => $this->kaupunki, 'address' => $this->osoite, 'postnumber' => intval($this->postinumero)));
    $row = $query->fetch();
    $this->id = $row['id'];
  }


}
