<?php

class HelloWorldController extends BaseController{

  public static function index() {
    View::make('home.html');
  }

  public static function sandbox() {
  	Kint::dump(self::get_employee_logged_in());
  	Kint::dump(self::get_user_logged_in());
  }
}
