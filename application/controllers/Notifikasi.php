<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->data['active'] = 'notifikasi';
		$this->load->library('form_validation');
		$this->load->model('M_telenotif', 'notifikasi');
        $this->load->model('M_roles', 'roles');

		$this->load->model('M_access', 'access');
        $this->data['_role'] = $this->access->get_access($this->session->role, strtolower(basename(__FILE__, '.php')));
        $this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
    }

    public function index()
    {
        $this->data['title'] = 'Jadwal Posyandu';
        $this->load->view('notifikasi', $this->data);
    }
    
    public function sendTele(){
		$this->form_validation->set_rules('tanggal', 'Tanggal Posyandu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('notifikasi', $this->data);
		} else {
			$data = [
				'tanggal' => $this->input->post('tanggal')
			];
			// var_dump($data);
			// die();

			if($this->notifikasi->sendTele($data)){
				$this->session->set_flashdata('success', 'Notifikasi berhasil <strong>dikirim ke Tele</strong>');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Baby <strong>failed</strong> to add');
				redirect('notifikasi');
			}
		}
	}

}