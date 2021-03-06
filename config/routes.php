<?php

function check_logged_in() {
  BaseController::check_logged_in();
}

$routes->get('/', function() {
  HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
});


//LOGIN
$routes->get('/login', function() {
  UserController::login();
});

$routes->post('/login', function() {
  UserController::handle_login();
});

$routes->post('/logout', function() {
  UserController::logout();
});

  //CUSTOMER
$routes->get('/customers', 'check_logged_in', function() {
  CustomerController::customer_list();
});

$routes->get('/customers/inactive', 'check_logged_in', function() {
  CustomerController::customer_list_inactive();
});

$routes->post('/customer', 'check_logged_in', function() {
  CustomerController::store();
});

$routes->get('/customer/add', 'check_logged_in', function() {
  CustomerController::add();
});

$routes->get('/customer/view/:id', 'check_logged_in', function($id) {
  CustomerController::customer_view($id);
});

$routes->get('/customer/edit/:id', 'check_logged_in', function($id) {
  CustomerController::customer_edit($id);
});

$routes->post('/customer/edit/:id', 'check_logged_in', function($id) {
  CustomerController::update($id);
});

$routes->post('/customer/destroy/:id', 'check_logged_in', function($id) {
  CustomerController::destroy($id);
});

$routes->post('/customer/activate/:id', 'check_logged_in', function($id) {
  CustomerController::activate($id);
});

$routes->post('/customer/inactivate/:id', 'check_logged_in', function($id) {
  CustomerController::inactivate($id);
});

  //CUSTOMERVISITS
$routes->get('/customervisits', 'check_logged_in', function() {
  CustomervisitController::customervisits();
});

$routes->get('/customervisits/list', 'check_logged_in', function() {
  CustomervisitController::customervisits_list();
});

$routes->get('/customervisit/new', 'check_logged_in', function() {
  CustomervisitController::create_customervisit();
});

$routes->post('/customervisit', 'check_logged_in', function() {
  CustomervisitController::store();
});

$routes->get('/customervisit/:id', 'check_logged_in', function($id) {
  CustomervisitController::view($id);
});

$routes->post('/customervisit/edit/:id', 'check_logged_in', function($id) {
  CustomervisitController::update($id);
});

$routes->get('/customervisit/edit/:id', 'check_logged_in', function($id) {
  CustomervisitController::edit($id);
});

$routes->post('/customervisit/destroy/:id', 'check_logged_in', function($id) {
  CustomervisitController::destroy($id);
});

$routes->post('/customervisit/search', 'check_logged_in', function() {
  CustomervisitController::search();
});