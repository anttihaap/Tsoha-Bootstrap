<?php
  require 'app/models/customer.php';
  require 'app/models/employee.php';
  class CustomervisitController extends BaseController{

    public static function customervisits() {
      View::make('customervisits.html');
    }

    public static function create_customervisit() {
      $customers = Customer::all();
      $employees = Employee::all();
      View::make('create_customervisit.html',array('customers' => $customers, 'employees' => $employees));
    }
  }