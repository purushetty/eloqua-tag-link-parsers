<?php
$longUrl = 'https://maps.google.com.au/maps?q=Hilton+Hotel+Sydney&oe=utf-8&rls=org.mozilla:en-US:official&client=firefox-a&channel=fflb&gws_rd=cr&um=1&ie=UTF-8&hl=en&sa=N&tab=wl';
$apiKey = 'AIzaSyDiFxqv7-YLm5sjCFLSeZmtmST2I377lFk';
//Get API key from : http://code.google.com/apis/console/

$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
$jsonData = json_encode($postData);

$curlObj = curl_init();

curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlObj, CURLOPT_HEADER, 0);
curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
curl_setopt($curlObj, CURLOPT_POST, 1);
curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

$response = curl_exec($curlObj);

//change the response json string to object
$json = json_decode($response);

curl_close($curlObj);

echo 'Shortened URL is: '.$json->id;

?>