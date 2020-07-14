<?php

class View
{
	protected $viewFile;
	protected $viewData;

	public function __construct($viewFile, $viewData)
	{
		$this->viewFile = $viewFile;
		$this->viewData = $viewData;
	}

	public function render()
	{
		include(VIEW . $this->viewFile . '.html');
	}
}
