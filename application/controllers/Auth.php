<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public $email = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }



    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('tbl_user', ['username' => $username]);
        if ($user->num_rows() > 0) {
            $user = $user->row_array();

            if ($username == $user['username']) {
                if ($password == $user['password']) {
                    $data = [
                        'nama_lengkap' => $user['nama_lengkap'],
                        'username' => $user['username'],
                        'level' => $user['level'],
                        'login' => true
                    ];
                    // $this->session->set_userdata('login');
                    $this->session->set_userdata($data);
                    if ($data['level'] == 'admin') {
                        $this->session->set_flashdata('login', 'Selamat Datang');
                        redirect('dashboard');
                    } else {
                        redirect('Auth');
                    }
                } else {

                    $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fas fa-exclamation-triangle"></i> Maaf! Password Salah</p></div>');
                    redirect('Auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fas fa-ban"></i> Maaf! Username Tidak Tersedia </p></div>');
                redirect('Auth');
            }
        } 
    }

    // public function registrasi()
    // {
    //     $this->load->view('template/auth_header');
    //     $this->load->view('auth/registrasi');
    //     $this->load->view('template/auth_footer');
    // }

    public function logout()
    {
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('login');
        $this->session->set_flashdata('logout', 'berhasil');
        redirect('Auth');
    }

    public function lupaPassword()
    {
        if ($this->input->post()) {

            $email = $this->input->post('email', true);

            $cek_email = $this->db->get_where('tbl_alumni', ['email' => $email]);
            if ($cek_email->num_rows() > 0) {
                redirect('resetPassword');
            } else {
                $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fas fa-exclamation-triangle"></i> Maaf! Email anda tidak terdaftar</p></div>');
                $this->load->view('auth/lupaPassword');
            }
        }
        $this->load->view('auth/lupaPassword');
    }

    public function resetPassword()
    {

        if ($this->input->post()) {
            $p = $this->input->post();
            $this->form_validation->set_rules('passwordNew', 'Password', 'required');
            $this->form_validation->set_rules('passwordNewKonf', 'Konfirmasi Password', 'required|matches[passwordNew]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $cek_email = $this->db->get_where('tbl_alumni', ['email' => $p['email']]);
                if ($cek_email->num_rows() > 0) {
                    $update = $this->db->where('email', $p['email'])
                        ->update('tbl_alumni', ['pin' => $p['passwordNew']]);

                    if ($update) {
                        $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fas fa-check"></i> Berhasil Melakukan pergantian password</p></div>');
                        redirect('Auth');
                    } else {
                        $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fas fa-exclamation-triangle"></i> Maaf ! Gagal melakukan pergantian password silahkan coba lagi dalam beberapa saat</p></div>');
                        redirect('Auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fas fa-exclamation-triangle"></i> Maaf! Email anda tidak terdaftar</p></div>');
                    $this->load->view('auth/resetPassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div style="max-height:10%" class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>');
            }
        }


        $this->load->view('auth/resetPassword');
    }
}
