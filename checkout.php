<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_559bd2hzgvktniqwkiw');
define('OMISE_SECRET_KEY', 'skey_test_559aqx4qryuaovs3ksq');

// $customer = OmiseCustomer::create(array(
//   'email' => 'john.doe@example.com',
//   'description' => 'John Doe (id: 30)',
//   'card' => $_POST['omise_token']
// ));

$charge = OmiseCharge::create(array(
  'amount'=> 100025,
  'currency'=> "thb",
  'description'=> "Order-345678",
  'customer'=> "cust_test_559blge114331sd4txq"
));

// $allCustomers = OmiseCustomer::retrieve();
var_dump($charge);

// echo $_POST['omise_token'] . " success</br>";
echo "</br>success</br>";
?>