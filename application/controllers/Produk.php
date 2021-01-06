<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        if (!$this->session->userdata('level') == 'admin') {
            redirect('');
        }
        $this->load->model('model_buku');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Produk',
            'menu' => 'Dashboard > Produk',
        
        ];

        if ($this->input->get()){
            $data['list'] = $this->model_buku->get_genre($this->input->get('pilih'));
        }
        else {
            $data['list'] = $this->model_buku->get_buku();
        }
        $this->template->load('template', 'produk', $data);


    }

    public function insert()
    {
        // $p = $this->input->post();
        $insert = $this->model_buku->insert_buku();

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Ditambahkan</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Ditambahkan</p></div>');
        }
        redirect('produk');
    }

    public function update()
    {
        $update = $this->mode_buku->update_alumni();

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Diubah</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Diubah</p></div>');
        }
        redirect('produk');
    }

    public function delete($kodeporudk)
    {

        $query = $this->db->where('id_buku', $id_buku)
            ->delete('tbl_buku');

        if ($query) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Dihapus</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Dihapus</p></div>');
        }

        redirect('buku');
    }


    // --------------- INFO PROFIL --------------//
/* 
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
 */
}
