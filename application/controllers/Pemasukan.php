<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') === NULL || !$this->session->userdata('login')) {
			redirect('login');
		}
	}

    public function index()
    {
        $data['pemasukan'] = $this->db->where('jenis_transaksi', 'Pemasukan')->get('transaksi')->result_array();

        load_template('Apps/pemasukan', $data);
    }

    public function tambah(){
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Harap isi semua bidang!');
			redirect('user');
		} else {
			$keterangan = $this->input->post('keterangan');
			$nominal = $this->input->post('nominal');
			$usernameSementara = $this->session->userdata('username');

			if (trim($keterangan) === '' || trim($nominal) === ''){
				$this->session->set_flashdata('error', 'Harap isi semua bidang!');
				redirect('pemasukan');
			}else{
				$data = array(
					'keterangan' => $keterangan,
					'nominal' => $nominal,
					'username' => $usernameSementara,
					'jenis_transaksi' => 'Pemasukan',
					'tanggal' => date('Y-m-d')
				);
				$this->db->insert('transaksi', $data);
				$this->session->set_flashdata('success', 'Data Pemasukan baru berhasil ditambahkan');
				redirect('pemasukan');
			}
		}
	}

    public function hapusPemasukan($id){
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');

		$this->session->set_flashdata('success', 'Oke, Data pemasukan terpilih berhasil dihapus');
		redirect('pemasukan');
	}
}