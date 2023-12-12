<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		$dataTanggalBulan = date('m');
		$dataUser = $this->db->get('user')->result_array();
		$dataPemasukan = $this->db->where('jenis_transaksi', 'Pemasukan')->get('transaksi')->result_array();
		$dataPengeluaran = $this->db->where('jenis_transaksi', 'Pengeluaran')->get('transaksi')->result_array();
		// Pengeluaran
		$dataPengeluaranHariIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pengeluaran')->where('tanggal = date(now())')->get()->row();
		$dataPengeluaranBulanIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pengeluaran')->like('tanggal', $dataTanggalBulan)->get()->row();
		// Pemasukan
		$dataPemasukanHariIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pemasukan')->where('tanggal = date(now())')->get()->row();
		$dataPemasukanBulanIni = $this->db->from('transaksi')->select_sum('nominal')->where('jenis_transaksi', 'Pemasukan')->like('tanggal', $dataTanggalBulan)->get()->row();

		$data['dataUser'] = $dataUser;
		$data['pengeluaran'] = $dataPengeluaran;
		// Pengeluaran
		$data['pengeluaranHariIni'] = $dataPengeluaranHariIni;
		$data['pengeluaranBulanIni'] = $dataPengeluaranBulanIni;
		// Pemasukan
		$data['pemasukanHariIni'] = $dataPemasukanHariIni;
		$data['pemasukanBulanIni'] = $dataPemasukanBulanIni;
		// redirect halaman
		$data['pemasukan'] = $dataPemasukan;
		$data['user'] = 'Apps/user';
		load_template($data['user'], $data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Tipe user', 'required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Harap isi semua bidang!');
			redirect('user');
		} else {
			$username = $this->input->post('username');
			$nama = $this->input->post('nama');
			$password = $this->input->post('password');
			$tipeUser = $this->input->post('level');
			$usernameTrim = trim($username);
			$passwordTrim = trim($password);
			$namaTrim = trim($nama);
			$tipeUserTrim = trim($tipeUser);
			if ($usernameTrim === '' || $namaTrim === '' || $passwordTrim === '' || $tipeUserTrim === '') {
				$this->session->set_flashdata('error', 'Harap jangan hanya berisi spasi kosong!');
				redirect('user');
			} else {
				$data_username = $this->db->select('username')->get('user')->result();
				foreach ($data_username as $username_sama){
					if ($username_sama->username === $usernameTrim){
						$cek_username = true;
					}
				}
				if (isset($cek_username)){
					if ($cek_username === true){
						$this->session->set_flashdata('error', 'Maaf, Username yang anda gunakan telah dipakai sebelumnya,');
						redirect('user');
					}
				}
				// cek valid username //

				$data_profile = array(
					'profile_1.jpg',
					'profile_2.jpg',
					'profile_3.jpg',
					'profile_4.jpg',
					'profile_5.jpg',
					'profile_6.jpg',
					'profile_7.jpg',
					'profile_8.jpg',
					'profile_9.jpg',
				);

				$data = array(
					'username' => $username,
					'nama' => $nama,
					'password' => $password,
					'level' => $tipeUser,
					'foto_profile' => $data_profile[array_rand($data_profile)]
				);

				$this->db->insert('user', $data);
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				redirect('user');
			}
		}
	}

	public function halaman_edit($id)
	{
		$this->db->from('user');
		$this->db->where('id_user', $id);
		$query = $this->db->get()->row();
		$data['data'] = $query;
		$html = $this->load->view('edit_dataPengguna', $data, true);
    	echo $html;
	}

	public function editData()
	{
		$id = $this->input->post('id_user');
		$nama     = $this->input->post('nama');
		$level    = $this->input->post('level');
		$dataPengguna = $this->db->from('user')->where('id_user', $id)->get()->row();

		$usernameTrim = trim($username);
		$namaTrim = trim($nama);
		$levelTrim = trim($level);

		if ($namaTrim === '' || $levelTrim === '') {
			$this->session->set_flashdata('error', 'Maaf, terjadi kesalahan dalam Mengedit data!');
			redirect('user');
		} else if ($namaTrim == $dataPengguna->nama && $levelTrim == $dataPengguna->level) {
			$this->session->set_flashdata('warning', 'Hhe, sepertinya anda tidak mengubah apapun!');
			redirect('user');
		} else {
			$data_username = $this->db->select('username')->get('user')->result();
			foreach ($data_username as $username_sama){
				if ($username_sama->username === $usernameTrim){
					$cek_username = true;
				}
			}
			if (isset($cek_username)){
				if ($cek_username === true){
					$this->session->set_flashdata('error', 'Maaf, Username yang anda gunakan telah dipakai sebelumnya,');
					redirect('user');
				}
			}
			
			$data = array(
				'nama' => $namaTrim,
				'level' => $levelTrim
			);
			$this->db->where('id_user', $id);
			$this->db->update('user', $data);
			$this->session->set_flashdata('success', 'Data berhasil diedit,');
			redirect('user');
		}
	}

	public function hapusData($id){
		$this->db->where('id_user', $id);
		$this->db->delete('user');

		$this->session->set_flashdata('success', 'Oke, Data berhasil dihapus');
		redirect('user');
	}

	public function hapusPemasukan($id){
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');

		$this->session->set_flashdata('success', 'Oke, Data berhasil dihapus');
		redirect('user');
	}
	public function hapusPengeluaran($id){
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');

		$this->session->set_flashdata('success', 'Oke, Data berhasil dihapus');
		redirect('user');
	}

	public function pemasukan(){
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
					'jenis_transaksi' => 'Pemasukan',
					'tanggal' => date('Y-m-d')
				);
				$this->db->insert('transaksi', $data);
				$this->session->set_flashdata('success', 'Data <span style="color: green;">Pemasukan</span> baru berhasil ditambahkan');
				redirect('user');
			}
		}
	}

	public function pengeluaran(){
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
				redirect('user');
			}
		}
	}

	public function hapus_data($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user');

		$this->session->set_flashdata('success', 'Data pengguna terkait berhasil dihapus,');
		redirect('user');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
