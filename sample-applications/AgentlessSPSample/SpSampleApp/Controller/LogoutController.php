<?php

class LogoutController extends RequestController
{
    public function handle()
    {
        $referenceValue = $_REQUEST[SpConstants::REF_ID];
        
        if (!empty($referenceValue))
        {
            try
            {
                $data = PickupUtil::pickupFromPingFederate($referenceValue);
                $this->getView(SpConstants::LOGOUT_VIEW, $data);
                $this->view->render();
            }
            catch (Exception $e)
            {
                $this->getView(SpConstants::ERROR_VIEW, $e->getMessage());
                $this->view->render();
            }
        }
        else
        {
            $this->getView(SpConstants::ERROR_VIEW, "Missing ReferenceId");
            $this->view->render();
        }
    }
}