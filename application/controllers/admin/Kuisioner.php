<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuisioner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        if (!$this->session->userdata('level') == 'admin') {
            redirect('');
        }
        $this->load->model('model_kusioner');
    }

    public function index()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Kusioner',
            'menu' => 'Kusioner'
        ];

        $data['list'] = $this->model_kusioner->get_kusioner();
        $this->template->load('layout/template', 'admin/kuisioner', $data);
    }

    public function tambah_kuisioner()
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Kusioner',
            'menu' => 'Tambah Kusioner'
        ];
        $last = $this->model_kusioner->last_data();

        if ($last['is_created'] != '0') {
            $data = [
                'kuisioner' => ''
            ];
            $this->db->insert('tbl_kuisioner', $data);

            $last = $this->model_kusioner->last_data();
        }
        $data['kuisioner'] = $last;
        $data['pertanyaan'] = $this->model_kusioner->get_pertanyaan($last['id_kuisioner']);
        // dd($last);
        // die;
        $this->template->load('layout/template', 'admin/tambah_kuisioner', $data);
    }

    public function insert_kuisioner()
    {
        $p = $this->input->post();

        $data = [
            'judul' => $p['judul'],
            'kuisioner' => $p['peruntukan'],
            'is_created' => '1'
        ];

        if ($this->model_kusioner->update_kuisioner($p['id'], $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Ditambahkan</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Ditambahkan</p></div>');
        }
        redirect('kuisioner');
    }

    public function edit_kuisioner($id_kuisioner)
    {
        $data = [
            'level' => $this->session->userdata('level'),
            'title' => 'Kusioner',
            'menu' => 'Edit Kusioner'
        ];

        $data['kuisioner'] = $this->model_kusioner->get_kusionerById($id_kuisioner);
        $data['pertanyaan'] = $this->model_kusioner->get_pertanyaan($id_kuisioner);
        // dd($last);
        // die;
        $this->template->load('layout/template', 'admin/tambah_kuisioner', $data);
    }

    public function hapus_kuisioner($id_kuisioner)
    {
        $delete = $this->db->where('id_kuisioner', $id_kuisioner)
            ->delete('tbl_kuisioner');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="margin-bottom: 0rem !important"><i class="icon fas fa-check"></i> Data Berhasil Dihapus</p></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="margin-bottom: 0rem !important"><i class="icon fas fa-ban"></i> Data Gagal Dihapus</p></div>');
        }
        redirect('kuisioner');
    }

    public function tambah_pertanyaan()
    {

        if ($this->input->is_ajax_request()) {
            $p = $this->input->post();
            // dd($p);
            // die;
            $data = [
                'id_kuisioner' => $p['id_kuisioner'],
                'pertanyaan' => $p['pertanyaan'],
            ];

            if ($this->model_kusioner->tambah_pertanyaan($data)) {
                $getPertanyaan = $this->db->limit(1)
                    ->order_by('id_pertanyaan', "DESC")
                    ->get('tbl_pertanyaan')->row_array();
                // dd($getPertanyaan);
                // die;

                foreach ($p['jawaban'] as $key => $value) {
                    $dataJawaban = [
                        'id_kuisioner' => $p['id_kuisioner'],
                        'id_pertanyaan' => $getPertanyaan['id_pertanyaan'],
                        'isi_jawaban' => $value,
                        'tipe_jawaban' => $p['jenis'],
                    ];

                    $this->db->insert('tbl_tipe_jawaban', $dataJawaban);
                }


                $response['message'] = 'Data berhasil ditambahkan';
                $response['data']    = $this->model_kusioner->get_pertanyaan($p['id_kuisioner']);
                $response['status']  = true;
            } else {
                $response['message'] = 'Data gagal ditambahkan';
                $response['status']  = false;
            }
            echo json_encode($response);
        } else {
            $response['message'] = 'Data gagal ditambahkan';
            $response['status']  = false;
            echo json_encode($response);
        }
    }

    public function hapus_pertanyaan($no_kuisioner)
    {
        $p = $this->input->post();
        $delete = $this->db->where('id_pertanyaan', $p['id_pertanyaan'])
            ->where('id_kuisioner', $no_kuisioner)
            ->delete('tbl_pertanyaan');
        if ($delete) {
            $this->db->where('id_pertanyaan', $p['id_pertanyaan'])
                ->where('id_kuisioner', $no_kuisioner)
                ->delete('tbl_tipe_jawaban');


            $response['message'] = 'Data berhasil dihapus';
            $response['data']    = $this->model_kusioner->get_pertanyaan($no_kuisioner);
            $response['status']  = true;
        } else {
            $response['message'] = 'Data gagal dihapus';
            $response['status']  = false;
        }
        echo json_encode($response);
    }

    public function list_pertanyaan()
    {
        $p = $this->input->post();

        $list = $this->model_kusioner->get_pertanyaan($p['id_kuisioner']);

        if ($list != []) {
            $response['data'] = $list;
            $response['status']  = true;
        } else {
            $response['message'] = 'Data gagal ditambahkan';
            $response['status']  = false;
        }

        echo json_encode($response);
    }

    public function update_post()
    {
        $id_kuisioner = $this->input->post('id_kuisioner');
        $post = $this->input->post('post');
        $this->db->where('id_kuisioner', $id_kuisioner)
            ->update('tbl_kuisioner', ['post' => $post]);
        redirect('kuisioner/');
    }
}
