<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengabdianAlumni extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        //    if (!$this->session->userdata('level') == 'alumni') {
        //    redirect('');
        //    }
        $this->load->model('model_pengabdianalumni');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Pengabdian Alumni',
            'menu' => 'Master Data / Pengabdian Kepada Masyarakat Alumni'
        ];

        $data['list'] = $this->model_pengabdianalumni->get_pengabdianalumni();
        $data['pengabdian'] = $this->model_pengabdianalumni->get_pengabdian();

        $this->template->load('layout/alumniDashboard', 'alumni/pengabdian_alumni', $data);
    }

    public function jsonPengabdian()
    {
        $id = $this->input->post('id');
        // dd($id);
        // die;

        $pengabdian = $this->model_pengabdianalumni->get_pengabdianById($id);
        // dd($pengabdian);
        // die;

        if ($pengabdian) {
            $response['status'] = true;
            $response['data'] = $pengabdian;
        } else {
            $response['status'] = false;
        }
        echo json_encode($response);
    }

    public function insert_pengabdianalumni()
    {
        // $p = $this->input->post();
        // $data = [
        //     'nim' => $this->session->userdata('nim'),
        //     'nama_tim' => $p['nama_tim'],

        // ]



        $insert = $this->model_pengabdianalumni->insert_pengabdianalumni();

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
