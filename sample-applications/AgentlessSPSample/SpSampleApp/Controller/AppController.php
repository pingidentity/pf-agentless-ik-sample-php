<?php

// for simplicity, do not use in production, consider using a Post/Redirect/Get pattern.

class AppController extends RequestController
{
    public function handle()
    {

        if (isset($_REQUEST[SpConstants::REF_ID]))
        {
            $referenceValue = $_REQUEST[SpConstants::REF_ID];
            try
            {
                $data = PickupUtil::pickupFromPingFederate($referenceValue);
                
                $this->getView(SpConstants::PICKUP_VIEW, $data);
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
            $this->getView(SpConstants::PICKUP_VIEW, []);
            $this->view->render();
        }
    }
}