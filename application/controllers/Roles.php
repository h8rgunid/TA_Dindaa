<?php

class Roles extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'roles';
		$this->load->library('form_validation');
		$this->load->model('M_roles', 'roles');

		$this->load->model('M_access', 'access');
		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This role is not allowed to view data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data Roles';
		$this->data['list_roles'] = $this->roles->read();

		$this->load->view('roles/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This role is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add Role';
		$this->data['list_roles'] = $this->roles->read();

		$this->form_validation->set_rules('name', 'Role Name', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('roles/add', $this->data);
		} else {
			$data = [
				'name' => $this->input->post('name'),
			];

			if($this->roles->create($data)){
				$this->session->set_flashdata('success', 'Role added <strong>successfully</strong>');
				redirect('roles');
			} else {
				$this->session->set_flashdata('error', 'Role <strong>failed</strong> to add');
				redirect('roles');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This role is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit Role';
		$this->data['role'] = $this->roles->read_by_id($id);

		$this->form_validation->set_rules('id', 'Role ID', 'required');
		$this->form_validation->set_rules('name', 'Role Name', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('roles/edit', $this->data);
		} else {
			$data = [
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
			];

			if($this->roles->update($data, $id)){
				$this->session->set_flashdata('success', 'Role edited <strong>successfully</strong>');
				redirect('roles');
			} else {
				$this->session->set_flashdata('error', 'Role <strong>failed</strong> to edit');
				redirect('roles');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->roles->delete($id)){
			$this->session->set_flashdata('success', 'Role deleted <strong>successfully</strong>');
			redirect('roles');
		} else {
			$this->session->set_flashdata('error', 'Role <strong>failed</strong> to delete');
			redirect('roles');
		}
	}
}
