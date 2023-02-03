<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function get_all_report()
    {
        $data['laporan'] = $this->model_report->getAllData();
        $this->load->view('notifikasi', $data);

    }

}