<?php

class CustomervisitController extends BaseController{

  public static function customervisits() {
    $customers = Customer::all(array());
    $employees = Employee::all();
    View::make('customervisits/customervisits.html', array('customers' => $customers, 'employees' => $employees));
  }

  public static function customervisits_list() {
    $customervisits = Customervisit::all(array());
    View::make('customervisits/customervisit_list.html', array('customervisits' => $customervisits, 'employee_logged_in' => self::get_employee_logged_in()));
  }

  public static function view($id) {
    $customervisit = Customervisit::find($id);
    View::make('customervisits/customervisit_view.html',array('customervisit' => $customervisit));
  }

  public static function create_customervisit() {
    //List only active customers
    $customers = Customer::all(array('active' => 1));
    $employees = Employee::all();
    View::make('customervisits/create_customervisit.html',array('customers' => $customers, 'employee' => self::get_employee_logged_in()));
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
      $customers = Customer::all(array());
      View::make('customervisits/create_customervisit.html', array('errors' => $errors, 'attributes' => $attributes, 'customers' => $customers, 'employee' => self::get_employee_logged_in()));
    }
  }

  public static function edit($id) {
    $customervisit = Customervisit::find($id);

    //Check that customervisit is created by employee logged in.
    if (self::get_employee_logged_in()->id == $customervisit->employee_id) {
      $customers = Customer::all(array('active' => 1));
      View::make('customervisits/customervisit_edit.html', array('customervisit' => $customervisit, 'customers' => $customers));
    } else {
      Redirect::to('/');
    }
  }

  public static function update($id) {
    $params = $_POST;

    Kint::dump($params);
    if ($params['customer_id'] == '') {
      $customer_id = Customervisit::find($id)->customer_id;
    } else {
      $customer_id = $params['customer_id'];
    }
    $attributes = array(
      'id' => $id,
      'customer_id' => $customer_id,
      'start_date' => $params['start_date'],
      'start_time' => $params['start_time'],
      'end_date' => $params['end_date'],
      'end_time' => $params['end_time'],
      'description' => $params['description']
      );

    $customervisit = new Customervisit($attributes);
    $errors = $customervisit->errors();
    if (count($errors) > 0) {
      Redirect::to('/customervisit/edit/' . $id, array('attributes' => $attributes, 'errors' => $errors));
    } else {
      $customervisit->update();
      Redirect::to('/customervisit/' . $id, array('message' => 'Asiakaskäynti päivitetty onnistuneesti!'));      
    }
  }

  public static function destroy($id) {
    $customervisit = new Customervisit(array('id' => $id));
    $customervisit->destroy();
    Redirect::to('/customervisits/list', array('message' => 'Asiakaskäynti on poistettu onnistuneesti!'));
  }

  public static function search() {
    $params = $_POST;

    //Tyhjennetään tyhjät arvot.
    foreach ($params as $key => $value) {
      if (empty($value)) {
        unset($params[$key]);
      }
    }

    $errors = array();
    if (isset($params['start_date']) && !DateValidator::date_is_valid($params['start_date'])) {
      $errors[] = 'Alkamispäivämäärän tulee olla muotoa dd.mm.yyyy .';
    }
    if (isset($params['start_time']) && !DateValidator::time_is_valid($params['start_time'])) {
      $errors[] = 'Alkisajan tulee olla muotoa HH:MM .';
    }
    if (isset($params['end_date']) && !DateValidator::date_is_valid($params['end_date'])) {
      $errors[] = 'Loppumispäivämäärän tulee olla muotoa dd.mm.yyyy.';
    }
    if (isset($params['end_time']) && !DateValidator::time_is_valid($params['end_time'])) {
      $errors[] = 'Loppumisajan tulee olla muotoa HH:MM .';
    }

    if (count($errors) > 0) {
      Redirect::to('/customervisits', array('errors' => $errors, 'attributes' => $params));
    } else {
      View::make('customervisits/customervisit_list.html', array('customervisits' => Customervisit::search($params)));
    }
  }
}