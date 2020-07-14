<?php

class DropoffController extends RequestController
{
	public function handle()
	{
		if (empty($_REQUEST[IdpConstants::USERNAME]))
		{
			$this->getView(IdpConstants::ERROR_VIEW, []);
			$this->view->render();
		}
		else
		{
			$username = $_REQUEST[IdpConstants::USERNAME];
			$this->model = new IdpSampleUsersLoader();
			$idpUserAttributes = $this->model->load($username);
			
			$idpUserAttributes = json_decode($idpUserAttributes, true);
			$idpUserAttributes += [IdpConstants::SUBJECT => $username];
			$idpUserAttributes += [IdpConstants::AUTHN_INST => date("M,d,Y h:i:s Z")];
			$idpUserAttributes = json_encode($idpUserAttributes, true);
			$contentLength = strlen(utf8_decode($idpUserAttributes));
	
			// For simplicity, trust any certificate. Do not use in production.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
			// Drop the attributes into PingFederate
			$dropoffLocation = UrlUtil::dropoffUrl();
			curl_setopt($ch, CURLOPT_URL, $dropoffLocation);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::ADAPTER_USERNAME] 
												. ":" . $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::ADAPTER_PASSPHRASE] );  
	
			$headers = [IdpConstants::PING_ADAPTER_ID_HEADER . ":" 
							. $GLOBALS[IdpConstants::IDP_ADAPTER_CONFIGURATION][IdpConstants::ADAPTER_ID],
						'Content-Type:application/json',
						'Content-Length:' . $contentLength];
	
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $idpUserAttributes);
	
			// Get Response and Parse it into JSON object
			if( ! $result = curl_exec($ch))
			{
				$this->getView(IdpConstants::ERROR_VIEW, curl_error($ch));
				$this->view->render();
			} 
			else
			{
				$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
				$header = substr($result, 0, $header_size);
				$body = substr($result, $header_size);

				$data = array(
								IdpConstants::REF_ID => json_decode($body, true),
								IdpConstants::RESPONSE_HEADERS => PickupUtil::parseResponseHeaders($header),
								IdpConstants::USER_SESSION_DATA => json_decode($idpUserAttributes, true),
								IdpConstants::RESUME_PATH => $_REQUEST[IdpConstants::RESUME_PATH]
							);
	
				$this->getView(IdpConstants::DROPOFF_VIEW, $data);
				$this->view->render();
			}
		}
	}
}