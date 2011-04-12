<?php

class PaypalComponent extends Object {

  function PPHttpPost($methodName_, $nvpStr_) {
    global $environment;

    // Set up your API credentials, PayPal end point, and API version.
    $API_UserName = urlencode('rajiv_1260539217_biz_api1.xclusiveminds.com');
    $API_Password = urlencode('1260539222');
    $API_Signature = urlencode('AQEiF7.WIlKJaFylDmTeLMrMnLwxA5A4LlAhi2KJXa-VbwTqIrnxKMff');
    $API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
    $version = urlencode('51.0');

    // Set the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);

    // Turn off the server and peer verification (TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Set the API operation, version, and API signature in the request.
    $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

    // Set the request as a POST FIELD for curl.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

    // Get response from the server.
    $httpResponse = curl_exec($ch);

    if(!$httpResponse) {
      exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
    }

    // Extract the response details.
    $httpResponseAr = explode("&", $httpResponse);

    $httpParsedResponseAr = array();
    foreach ($httpResponseAr as $i => $value) {
      $tmpAr = explode("=", $value);
      if(sizeof($tmpAr) > 1) {
        $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
      }
    }

    if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
      exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
    }

    return $httpParsedResponseAr;
  }

  function do_payment($details) {

    // Set request-specific fields.
    $paymentType = urlencode('Sale');				// or 'Sale'
    $firstName = urlencode($details['first_name']);
    $lastName = urlencode($details['last_name']);
    $creditCardType = urlencode($details['type']);
    $creditCardNumber = urlencode($details['number']);
    $expDateMonth = $details['expire_month'];
    // Month must be padded with leading zero
    $padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));

    $expDateYear = urlencode($details['expire_year']);
    $cvv2Number = urlencode($details['cvv']);
    $address1 = urlencode($details['address1']);
    $address2 = urlencode($details['address2']);
    $city = urlencode($details['city']);
    $state = urlencode($details['state']);
    $zip = urlencode($details['zip']);
    $country = urlencode($details['country']);				// US or other valid country code
    $amount = urlencode($details['amount']);
    $currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

    // Add request-specific fields to the request string.
    $nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
      "&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
      "&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";

    // Execute the API operation; see the PPHttpPost function above.
    $httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);

return $httpParsedResponseAr;
    /*if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

      //return success	
      //exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
    } else  {
debug('fail');
      //return fail
print_r($httpParsedResponseAr);      
//exit('DoDirectPayment failed: ' . print_r($httpParsedResponseAr, true));
    }*/
  }
}



