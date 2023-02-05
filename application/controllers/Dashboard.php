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
			$this->data['berat_per_bulan'] = $this->perkembangan->berat_per_bulan();
			// var_dump($this->perkembangan->berat_per_bulan());
			// die();
			// echo json_encode($berat);
		} else {
			$this->data['count_baby_id'] = $this->baby->count_id($this->session->userdata('id'));
			$this->data['count_baby'] = $this->baby->count_per_id($this->session->userdata('id'));
			$this->data['count_menimbang'] = $this->perkembangan->count_per_id($this->session->userdata('id'));
			$this->data['beratmax'] = $this->perkembangan->beratmax_per_id($this->session->userdata('id'));
			$this->data['beratavg'] = $this->perkembangan->beratavg_per_id($this->session->userdata('id'));
			$id = $this->baby->readID($this->session->userdata('id'));
			// var_dump($id);
			// echo '<pre>';
			// print_r($id);
			
			

			for($i = 0;$i < count($id); $i++){
				// echo '<pre>';
				// print_r($this->perkembangan->berat_per_bulan_id($id[$i]['id_baby']));
				$this->data['berat_per_bulan'.$i] = $this->perkembangan->berat_per_bulan_id($id[$i]['id_baby']);
			}
			// die();
			
			// var_dump($this->perkembangan->berat_per_bulan_id($this->session->userdata('id')));
			// die();
			// echo json_encode($berat);
		}


		$this->load->view('dashboard', $this->data);
	}
}
