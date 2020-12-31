<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InfoLowongan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    //    if (!$this->session->userdata('login'))  {
      //      redirect('');
       // }
       $this->load->model('model_perusahaan');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('login'),
            'title' => 'Dashboard',
            'menu' => 'Dashboard'
        ];
        // dd($data);
        // die;
        $data['perusahaan'] = $this->model_perusahaan->get_perusahaan();
        $data['list']  = $this->model_perusahaan->get_lowongan();
        $this->template->load('layout/alumniDashboard', 'alumni/infoLowongan', $data);
    }

   

    // --------------- INFO PROFIL --------------//

    public function index_perusahaan($id_perusahaan)
    {

        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Data Perusahaan',
            'menu' => 'Info Lowongan / Data Perusahaan'
        ];
        $data['list'] = $this->model_perusahaan->ambil_data_perusahaan($id_perusahaan);
        $this->template->load('layout/alumniDashboard', 'alumni/infoPerusahaan', $data);
    
    }
}
?>