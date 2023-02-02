<?php

class Keys extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'keys';
		$this->load->library('form_validation');
		$this->load->model('M_keys', 'keys');
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

		$this->data['title'] = 'Data Keys';
		$this->data['list_keys'] = $this->keys->read();
		$this->data['no'] = 1;

		$this->load->view('keys/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This role is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add Key';
		$this->data['list_users'] = $this->users->read();

		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('key', 'Key', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('keys/add', $this->data);
		} else {
			$data = [
				'user_id' => $this->input->post('user'),
				'key' => $this->input->post('key'),
				'level' => '1',
				'ignore_limits' => '1',
				'is_private_key' => '1',
				'ip_addresses' => $this->input->post('ip'),
				'date_created' => date("Y-m-d"),
			];

			if($this->keys->create($data)){
				$this->session->set_flashdata('success', 'Key added <strong>successfully</strong>');
				redirect('keys');
			} else {
				$this->session->set_flashdata('error', 'Key <strong>failed</strong> to add');
				redirect('keys');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This role is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit Key';
		$this->data['list_users'] = $this->users->read();
		$this->data['key'] = $this->keys->read_by_id($id);

		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('key', 'Key', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('keys/edit', $this->data);
		} else {
			$data = [
				'user_id' => $this->input->post('user'),
				'key' => $this->input->post('key'),
				'level' => $this->input->post('level'),
				'ignore_limits' => $this->input->post('limits') == 'on' ? '1' : '0',
				'is_private_key' => $this->input->post('private') == 'on' ? '1' : '0',
				'ip_addresses' => $this->input->post('ip'),
			];

			if($this->keys->update($data, $id)){
				$this->session->set_flashdata('success', 'Key edited <strong>successfully</strong>');
				redirect('keys');
			} else {
				$this->session->set_flashdata('error', 'Key <strong>failed</strong> to edit');
				redirect('keys');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->keys->delete($id)){
			$this->session->set_flashdata('success', 'Key deleted <strong>successfully</strong>');
			redirect('keys');
		} else {
			$this->session->set_flashdata('error', 'Key <strong>failed</strong> to delete');
			redirect('keys');
		}
	}
}
