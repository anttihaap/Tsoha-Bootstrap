<?php

class HelloWorldController extends BaseController{

  public static function index() {
    View::make('home.html');
  }

  public static function sandbox() {
    Kint::dump(intval("013"));
    Kint::dump(intval("0"));
    Kint::dump(intval("00"));
  }
}
