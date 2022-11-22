<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
	}

	public function index_get()
	{
		$data = array();
		$data["hello"] = "hello";
		$this->response($data, RestController::HTTP_OK);
	}
}
