<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumni extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        if (!$this->session->userdata('level') == 'admin') {
            redirect('');
        }
        $this->load->model('model_alumni');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Alumni',
            'menu' => 'Alumni',
        
        ];

        if ($this->input->get()){
            $data['list'] = $this->model_alumni->get_jurusan($this->input->get('pilih'));
        }
        else {
            $data['list'] = $this->model_alumni->get_alumni();
        }
        $this->template->load('layout/template', 'admin/alumni', $data);


    }

    public function insert()
    {
        // $p = $this->input->post();
        $insert = $this->model_alumni->insert_alumni();

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Ditambahkan</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Ditambahkan</p></div>');
        }
        redirect('alumni');
    }

    public function update()
    {
        $update = $this->model_alumni->update_alumni();

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Diubah</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Diubah</p></div>');
        }
        redirect('alumni');
    }

    public function delete($nim)
    {

        $query = $this->db->where('nim', $nim)
            ->delete('tbl_alumni');

        if ($query) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Dihapus</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Dihapus</p></div>');
        }

        redirect('alumni');
    }


    // --------------- INFO PROFIL --------------//

    public function profil($nim)
    {

        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Profil Alumni',
            'menu' => 'Profil Alumni'
        ];
        $data['alumni'] = $this->model_alumni->alumni_data($nim);
        $this->template->load('layout/template', 'admin/profil', $data);
    
    }

}
