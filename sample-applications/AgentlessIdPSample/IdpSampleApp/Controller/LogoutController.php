<?php

class LogoutController extends RequestController
{
	public function handle()
	{
		$referenceId = $_REQUEST[IdpConstants::REF_ID];

		if (!empty($referenceId))
		{
			try
			{
				$data = PickupUtil::pickupFromPingFederate($referenceId);
				$this->getView(IdpConstants::LOGOUT_VIEW, $data);
				$this->view->render();
			}
			catch (Exception $e)
			{
				$this->getView(IdpConstants::ERROR_VIEW, $e->getMessage());
				$this->view->render();
			}
		}
		else
		{
			$this->getView(IdpConstants::ERROR_VIEW, "Missing ReferenceId");
			$this->view->render();
		}
	}

}