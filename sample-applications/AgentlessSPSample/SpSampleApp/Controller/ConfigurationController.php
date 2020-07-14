<?php

class ConfigurationController extends RequestController
{
    public function handle()
    {
        if (empty($_POST))
		{
			$this->getView(SpConstants::CONFIGURE_VIEW, []);
			$this->view->render();
		}
		else
		{
			try
			{
				$configurationManager = new ConfigurationManager();
				$configurationManager->saveConfiguration($_POST);
				$configurationManager->loadConfiguration();

				$appController = new AppController();
				$appController->handle();
			}
			catch (Exception $e)
			{
				$data = [SpConstants::ERROR_MESSAGE => $e->getMessage()];
				$this->getView(SpConstants::CONFIGURE_VIEW, $data);
				$this->view->render();
			}
		}
    }
}