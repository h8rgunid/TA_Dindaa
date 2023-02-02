<?php

class Baby extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'baby';
		$this->load->library('form_validation');
		$this->load->model('M_baby', 'baby');
		$this->load->model('M_roles', 'roles');

		$this->load->model('M_access', 'access');
		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This role is not allowed to load data!');
			redirect('dashboard');
		}
		$this->data['title'] = 'Data Baby';
		$this->data['list_baby'] = $this->baby->read();
		$this->data['baby_users'] = $this->baby->read_by_user();

		$this->load->view('baby/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This Baby is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add Baby';
		$this->data['list_baby'] = $this->baby->read();
		$this->data['baby_users'] = $this->baby->group_by_user();

		$this->form_validation->set_rules('nama_baby', 'Baby Name', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('baby/add', $this->data);
		} else {
			$data = [
				'nama_baby' => $this->input->post('nama_baby'),
				'jk' => $this->input->post('jk'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'ttl' => $this->input->post('ttl'),
				'nik' => $this->input->post('nik'),
				'id_user' => $this->input->post('id'),
			];

			if($this->baby->create($data)){
				$this->session->set_flashdata('success', 'Baby added <strong>successfully</strong>');
				redirect('baby');
			} else {
				$this->session->set_flashdata('error', 'Baby <strong>failed</strong> to add');
				redirect('baby');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This Baby is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit Baby';
		$this->data['baby'] = $this->baby->read_by_id($id);

		$this->form_validation->set_rules('nama_baby', 'Baby Name', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('baby/edit', $this->data);
		} else {
			$data = [
				'nama_baby' => $this->input->post('nama_baby'),
				'jk' => $this->input->post('jk'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'ttl' => $this->input->post('ttl'),
				'nik' => $this->input->post('nik'),
			];

			if($this->baby->update($data, $id)){
				$this->session->set_flashdata('success', 'Baby edited <strong>successfully</strong>');
				redirect('baby');
			} else {
				$this->session->set_flashdata('error', 'Baby <strong>failed</strong> to edit');
				redirect('baby');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This Baby is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->baby->delete($id)){
			$this->session->set_flashdata('success', 'Baby deleted <strong>successfully</strong>');
			redirect('baby');
		} else {
			$this->session->set_flashdata('error', 'Baby <strong>failed</strong> to delete');
			redirect('baby');
		}
	}
}
