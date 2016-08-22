<?php

class BaseController{

  public static function check_logged_in () {
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
  }

  public static function get_user_logged_in(){
    if (isset($_SESSION['user'])) {
      $user_id = $_SESSION['user'];

      $account = Account::find($user_id);
      return $account;
    } else {
      return null;
    }
  }

  public static function get_employee_logged_in() {
    if (isset($_SESSION['user'])) {
      $user_id = $_SESSION['user'];

      $employee = Employee::find_by_account_id($user_id);
      return $employee;
    }
    return null;
  }

}
