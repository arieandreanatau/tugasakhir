<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    //    if (!$this->session->userdata('level') == 'alumni') {
    //    redirect('');
    //    }
        $this->load->model('model_profil');
       
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Profile',
            'menu' => 'Profile'
        ];

        // $data['list'] = $this->model_alumni->get_alumni();
        $where=array('nim');
        $data['list'] = $this->model_profil->profil_nim('nim');
        $data['model']= $this->model_profil->get_nim_prestasi('nim');
        $this->template->load('layout/alumniDashboard', 'alumni/Profile', $data);
    }

    }