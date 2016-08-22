<?php

class HelloWorldController extends BaseController{

  public static function index() {
    View::make('home.html');
  }

  public static function sandbox() {
    Kint::dump(DateTimeParser::time_to_sql_time("00:00"));
  }
}
