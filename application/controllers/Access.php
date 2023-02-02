<?php

class Access extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'access';
		$this->load->library('form_validation');
		$this->load->model('M_access', 'access');
		$this->load->model('M_roles', 'roles');

		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This role is not allowed to view data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Data Accesses';
		$this->data['list_accesses'] = $this->access->read();
		$this->data['no'] = 1;

		$this->load->view('access/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This role is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add Access';
		$this->data['list_roles'] = $this->roles->read();

		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('access/add', $this->data);
		} else {
			$data = [
				'role_id' => $this->input->post('role'),
				'model' => $this->input->post('model'),
				'create' => $this->input->post('create') == 'on' ? '1':'0',
				'read' => $this->input->post('read') == 'on' ? '1':'0',
				'update' => $this->input->post('update') == 'on' ? '1':'0',
				'delete' => $this->input->post('delete') == 'on' ? '1':'0',
			];

			if($this->access->create($data)){
				$this->session->set_flashdata('success', 'Access added <strong>successfully</strong>');
				redirect('access');
			} else {
				$this->session->set_flashdata('error', 'Access <strong>failed</strong> to add');
				redirect('access');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This role is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit Access';
		$this->data['list_roles'] = $this->roles->read();
		$this->data['access'] = $this->access->read_by_id($id);

		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('access/edit', $this->data);
		} else {
			$data = [
				'role_id' => $this->input->post('role'),
				'model' => $this->input->post('model'),
				'create' => $this->input->post('create') == 'on' ? '1':'0',
				'read' => $this->input->post('read') == 'on' ? '1':'0',
				'update' => $this->input->post('update') == 'on' ? '1':'0',
				'delete' => $this->input->post('delete') == 'on' ? '1':'0',
			];

			if($this->access->update($data, $id)){
				$this->session->set_flashdata('success', 'Access edited <strong>successfully</strong>');
				redirect('access');
			} else {
				$this->session->set_flashdata('error', 'Access <strong>failed</strong> to edit');
				redirect('access');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->access->delete($id)){
			$this->session->set_flashdata('success', 'Access deleted <strong>successfully</strong>');
			redirect('access');
		} else {
			$this->session->set_flashdata('error', 'Access <strong>failed</strong> to delete');
			redirect('access');
		}
	}
}
