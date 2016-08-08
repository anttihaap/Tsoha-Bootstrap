<?php
require 'app/models/asiakas.php';
class CustomerController extends BaseController{

  public static function customer_list() {
    $asiakkaat = Asiakas::all();      
    View::make('customer_list.html',array('asiakkaat' => $asiakkaat));
  }

  public static function customer_view($id) {
    $asiakas = Asiakas::find($id);
    View::make('customer_view.html',array('asiakas' => $asiakas));
  }

  public static function customer_edit($id) {
    $asiakas = Asiakas::find($id);
    View::make('customer_edit.html',array('asiakas' => $asiakas));
  }

  public static function customer_add() {
    View::make('customer_add.html');
  }

  public static function store() {
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
    $asiakas = new Asiakas(array(
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kaupunki' => $params['kaupunki'],
      'postinumero' => $params['postinumero']
      ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      $asiakas->save();
      Redirect::to('/customer/edit/' . $asiakas->id);
  }
} 