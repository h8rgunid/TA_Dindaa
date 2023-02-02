<?php

class Logs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'logs';
		$this->load->model('M_logs', 'logs');

		$this->load->model('M_access', 'access');
		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This role is not allowed to view data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data Logs';
		$this->data['list_logs'] = $this->logs->read();
		$this->data['no'] = 1;

		$this->load->view('logs/view', $this->data);
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->logs->delete($id)){
			$this->session->set_flashdata('success', 'Log deleted <strong>successfully</strong>');
			redirect('logs');
		} else {
			$this->session->set_flashdata('error', 'Log <strong>failed</strong> to delete');
			redirect('logs');
		}
	}

	public function delete_all(){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->logs->delete_all()){
			$this->session->set_flashdata('success', 'All logs deleted <strong>successfully</strong>');
			redirect('logs');
		} else {
			$this->session->set_flashdata('error', 'All logs <strong>failed</strong> to delete');
			redirect('logs');
		}
	}
}
