<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends CI_Controller
{

	public function index()
	{
		$dataTanggalBulan = date('m');
		$dataPemasukan = $this->db->where('jenis_transaksi', 'Pemasukan')->get('transaksi')->result_array();
		$dataPengeluaran = $this->db->where('jenis_transaksi', 'Pengeluaran')->get('transaksi')->result_array();
		// Pengeluaran
		$dataPengeluaranHariIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pengeluaran')->where('tanggal = date(now())')->get()->row();
		$dataPengeluaranBulanIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pengeluaran')->like('tanggal', $dataTanggalBulan)->get()->row();
		// Pemasukan
		$dataPemasukanHariIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pemasukan')->where('tanggal = date(now())')->get()->row();
		$dataPemasukanBulanIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pemasukan')->like('tanggal', $dataTanggalBulan)->get()->row();
		
		$data['pengeluaran'] = $dataPengeluaran;
		// Pengeluaran
		$data['pemasukan'] = $dataPemasukan;
        // Pemasukan
		$data['pengeluaranHariIni'] = $dataPengeluaranHariIni;
		$data['pengeluaranBulanIni'] = $dataPengeluaranBulanIni;
		// Pemasukan
		$data['pemasukanHariIni'] = $dataPemasukanHariIni;
		$data['pemasukanBulanIni'] = $dataPemasukanBulanIni;
		// redirect halaman
		$data['view'] = 'Apps/dashboard';

		$incomplete_profile = $this->session->userdata('terisi');
		if ($incomplete_profile) {
			$this->session->set_flashdata('pesan_data_diri', 
			true);
			$this->session->set_userdata('terisi', false);
		}
		load_template($data['view'], $data);
	}

}