<?php

class LoggedOutController extends RequestController
{
    public function handle()
    {
        $this->getView(SpConstants::LOGGED_OUT_VIEW, []);
        $this->view->render();
    }
}