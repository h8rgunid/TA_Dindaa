<?php

class Perkembangan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'perkembangan';
		$this->load->library('form_validation');
		$this->load->model('M_perkembangan', 'perkembangan');
		$this->load->model('M_roles', 'roles');
		$this->load->model('M_baby', 'baby');

		$this->load->model('M_access', 'access');
		$this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if(!(int)$this->data['_role']['read']) {
			$this->session->set_flashdata('error', 'This Perkembangan Baby is not allowed to load data!');
			redirect('dashboard');
		}
		$this->data['title'] = 'Data Perkembangan Baby';
		$this->data['list_perkembangan'] = $this->perkembangan->read();
		$this->load->view('perkembangan/view', $this->data);
	}

	// public function add(){
	// 	if(!(int)$this->data['_role']['create']) {
	// 		$this->session->set_flashdata('error', 'This role is not allowed to add data!');
	// 		redirect('dashboard');
	// 	}

	// 	$this->data['title'] = 'Add Role';
	// 	$this->data['list_roles'] = $this->roles->read();

	// 	$this->form_validation->set_rules('name', 'Role Name', 'required');
	// 	$this->form_validation->set_error_delimiters('', '');

	// 	if ($this->form_validation->run() == false) {
	// 		$this->load->view('perkembangan/add', $this->data);
	// 	} else {
	// 		$data = [
	// 			'name' => $this->input->post('name'),
	// 		];

	// 		if($this->roles->create($data)){
	// 			$this->session->set_flashdata('success', 'Role added <strong>successfully</strong>');
	// 			redirect('perkembangan');
	// 		} else {
	// 			$this->session->set_flashdata('error', 'Role <strong>failed</strong> to add');
	// 			redirect('perkembangan');
	// 		}
	// 	}
	// }

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This Perkembangan Baby is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit History Perkembangan';
		$this->data['perkembangan'] = $this->perkembangan->read_by_id_perkembangan($id);

		$this->form_validation->set_rules('berat_bayi', 'Berat Baby', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Menimbang', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('perkembangan/edit', $this->data);
		} else {
			$data = [
				'berat_bayi' => $this->input->post('berat_bayi'),
				'tanggal' => $this->input->post('tanggal'),
			];

			if($this->perkembangan->update($data, $id)){
				$this->session->set_flashdata('success', 'Perkembangan Baby edited <strong>successfully</strong>');
				redirect('perkembangan');
			} else {
				$this->session->set_flashdata('error', 'Perkembangan Baby <strong>failed</strong> to edit');
				redirect('perkembangan');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This Perkembangan Baby is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->perkembangan->delete($id)){
			$this->session->set_flashdata('success', 'Perkembangan Baby deleted <strong>successfully</strong>');
			redirect('perkembangan');
		} else {
			$this->session->set_flashdata('error', 'Perkembangan Baby <strong>failed</strong> to delete');
			redirect('perkembangan');
		}
	}

	public function delete1($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This Perkembangan Baby is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->perkembangan->delete1($id)){
			$this->session->set_flashdata('success', 'Perkembangan Baby deleted <strong>successfully</strong>');
			redirect('perkembangan');
		} else {
			$this->session->set_flashdata('error', 'Perkembangan Baby <strong>failed</strong> to delete');
			redirect('perkembangan');
		}
	}

	public function history($id){
		$this->data['title'] = 'Data History';
		$this->data['list_perkembangan'] = $this->perkembangan->read_by_id($id);
		$this->data['nama_baby'] = $this->perkembangan->nama_baby($id);
		$this->load->view('perkembangan/history', $this->data);
	}
}
