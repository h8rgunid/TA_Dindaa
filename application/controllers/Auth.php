<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_users', 'users');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}

	public function regis()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required', [
			'required' => 'Nama Pengguna Wajib di isi'
		]);
		$this->form_validation->set_rules(
			'password',
			'Password', 
			'required|trim|min_length[5]', 
			[
				'min_length'=>'Password Terlalu Pendek',
				'required' => 'password Pengguna Wajib di isi'
			]);
		if($this->form_validation->run() == false){
			$this->load->view('auth/register');
		}else {
			$data = [
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'), 
				'role_id' => 2,
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				
			];
			$this->users->create($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi Berhasil</div>');
			redirect('Auth');
		}	
	}	

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		$user = $this->users->read_by_email($email, $role);

		if ($user) {

			if (password_verify($password, $user->password)) {

				$session = [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
					'role' => $user->role_name,
				];
				$this->session->set_userdata($session);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Wrong password!');
				redirect('');
			}
		} else {
			$this->session->set_flashdata('error', 'Wrong email!');
			redirect('');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert"> You have been logout!</div>');
		redirect('');
	}

	public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
