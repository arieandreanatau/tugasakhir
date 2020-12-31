<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuisioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        //    if (!$this->session->userdata('level') == 'alumni') {
        //    redirect('');
        //    }
        $this->load->model('model_jawaban');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Kuisioner Alumni',
            'menu' => 'Kuisioner Alumni'
        ];

        // $data['list'] = $this->model_alumni->get_alumni();
        $data['list'] = $this->model_jawaban->get_kuisioner();
        $this->template->load('layout/alumniDashboard', 'alumni/Kuisioner', $data);
    }


    // --------- PERTANYAAN ----------- //  
    public function index_pertanyaan($id_kuisioner)
    {

        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Pertanyaan',
            'menu' => 'Alumni/Kuisioner/Pertanyaan'
        ];
        $data['list'] = $this->model_jawaban->get_pertanyaan($id_kuisioner);
        $data['id_kuisioner'] = $id_kuisioner;
        $this->template->load('layout/template', 'alumni/pertanyaan', $data);
    }

    public function selesaiPengisian($id_kuisioner)
    {
        $p = $this->input->post();
        // dd($p);
        // die;

        foreach ($p['checkbox'] as $val) {
            if (array_key_exists("jawaban", $val)) {
                $dataCheck = [
                    'nim' => $this->session->userdata('nim'),
                    'id_kuisioner' => $id_kuisioner,
                    'id_pertanyaan' => $val['id'],
                    'id_tipe_jawaban' => $val['jawaban'],
                ];

                $this->db->insert('tbl_jawaban', $dataCheck);
            }
        }


        foreach ($p['jawab'] as $key => $value) {

            $dataJawab = [
                'nim' => $this->session->userdata('nim'),
                'id_kuisioner' => $id_kuisioner,
                'id_pertanyaan' => $key,
                'id_tipe_jawaban' => $value['jawaban']
            ];

            $this->db->insert('tbl_jawaban', $dataJawab);
        }

        foreach ($p['inputan'] as $value) {

            $dataInputan = [
                'nim' => $this->session->userdata('nim'),
                'id_kuisioner' => $id_kuisioner,
                'id_pertanyaan' => $value['id'],
                'id_tipe_jawaban' => $value['id_tipe'],
                'jawaban_inputan' => $value['jawaban']
            ];

            $this->db->insert('tbl_jawaban', $dataInputan);
        }
        redirect('alumniKuisioner');
    }
}
