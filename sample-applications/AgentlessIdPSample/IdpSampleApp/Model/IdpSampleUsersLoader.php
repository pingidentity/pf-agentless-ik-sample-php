<?php

class IdpSampleUsersLoader
{
	// is only called with valid username
	public function load($username)
	{
		$fileContents = file_get_contents(CONFIGURATION . 'idp-sample-users.json');

		foreach(json_decode($fileContents, true) as &$value)
		{
			if($value['username'] == $username)
			{
				$userAttributes = $value['attributes'];
			}
		}
	
		$this->data = json_encode($userAttributes, true);
		return $this->data;
	}
}
