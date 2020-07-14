<?php

class AppController extends RequestController
{
    public function handle()
    {
        $referenceId = isset($_REQUEST[IdpConstants::PING_POST_REF_ID_KEY]) ? $_REQUEST[IdpConstants::PING_POST_REF_ID_KEY]: "";

        if (!empty($referenceId))
        {
            try
            {
                $data = PickupUtil::pickupFromPingFederate($referenceId);
                $this->getView(IdpConstants::LOGIN_VIEW, $data);
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
            $startSsoLink = UrlUtil::ssoUrl();
            header("Location:" . $startSsoLink);
        }
    }
}