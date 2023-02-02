<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		$this->data['title'] = 'Dashboard';
		$this->data['active'] = 'dashboard';

		$this->load->model('M_baby', 'baby');
		$this->load->model('M_perkembangan', 'perkembangan');

		$this->load->model('M_access', 'access');
		$this->data['_role_menu'] = $this->access->get_access_by_role($this->session->role);
	}

	public function index(){
		if($this->session->role == 'admin') {
			$this->data['count_baby'] = $this->baby->count();
			$this->data['count_menimbang'] = $this->perkembangan->count();
			$this->data['beratmax'] = $this->perkembangan->beratmax();
			$this->data['beratavg'] = $this->perkembangan->beratavg();
		} else {
			$this->data['count_menimbang'] = $this->perkembangan->count();
		}


		$this->load->view('dashboard', $this->data);
	}
}
