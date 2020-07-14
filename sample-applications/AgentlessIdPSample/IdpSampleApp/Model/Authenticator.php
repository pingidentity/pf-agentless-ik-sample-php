<?php

class Authenticator
{
	public function authenticate($username, $password)
	{
		$fileContents = file_get_contents(CONFIGURATION . 'idp-sample-users.json');

		foreach(json_decode($fileContents, true) as &$value)
		{
			if($value['username'] == $username && $value['password'] == $password)
			{
				return true;
			}
		}
		return false;
	}
}