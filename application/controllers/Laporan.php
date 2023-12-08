<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') === NULL || !$this->session->userdata('login')) {
			redirect('login');
		}
	}

	public function Laporan()
	{
		$tipeLaporan = $this->input->post('tipeLaporan');
		$tanggalAwal = $this->input->post('tanggalAwal');
		$tanggalAkhir = $this->input->post('tanggalAkhir');

		if ($tanggalAwal === '' && $tanggalAkhir === '' && ($tipeLaporan === '' || $tipeLaporan === NULL)) {
			$this->session->set_flashdata('error', 'Maaf, Data Laporan PDF tidak dapat tergenerate, Harap cek kembali dan pilih laporan anda!');
			redirect('dash');
		} else if ($tanggalAwal === NULL && $tanggalAkhir === NULL && $tipeLaporan === NULL) {
			$this->session->set_flashdata('error', 'Maaf, Data Laporan PDF tidak dapat tergenerate, Harap cek kembali dan pilih laporan anda!');
			redirect('dash');
		} else if (($tanggalAwal === '' && $tanggalAkhir === '') && ($tipeLaporan !== '' || $tipeLaporan !== NULL)) {
			$cetak_laporan = true;
		} else if ($tanggalAwal !== '' && $tanggalAkhir !== '' && ($tipeLaporan === '' || $tipeLaporan === NULL)) {
			$cetak_laporan = true;
		} else {
			$this->session->set_flashdata('error', 'Maaf, Data Laporan PDF tidak dapat tergenerate, Harap pilih tipe Laporan anda!');
			redirect('dash');
		}

		if ($cetak_laporan == true){

			if ($tipeLaporan === 'semuaData') {
				$data['judul'] = 'Data Semua Laporan Pendataan'; 
				$data['laporan'] = $this->db->get('transaksi')->result();
			} else if ($tipeLaporan === 'semuaDataPemasukan') {
				$data['judul'] = 'Data Semua Pemasukan Laporan Pendataan'; 
				$data['laporan'] = $this->db->where('jenis_transaksi', 'Pemasukan')->get('transaksi')->result();
				$data['data_pdt_pemasukan'] = 0;
			} else if ($tipeLaporan === 'semuaDataPengeluaran'){
				$data['judul'] = 'Data Semua Pengeluaran Laporan Pendataan'; 
				$data['laporan'] = $this->db->where('jenis_transaksi', 'Pengeluaran')->get('transaksi')->result();
				$data['data_pdt_pengeluaran'] = 0;
			} else {
				$data['judul'] = 'Data Semua Laporan Pendataan berdasarkan rentang tanggal '.$tanggalAwal.' sampai '.$tanggalAkhir; 
				$data['laporan'] = $this->db->where('tanggal >=', $tanggalAwal)->where('tanggal <=', $tanggalAkhir)->get('transaksi')->result();
			}

			$this->load->view('cetak_laporan_pdf', $data);

			$paper_size = 'A4';
			$orientation = 'portrait';
			$html = $this->output->get_output();

			$this->load->library('pdf');
			$this->pdf->generate(
				$html,
				"Laporan_transaksi",
				$paper_size,
				$orientation
			);
		}else{
			$this->session->set_flashdata('error', 'Maaf, Data Laporan PDF tidak dapat tergenerate, Harap pilih tipe Laporan anda!');
			redirect('dash');
		}
	}
}