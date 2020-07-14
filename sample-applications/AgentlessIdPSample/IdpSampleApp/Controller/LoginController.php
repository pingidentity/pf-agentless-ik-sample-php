<?php

class LoginController extends RequestController
{
	
	public function handle()
	{
		$authenticator = new Authenticator;

		if ($authenticator->authenticate($_POST[IdpConstants::USERNAME], $_POST[IdpConstants::PASSWORD]))
		{
			$dropoffController = new DropoffController();
			$dropoffController->handle();
		}
		else
		{
			if ($_REQUEST[IdpConstants::RESUME_PATH] == NULL)
			{
				$appController = new AppController();
				$appController->handle();
			}
			else
			{
				$data = [IdpConstants::ERROR_MESSAGE => "Invalid login."];
				$this->getView(IdpConstants::LOGIN_VIEW, $data);
				$this->view->render();
			}
		}

	}

}

