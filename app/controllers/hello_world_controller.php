<?php
require 'app/models/customer.php';
class HelloWorldController extends BaseController{

  public static function index() {
    View::make('home.html');
  }

  public static function sandbox() {
    $asiakas = new Customer(array(
      'id' => 1,
      'name' => '',
      'address' => 'Osoite',
      'city' => 'Kaupunki',
      'postnumber' => 0
      ));
    $errors = $asiakas->errors();
    Kint::dump($asiakas);
    Kint::dump($errors);
  }

  public static function login() {
    View::make('login.html');
  }
}
