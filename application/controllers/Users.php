<?php

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['active'] = 'users';
		$this->load->library('form_validation');
		$this->load->model('M_users', 'users');
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

		$this->data['title'] = 'Data Users';
		$this->data['list_users'] = $this->users->read();

		$this->load->view('users/view', $this->data);
	}

	public function add(){
		if(!(int)$this->data['_role']['create']) {
			$this->session->set_flashdata('error', 'This role is not allowed to add data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Add User';
		$this->data['list_roles'] = $this->roles->read();

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('users/add', $this->data);
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role'),
				'd1' => $this->input->post('d1') == 'on' ? '1':'0',
				'd2' => $this->input->post('d2') == 'on' ? '1':'0',
				'd3' => $this->input->post('d3') == 'on' ? '1':'0',
				'd4' => $this->input->post('d4') == 'on' ? '1':'0',
				'd5' => $this->input->post('d5') == 'on' ? '1':'0',
				'd6' => $this->input->post('d6') == 'on' ? '1':'0',
				'd7' => $this->input->post('d7') == 'on' ? '1':'0',
			];

			if($this->users->create($data)){
				$this->session->set_flashdata('success', 'User added <strong>successfully</strong>');
				redirect('users');
			} else {
				$this->session->set_flashdata('error', 'User <strong>failed</strong> to add');
				redirect('users');
			}
		}
	}

	public function edit($id){
		if(!(int)$this->data['_role']['update']) {
			$this->session->set_flashdata('error', 'This role is not allowed to change data!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Edit User';
		$this->data['list_roles'] = $this->roles->read();
		$this->data['user'] = $this->users->read_by_id($id);

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == false) {
			$this->load->view('users/edit', $this->data);
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'role_id' => $this->input->post('role'),
				'd1' => $this->input->post('d1') == 'on' ? '1':'0',
				'd2' => $this->input->post('d2') == 'on' ? '1':'0',
				'd3' => $this->input->post('d3') == 'on' ? '1':'0',
				'd4' => $this->input->post('d4') == 'on' ? '1':'0',
				'd5' => $this->input->post('d5') == 'on' ? '1':'0',
				'd6' => $this->input->post('d6') == 'on' ? '1':'0',
				'd7' => $this->input->post('d7') == 'on' ? '1':'0',
			];

			$password = $this->input->post('password');
			if($password) $data['password'] = password_hash($password, PASSWORD_DEFAULT);

			if($this->users->update($data, $id)){
				$this->session->set_flashdata('success', 'User edited <strong>successfully</strong>');
				redirect('users');
			} else {
				$this->session->set_flashdata('error', 'User <strong>failed</strong> to edit');
				redirect('users');
			}
		}
	}

	public function delete($id){
		if(!(int)$this->data['_role']['delete']) {
			$this->session->set_flashdata('error', 'This role is not allowed to delete data!');
			redirect('dashboard');
		}

		if($this->users->delete($id)){
			$this->session->set_flashdata('success', 'User deleted <strong>successfully</strong>');
			redirect('users');
		} else {
			$this->session->set_flashdata('error', 'User <strong>failed</strong> to delete');
			redirect('users');
		}
	}
}
