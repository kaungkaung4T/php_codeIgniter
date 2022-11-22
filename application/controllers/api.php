<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'libraries/rest_controller.php';


class api extends rest_controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{

		$this->response("hello", 200);
	}
}
