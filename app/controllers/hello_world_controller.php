<?php
  class HelloWorldController extends BaseController{

    public static function index() {
   	  View::make('home.html');
    }

    public static function sandbox() {
      $asiakas = Asiakas::find(1);
      Kint::dump($asiakas);
    }

    public static function login() {
      View::make('login.html');
    }
  }
