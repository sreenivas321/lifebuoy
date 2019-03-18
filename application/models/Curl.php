<?php 

$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay';

$ch = curl_init($url);

$header = array(
	'X-PAYPAL-SECURITY-USERID: caller_1312486258_biz_api1.gmail.com',
	'X-PAYPAL-SECURITY-PASSWORD: 1312486294',
	'X-PAYPAL-SECURITY-SIGNATURE: AbtI7HV1xB428VygBUcIhARzxch4AL65.T18CTeylixNNxDZUu0iO87e',
	'X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T',
	'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
	'X-PAYPAL-RESPONSE-DATA-FORMAT: NV'
	);

curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$data = 'actionType=PAY&senderEmail=sender@domain.com&cancelUrl=http://www.example.com/failure.html&currencyCode=USD&receiverList.receiver(0).email=rec1_1312486368_biz@gmail.com&receiverList.receiver(0).amount=1.00&requestEnvelope.errorLanguage=en_US&returnUrl=http://www.example.com/success.htm';

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);

//echo $response;

curl_close($ch);

?>