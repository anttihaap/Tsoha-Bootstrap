<?php
  require 'app/models/asiakas.php';
  class CustomervisitController extends BaseController{

    public static function customervisits() {
      View::make('customervisits.html');
    }

    public static function create_customervisit() {
      $asiakkaat = Asiakas::all();
      View::make('create_customervisit.html',array('asiakkaat' => $asiakkaat));
    }
  }