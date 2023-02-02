<?php

class Attendance extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'attendance';
		$this->load->library('form_validation');
		$this->load->model('M_attendance', 'attendance');
		$this->load->model('M_users', 'users');

		$this->load->model('M_access', 'access');
		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This role is not allowed to view data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data Fingerprint Attendances';
		if($this->session->role == 'admin') {
			$this->data['list_attendances'] = $this->attendance->read();
		} else {
			$this->data['list_attendances'] = $this->attendance->read_by_email($this->session->email);
		}

		$this->data['no'] = 1;

		$this->load->view('attendance/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This role is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add Attendance';
		$this->data['list_users'] = $this->users->read();

		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('attendance/add', $this->data);
		} else {
			$data = [
				'user_id' => $this->input->post('user'),
				'date' => $this->input->post('date'),
				'time_in' => $this->input->post('time_in'),
				'time_out' => $this->input->post('time_out'),
			];

			if($this->attendance->create($data)){
				$this->session->set_flashdata('success', 'Attendance added <strong>successfully</strong>');
				redirect('attendance');
			} else {
				$this->session->set_flashdata('error', 'Attendance <strong>failed</strong> to add');
				redirect('attendance');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This role is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit Attendance';
		$this->data['list_users'] = $this->users->read();
		$this->data['attendance'] = $this->attendance->read_by_id($id);

		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('attendance/edit', $this->data);
		} else {
			$data = [
				'user_id' => $this->input->post('user'),
				'date' => $this->input->post('date'),
				'time_in' => $this->input->post('time_in'),
				'time_out' => $this->input->post('time_out'),
			];

			if($this->attendance->update($data, $id)){
				$this->session->set_flashdata('success', 'Attendance edited <strong>successfully</strong>');
				redirect('attendance');
			} else {
				$this->session->set_flashdata('error', 'Attendance <strong>failed</strong> to edit');
				redirect('attendance');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->attendance->delete($id)){
			$this->session->set_flashdata('success', 'Attendance deleted <strong>successfully</strong>');
			redirect('attendance');
		} else {
			$this->session->set_flashdata('error', 'Attendance <strong>failed</strong> to delete');
			redirect('attendance');
		}
	}
}
