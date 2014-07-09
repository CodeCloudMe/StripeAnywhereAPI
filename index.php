<?php


// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Stripe needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Stripe needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Stripe needs the Multibyte String PHP extension.');
}

// Stripe singleton
require(dirname(__FILE__) . '/Stripe/Stripe.php');

// Utilities
require(dirname(__FILE__) . '/Stripe/Util.php');
require(dirname(__FILE__) . '/Stripe/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/Stripe/Error.php');
require(dirname(__FILE__) . '/Stripe/ApiError.php');
require(dirname(__FILE__) . '/Stripe/ApiConnectionError.php');
require(dirname(__FILE__) . '/Stripe/AuthenticationError.php');
require(dirname(__FILE__) . '/Stripe/CardError.php');
require(dirname(__FILE__) . '/Stripe/InvalidRequestError.php');

// Plumbing
require(dirname(__FILE__) . '/Stripe/Object.php');
require(dirname(__FILE__) . '/Stripe/ApiRequestor.php');
require(dirname(__FILE__) . '/Stripe/ApiResource.php');
require(dirname(__FILE__) . '/Stripe/SingletonApiResource.php');
require(dirname(__FILE__) . '/Stripe/List.php');

// Stripe API Resources
require(dirname(__FILE__) . '/Stripe/Account.php');
require(dirname(__FILE__) . '/Stripe/Card.php');
require(dirname(__FILE__) . '/Stripe/Charge.php');
require(dirname(__FILE__) . '/Stripe/Customer.php');
require(dirname(__FILE__) . '/Stripe/Invoice.php');
require(dirname(__FILE__) . '/Stripe/InvoiceItem.php');
require(dirname(__FILE__) . '/Stripe/Plan.php');
require(dirname(__FILE__) . '/Stripe/Token.php');
require(dirname(__FILE__) . '/Stripe/Coupon.php');
require(dirname(__FILE__) . '/Stripe/Event.php');
require(dirname(__FILE__) . '/Stripe/Transfer.php');
require(dirname(__FILE__) . '/Stripe/Recipient.php');


// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://manage.stripe.com/account
Stripe::setApiKey("sk_live_4NEAU0xFY2JWyBwTZhVfkTiy");

// Get the credit card details submitted by the form
//$token = $_POST['stripeToken'];

extract($_REQUEST);

if(!isset($number)){

  $response = array("status"=>"fail", "resp"=>"Please send CC number");
  echo(json_encode($response));
    return;
}

if(!isset($expMonth)){

  $response = array("status"=>"fail", "resp"=>"Please send Expiration Month");
  echo(json_encode($response));
    return;
}

if(!isset($expYear)){

  $response = array("status"=>"fail", "resp"=>"Please send Expiration Year");
  echo(json_encode($response));
    return;
}

if(!isset($cvc)){

  $response = array("status"=>"fail", "resp"=>"Please send CVC");
  echo(json_encode($response));
    return;
}

if(!isset($amount)){

  $response = array("status"=>"fail", "resp"=>"Please send amount");
  echo(json_encode($response));
    return;
}

if(!isset($description)){

  $description="mobile app purchase";
}


$amount = intval($amount);

$token= array("number"=>$number, "exp_month"=>$expMonth, "exp_year"=>$expYear, "cvc"=>$cvc);


// Create the charge on Stripe's servers - this will charge the user's card

try {
$charge = Stripe_Charge::create(array(
  "amount" => $amount, // amount in cents, again
  "currency" => "usd",
  "card" => $token,
  "description" => $description)
);
  $response = array("status"=>"success", "resp"=>"Payment processed");
    
    $jResponse = json_encode($response);
    echo($jResponse);


//header( 'Location: http://thecoded.com/appfactory/register/accepted.html' ) ;
} catch(Stripe_CardError $e) {
  // The card has been declined
$response = array("status"=>"fail", "resp"=>"Payment wasn't processed ");

    $jResponse = json_encode($response);
    echo($jResponse);
  //header( 'Location: http://thecoded.com/appfactory/register/declined.html' ) ;
}



?>