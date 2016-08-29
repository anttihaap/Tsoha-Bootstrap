<?php
require 'app/models/customer.php';
class CustomerController extends BaseController{

  public static function customer_list() {
    $customers = Customer::all(array('active' => 1));      
    View::make('customer/customer_list.html',array('customers' => $customers));
  }

  public static function customer_list_inactive() {
    $customers = Customer::all(array('active' => 0));      
    View::make('customer/customer_list_inactive.html',array('customers' => $customers));
  }

  public static function customer_view($id) {
    $customer = Customer::find($id);
    View::make('customer/customer_view.html',array('customer' => $customer));
  }

  public static function customer_edit($id) {
    $customer = Customer::find($id);
    View::make('customer/customer_edit.html',array('customer' => $customer));
  }

  public static function add() {
    View::make('customer/customer_add.html');
  }

  public static function store() {
    $params = $_POST;

    $attributes = array(
      'active' => True,
      'name' => $params['name'],
      'address' => $params['address'],
      'city' => $params['city'],
      'postnumber' => $params['postnumber']
      );

    $customer = new Customer($attributes);

    $errors = $customer->errors();

    if (count($errors) == 0) {
      $customer->save();
      Redirect::to('/customer/view/' . $customer->id , array('message' => 'Asiakas lisätty!'));
    } else {
      View::make('customer/customer_add.html',array('errors' => $errors, 'attributes' => $attributes));
    }
  }

  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'name' => $params['name'],
      'address' => $params['address'],
      'city' => $params['city'],
      'postnumber' => $params['postnumber']
      );

    $customer = new Customer($attributes);
    $errors = $customer->errors();

    if (count($errors) > 0) {
      View::make('customer/customer_edit.html', array('errors' => $errors, 'customer' => $attributes));
    } else {
      $customer->update();
      Redirect::to('/customer/view/' . $customer->id, array('message' => 'Asiakasta on muokattu onnistuneesti!'));
    }
  }

  public static function destroy($id) {
    $customer = new Customer(array('id' => $id));
    if ($customer->can_destroy()) {
      Redirect::to('/customers', array('message' => 'Asiakas on poistettu onnistuneesti!'));
    } else {
      $errors[] = 'Et voi poistaa asiakasta, jolla on asiakaskäyntejä. Asiakkaan voi epäaktivoida.';
      Redirect::to('/customer/view/' . $customer->id, array('errors' => $errors));
    }
  }

  public static function activate($id) {
    if (Customer::find($id)) {
      Customer::set_active($id,1);
      Redirect::to('/customer/view/' . $id, array('message' => 'Asiakas on aktivoitu!'));
    } else {
      Redirect:to('/customer/view/' . $id, array('error' => 'Et aktivoida asiakasta, jota ei ole olemassa!'));
    }
  }

  public static function inactivate($id) {
    if (Customer::find($id)) {
      Customer::set_active($id,0);
      Redirect::to('/customer/view/' . $id, array('message' => 'Asiakas on epäaktivoitu!'));
    } else {
      Redirect:to('/customer/view/' . $id, array('error' => 'Et epäaktivoida asiakasta, jota ei ole olemassa!'));
    }
  }

} 