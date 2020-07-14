<?php

class ResumeController extends RequestController
{
	public function handle()
	{
		$redirectURL = UrlUtil::redirectUrl($_POST[IdpConstants::RESUME_PATH], $_POST[IdpConstants::REF_ID]);

		header('Location: '. $redirectURL);
		die();

	}

}