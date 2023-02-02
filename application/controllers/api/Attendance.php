<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Attendance extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_attendance', 'attendance');
		$this->load->model('M_users', 'users');
	}

	public function index_get($id = 0)
	{
		if(!empty($id)){
			$data = $this->attendance->read_by_id_api_arr($id);
		}else{
			$data = $this->attendance->read_api();
		}

		if($data)
			$this->response($data, RestController::HTTP_OK);
		else
			$this->response(['Data not found.'], RestController::HTTP_NOT_FOUND);
	}

	public function index_post()
	{
		$user_id = $this->input->post('user_id');
		$date = $this->input->post('date');
		$time_in = $this->input->post('time_in');
		$time_out = $this->input->post('time_out');

		$data['user_id'] = $user_id;
		$data['date'] = $date;
		if (!empty($time_in)) $data['time_in'] = $time_in;
		if (!empty($time_out)) $data['time_out'] = $time_out;

		if ($this->users->read_by_id($user_id)) {
			$existed_attendance = $this->attendance->check_attendance($user_id, $date);
			if ($existed_attendance) {
				if (!empty($time_in)) $data_update['time_in'] = $time_in;
				if (!empty($time_out)) $data_update['time_out'] = $time_out;
				if ($this->attendance->update($data_update, $existed_attendance->id))
					$this->response(['Item updated successfully'], RestController::HTTP_OK);
			} else {
				if ($this->attendance->check_work_day($user_id, $date)) {
					$this->attendance->create($data);
					$this->response(['Item created successfully.'], RestController::HTTP_OK);
				}
				$this->response(['Item failed to create (not in work day)'], RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response(['Item failed to create (no user_id found)'], RestController::HTTP_NOT_FOUND);
		}

	}

//	public function index_put($id)
//	{
//		$input = $this->put();
//		$this->attendance->update($input, $id);
//
//		$this->response(['Item updated successfully.'], RestController::HTTP_OK);
//	}
//
//	public function index_delete($id)
//	{
//		$this->attendance->delete($id);
//		$this->response(['Item deleted successfully.'], RestController::HTTP_OK);
//	}
}
