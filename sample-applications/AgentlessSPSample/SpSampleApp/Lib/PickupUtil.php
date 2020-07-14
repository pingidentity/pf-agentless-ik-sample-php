<?php

class PickupUtil
{
    public static function pickupFromPingFederate($referenceId)
    {
        // For simplicity, trust any certificate. Do not use in production.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Pickup the attributes from PingFederate
        $pickupLocation = UrlUtil::pickUpUrl($referenceId);
        curl_setopt($ch, CURLOPT_URL, $pickupLocation);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::ADAPTER_USERNAME] 
                                             . ":" . $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::ADAPTER_PASSPHRASE] ); 

        $headers = [SpConstants::PING_ADAPTER_ID_HEADER . ":" 
						. $GLOBALS[SpConstants::SP_ADAPTER_CONFIGURATION][SpConstants::ADAPTER_ID],
					];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		if( ! $result = curl_exec($ch))
		{
			throw new Exception(curl_error($ch));
		}

		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($result, 0, $header_size);
		$body = substr($result, $header_size);

		return array(  
						SpConstants::RESPONSE_HEADERS => self::parseResponseHeaders($header),
						SpConstants::RESPONSE_DATA => json_decode($body, true),
						SpConstants::REF_ID => $referenceId,
					);
					
	}

    public static function parseResponseHeaders($header)
	{
		$noTrailWhiteSpace = explode("\r\n\r\n", $header);

		foreach (explode("\r\n", $noTrailWhiteSpace[0]) as $i => $line)
		{
			if ($i === 0)
			{
				$headers[SpConstants::HTTP_RESPONSE_CODE] = $line;
			}
			else
			{
				list ($key, $value) = explode(': ', $line);
				$headers[$key] = $value;
			}
		}
		return $headers;
	}
}