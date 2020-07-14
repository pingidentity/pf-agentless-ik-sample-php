<?php

// create JSON containing user attributes
$idpUserAttributes = json_encode(array("attribute1"=>"value1"));
$contentLength = strlen(utf8_decode($idpUserAttributes));

// For simplicity, trust any certificate. Do not use in production.
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Drop the attributes into PingFederate
$dropoffLocation = "https://localhost:9031/ext/ref/dropoff";
curl_setopt($ch, CURLOPT_URL, $dropoffLocation);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);

$headers = [
	"ping.uname: changeme",
	"ping.pwd: this is a default example and should not be used in production",
	"ping.instanceId: idpadapter",
	"Content-Type: application/json",
	"Content-length: " . $contentLength
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $idpUserAttributes);

// Get Response and Parse it into JSON object
if( ! $result = curl_exec($ch))
{
    trigger_error(curl_error($ch));
}

$referenceId = json_decode($result, true);
echo $referenceId->{'REF'};
?>