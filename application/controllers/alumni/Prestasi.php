<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    //    if (!$this->session->userdata('level') == 'alumni') {
    //    redirect('');
    //    }
        $this->load->model('model_prestasi');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Prestasi Alumni',
            'menu' => 'Master Data / Prestasi'
        ];

        $data['list'] = $this->model_prestasi->get_nim_prestasi();
        $this->template->load('layout/alumniDashboard', 'alumni/prestasi', $data);
        
    }

    public function insert_prestasi()
    {
        // $p = $this->input->post();
        // $data = [
        //     'nim' => $this->session->userdata('nim'),
        //     'nama_tim' => $p['nama_tim'],

        // ]
        
        
        
        $insert = $this->model_prestasi->insert_prestasi();

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Ditambahkan</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Ditambahkan</p></div>');
        }
        redirect('alumni/prestasi');
    }

    public function update_prestasi()
    {
        $update = $this->model_prestasi->update_prestasi();

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Diubah</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Diubah</p></div>');
        }
        redirect('alumni/prestasi');
    }

    
    public function delete_prestasi($id_prestasi)
    {

        $query = $this->db->where('id_prestasi', $id_prestasi)
            ->delete('tbl_prestasi');

        if ($query) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Dihapus</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Dihapus</p></div>');
        }

        redirect('alumni/prestasi');
    }
}
?> 