<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Users extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_users', 'users');
	}

	public function index_get($id = 0)
	{
		if(!empty($id)){
			$data = $this->users->read_by_id_api_arr($id);
		}else{
			$data = $this->users->read_api();
		}

		if($data)
			$this->response($data, RestController::HTTP_OK);
		else
			$this->response(['Data not found.'], RestController::HTTP_NOT_FOUND);
	}

}
