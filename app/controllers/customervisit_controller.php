<?php

class CustomervisitController extends BaseController{

  public static function customervisits() {
    View::make('customervisits.html');
  }

  public static function customervisits_list() {
    $customervisits = Customervisit::all();
    View::make('customervisits/customervisit_list.html', array('customervisits' => $customervisits));
  }

  public static function view($id) {
    $customervisit = Customervisit::find($id);
    View::make('customervisits/customervisit_view.html',array('customervisit' => $customervisit));
  }

  public static function create_customervisit() {
    $customers = Customer::all();
    $employees = Employee::all();
    View::make('create_customervisit.html',array('customers' => $customers, 'employee' => self::get_employee_logged_in()));
  }

  public static function store() {
    $params = $_POST;

    $attributes = array(
      'customer_id' => $params['customer_id'],
      'employee_id' => self::get_employee_logged_in()->id,
      'start_date' => $params['start_date'],
      'start_time' => $params['start_time'],
      'end_date' => $params['end_date'],
      'end_time' => $params['end_time'],
      'description' => $params['description']
      );

    $customervisit = new Customervisit($attributes);
    $errors = $customervisit->errors();
    if (count($errors) == 0) {
      $customervisit->save();
      Redirect::to('/customervisits/list', array('message' => 'Asiakaskäynti lisätty!'));
    } else {
      $customers = Customer::all();
      View::make('create_customervisit.html', array('errors' => $errors, 'attributes' => $attributes, 'customers' => $customers, 'employee' => self::get_employee_logged_in()));
    }
  }
}