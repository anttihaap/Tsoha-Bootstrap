<?php
require 'app/models/customer.php';
class CustomerController extends BaseController{

  public static function customer_list() {
    $customers = Customer::all();      
    View::make('customer_list.html',array('customers' => $customers));
  }

  public static function customer_view($id) {
    $customer = Customer::find($id);
    View::make('customer_view.html',array('customer' => $customer));
  }

  public static function customer_edit($id) {
    $customer = Customer::find($id);
    View::make('customer_edit.html',array('customer' => $customer));
  }

  public static function customer_add() {
    View::make('customer_add.html');
  }

  public static function store() {
    $params = $_POST;

    $attributes = array(
      'name' => $params['name'],
      'address' => $params['address'],
      'city' => $params['city'],
      'postnumber' => $params['postnumber']
      );

    $customer = new Customer($attributes);

    $errors = $customer->errors();

    if (count($errors) == 0) {
      $customer->save();
      Redirect::to('/customer/view/' . $customer->id ,array('message' => 'Asiakas lisätty!'));
    } else {
      View::make('customer_add.html',array('errors' => $errors, 'attributes' => $attributes));
    }
  }
} 