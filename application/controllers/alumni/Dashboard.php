<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // dd($this->session->userdata());
        // die;
        if (!$this->session->userdata('level') == 'alumni') {
            redirect('Auth');
        }
        $this->load->model('model_alumni');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Dashboard',
            'menu' => 'Dashboard'
        ];
        // dd($data);
        // die;
        $this->template->load('layout/alumniDashboard', 'alumni/dashboard', $data);
    }

    public function profile()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Profile',
            'menu' => 'Profile'
        ];

        // $data['list'] = $this->model_alumni->get_alumni();
        $this->template->load('layout/alumniDashboard', 'alumni/profile', $data);
    }
}
