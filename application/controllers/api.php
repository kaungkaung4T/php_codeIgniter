<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class api extends RestController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{

		$this->response("hello", RestController::HTTP_OK);
	}
}
