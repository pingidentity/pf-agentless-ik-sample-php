<?php

// For simplicity, trust any certificate. Do not use in production.
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$referenceValue = "<MUST_BE_REPLACED_BY_ACTUAL_VALUE>";

// Pickup the attributes from PingFederate
$pickupLocation = "https://localhost:9031/ext/ref/pickup?REF=" . $referenceValue;
curl_setopt($ch, CURLOPT_URL, $pickupLocation);
curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);

$headers = [
	"ping.uname: changeme",
	"ping.pwd: please change me before you go into production!",
	"ping.instanceId: spadapter"
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

if( ! $result = curl_exec($ch))
{
    trigger_error(curl_error($ch));
}

echo $result;

?>