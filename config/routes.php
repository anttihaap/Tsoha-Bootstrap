<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  //CUSTOMER
  $routes->get('/customers', function() {
    CustomerController::customer_list();
  });

  $routes->post('/customer', function() {
    CustomerController::store();
  });

  $routes->get('/customer/add', function() {
    CustomerController::customer_add();
  });

  $routes->get('/customer/edit/:id', function($id) {
    CustomerController::customer_edit($id);
  });

  //CUSTOMERVISITS
    $routes->get('/customervisits', function() {
    CustomervisitController::customervisits();
  });

  $routes->get('/customervisit/new', function() {
    CustomervisitController::create_customervisit();
  });
