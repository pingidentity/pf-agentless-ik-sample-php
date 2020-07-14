<?php

class ErrorController extends RequestController
{
    public function handle()
    {
        $this->getView(SpConstants::ERROR_VIEW, "There is a problem with your request");
        $this->view->render();
    }
}
