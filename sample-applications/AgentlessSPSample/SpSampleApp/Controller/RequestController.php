<?php
abstract class RequestController
{
	protected $view;
	protected $model;

	abstract public function handle();

	protected function getView($viewName, $data)
	{
		$this->view = new View($viewName, $data);
		return $this->view;
	}

}