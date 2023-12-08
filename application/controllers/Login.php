<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')){
            redirect('dash');
        }
    }

    public function index(){
        $this->load->view('login');
    } 

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (trim($username) === '' || trim($password) === ''){
            $this->session->set_flashdata('error', '<p style="color: red;">Harap isi semua bidang!</p>');
            redirect('login');
        } else{
            $dataValid = $this->db->where('username', trim($username))->get('user')->row();
            if ($dataValid != null){
                if ($dataValid->password == $password){
                    if ($dataValid->level == 'Admin') {
                        $data_profile = $this->db->where('id_user', $dataValid->id_user)->get('data_diri_user')->row();
                        if ($data_profile == null || $data_profile->deskripsi == null || $data_profile->alamat == null || $data_profile->no_telp == null || $data_profile->kecamatan == null || $data_profile->kabupaten == null || $data_profile->provinsi == null || $data_profile->email == null) {
                            $this->session->set_userdata('terisi', true);
                        }

                        $this->session->set_userdata('id_user', $dataValid->id_user);
                        $this->session->set_userdata('username', $username);
                        $this->session->set_userdata('level', $dataValid->level);
                        $this->session->set_userdata('profile', $dataValid->foto_profile);
                        $this->session->set_userdata('login', 'login');
                        redirect('dash');
                    } else if ($dataValid->level == 'User') {
                        $data_profile = $this->db->where('id_user', $dataValid->id_user)->get('data_diri_user')->row();
                        if ($data_profile == null || $data_profile->deskripsi == null || $data_profile->alamat == null || $data_profile->no_telp == null || $data_profile->kecamatan == null || $data_profile->kabupaten == null || $data_profile->provinsi == null || $data_profile->email == null) {
                            $this->session->set_userdata('terisi', true);
                        }

                        $this->session->set_userdata('id_user', $dataValid->id_user);
                        $this->session->set_userdata('username', $username);
                        $this->session->set_userdata('level', $dataValid->level);
                        $this->session->set_userdata('profile', $dataValid->foto_profile);
                        $this->session->set_userdata('login', 'login');
                        redirect('dash');
                    } else {
                        $this->session->set_flashdata('error', '<p style="color: red;">Anda tidak terdaftar!</p>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('error', '<p style="color: red;">Password salah!</p>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('error', '<p style="color: red;">Username tidak ditemukan!</p>');
                redirect('login');
            }
        }
    }

}