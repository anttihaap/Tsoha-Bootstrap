<?php

class Asiakas extends BaseModel {
  public $id, $nimi, $osoite, $kaupunki, $postinumero;

  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Asiakas');
    $query->execute();
    $rows = $query->fetchAll();

    $asiakkaat = array();
    foreach ($rows as $row) {
      $asiakkaat[] = new self(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite'],
        'kaupunki' => $row['kaupunki'],
        'postinumero' => $row['postinumero'],
        ));
    }
    return $asiakkaat;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if ($row) {
      $asiakas = new self(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite'],
        'kaupunki' => $row['kaupunki'],
        'postinumero' => $row['postinumero'],
        ));

      return $asiakas;
    }

    return null;
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO Asiakas (nimi, osoite, kaupunki, postinumero) VALUES (:nimi, :osoite, :kaupunki, :postinumero) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('nimi' => $this->nimi, 'kaupunki' => $this->kaupunki, 'osoite' => $this->osoite, 'postinumero' => $this->postinumero));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->id = $row['id'];
  }


}
