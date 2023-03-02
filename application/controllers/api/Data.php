<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkembangan', 'perkembangan');
	}

	public function sensor(){
		if (isset($_GET['data'])) {
			//echo "OK";
			$panjang = $this->input->get('data');
			$id = $this->input->get('id');
			//echo $panjang;

			$datasensor = array('berat_bayi' => $panjang,'id_bayi' => $id, 'tanggal' => date("Y-m-d"));
			// var_dump($datasensor);
			// die();
			if($this->perkembangan->create($datasensor)){
				echo "BERHASIL";
			}else{
				echo "ERROR";
			}
		}else{
			echo "Variabel data tidak terdefinisi";
		}
	}

}
