<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
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
        $data['pengeluaran'] = $this->db->where('jenis_transaksi', 'Pengeluaran')->get('transaksi')->result_array();

        load_template('Apps/pengeluaran', $data);
    }

    public function hapusPengeluaran($id){
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');

		$this->session->set_flashdata('success', 'Oke, Data <span style="color: red;">Pengeluaran</span> terpilih berhasil dihapus');
		redirect('pengeluaran');
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
			// Ganti setelah selesai menggunakan Session
			$usernameSementara = 'Saya';

			if (trim($keterangan) === '' || trim($nominal) === ''){
				$this->session->set_flashdata('error', 'Harap isi semua bidang!');
				redirect('user');
			}else{
				$data = array(
					'keterangan' => $keterangan,
					'nominal' => $nominal,
					'username' => $usernameSementara,
					'jenis_transaksi' => 'Pengeluaran',
					'tanggal' => date('Y-m-d')
				);
				$this->db->insert('transaksi', $data);
				$this->session->set_flashdata('success', 'Data <span style="color: red;">Pengeluaran</span> baru berhasil ditambahkan');
				redirect('pengeluaran');
			}
		}
	}
}