<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
		$username = $this->input->get('username');
		if ($username == null){
			$data_profile_pengguna_bersangkutan = null;
			$data_data_diri = null;
		}else{
			$data_profile_pengguna_bersangkutan = $this->db->where('username', $username)->get('user')->row();
			if ($data_profile_pengguna_bersangkutan != null){
				$data_data_diri = $this->db->select('*')
											->from('data_diri_user')
											->join('user', 'data_diri_user.id_user = user.id_user')
											->where('user.id_user', $data_profile_pengguna_bersangkutan->id_user)
											->get()
											->row();
			} else {
				$data_data_diri = null;
			}
		}
        load_template('Apps/profile_index',array_merge(['data_profile' => $data_profile_pengguna_bersangkutan, 'data_diri' => $data_data_diri]));
    }

	public function edit_foto_profile()
	{
		$nama_file = $_FILES['file']['name'];
		$data_fotoProfile_lama = $this->db->where('username', $this->input->post('username'))->get('user')->row()->foto_profile;
		if ($nama_file === $data_fotoProfile_lama) {
			$this->session->set_flashdata('warning', 'Hhe, Sepertinya Ada kesalahan penanganan :<,');
			redirect('profile?username='.$this->input->post('username'));
		}

		if (file_exists('assets/upload/profile/' . $data_fotoProfile_lama) && file_exists('assets/upload/profile/' . $nama_file)) { 
			$this->session->set_flashdata('warning', 'Hhe, Sepertinya Ada kesalahan penanganan :<,');
			redirect('profile?username='.$this->input->post('username'));
		}

		if (file_exists('assets/upload/profile/profile-picture/' . $data_fotoProfile_lama) && file_exists('assets/upload/profile/profile-picture/' . $nama_file)) {
			$this->session->set_flashdata('warning', 'Hhe, Sepertinya Ada kesalahan penanganan :<,');
			redirect('profile?username='.$this->input->post('username'));
		}

		// Model untuk mengganti foto profil user
		$nama_file_tanpa_ekstensi = pathinfo($nama_file, PATHINFO_FILENAME);
		$nama_file_tanpa_ekstensi = iconv('UTF-8', 'UTF-8//IGNORE', $nama_file_tanpa_ekstensi);
		$nama_file_tanpa_ekstensi = preg_replace('/[^\p{L}\p{N}_\.]+/u', '', $nama_file_tanpa_ekstensi);

		if ($nama_file_tanpa_ekstensi === '' || preg_match('/[^\x20-\x7E]/', $nama_file_tanpa_ekstensi)) {
			$nama_file_tanpa_ekstensi = date('YmdHis');
		}

		$ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$batasan_panjang = 27;

		if (strlen($nama_file_tanpa_ekstensi) > $batasan_panjang) {
			$nama_file_tanpa_ekstensi = substr($nama_file_tanpa_ekstensi, 0, $batasan_panjang);
		}

		$nama_file_baru = $nama_file_tanpa_ekstensi . '.' . $ekstensi_file;

		$config['upload_path']          = 'assets/upload/profile';
		$config['allowed_types']        = '*';
		$config['max_size']             = 2048;
		$config['file_name']            = $nama_file_baru;

		$this->load->library('upload', $config);
		if ($nama_file == null || $nama_file == '') {
			$this->session->set_flashdata('error', 'Maaf, Data profile gagal untuk diubah,');
			redirect('profile?username='.$this->input->post('username'));
		} else if ($_FILES['file']['size'] > (1224 * 1224)) {
			$this->session->set_flashdata('error', 'Maaf, Data profile gagal untuk diubah, ukuran file terlalu besar');
			redirect('profile?username='.$this->input->post('username'));
		}else if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', 'Maaf, Data profile gagal untuk diubah, '.$error['error'].'');
			redirect('profile?username='.$this->input->post('username'));
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			if (file_exists('assets/upload/profile/'.$data_fotoProfile_lama)){
				unlink('assets/upload/profile/'.$data_fotoProfile_lama);
			}

			$data_foto_profile = array(
				'foto_profile' => $nama_file_baru
			);
			$this->db->where('username', $this->input->post('username'))->update('user', $data_foto_profile);
			$this->session->set_flashdata('success', 'Yeyy, Data profile berhasil untuk diubah, :<');
			redirect('profile?username='.$this->input->post('username'));
		}
	}

	public function edit_data_profile()
	{
		$nama = $this->input->post('nama', true) != null ? trim($this->input->post('nama', true)) : null;
		$deskrip = $this->input->post('deskripsi', true) != null ? trim($this->input->post('deskripsi', true)) : null;
		$almt_rmh = $this->input->post('alamat', true) != null ? trim($this->input->post('alamat', true)) : null;
		$no_tlp = $this->input->post('no_telp', true) != null ? trim($this->input->post('no_telp', true)) : null;
		$kecamatan = $this->input->post('kecamatan', true) != null ? trim($this->input->post('kecamatan', true)) : null;
		$kabupaten = $this->input->post('kota', true) != null ? trim($this->input->post('kota', true)) : null;
		$prov = $this->input->post('prov', true) != null ? trim($this->input->post('prov', true)) : null;
		$email = $this->input->post('email', true) != null ? trim($this->input->post('email', true)) : null;
		$id = $this->input->post('id');
		$data_username = $this->db->select('username, nama')->where('id_user', $id)->get('user')->row();
		if ($nama == null && $deskrip == null && $almt_rmh == null && $no_tlp == null && $kecamatan == null && $kabupaten == null && $prov == null && $email == null) {
			$this->session->set_flashdata('error', 'Maaf, Data profile gagal untuk diubah,');
			redirect('profile?username='.$data_username->username);
		}

		if ($nama == null){
			$this->session->set_flashdata('error', 'Maaf, Data profile gagal untuk diubah,');
			redirect('profile?username='.$data_username->username);
		}

		$data_diri = $this->db->where('id_user', $id)->get('data_diri_user')->row();

		$this->db->where('id_user', $id)->update('data_diri_user', array(
			'deskripsi' => $deskrip == null ? $data_diri->deskripsi : $deskrip,
			'alamat' => $almt_rmh == null ? $data_diri->alamat : $almt_rmh,
			'no_telp' => $no_tlp == null ? $data_diri->no_telp : $no_tlp,
			'kecamatan' => $kecamatan == null ? $data_diri->kecamatan : $kecamatan,
			'kabupaten' => $kabupaten == null ? $data_diri->kabupaten : $kabupaten,
			'provinsi' => $prov == null ? $data_diri->provinsi : $prov,
			'email' => $email == null ? $data_diri->email : $email
		));

		$this->db->where('id_user', $id)->update('user', array('nama' => $nama));
		$this->session->set_flashdata('success', 'Data Profile berhasil diubah,');
		redirect('profile?username='.$data_username->username);
	}

	public function ubah_password()
	{
		$id = $this->input->post('id');
		$data_user = $this->db->where('id_user', $id)->get('user')->row();

		$password_baru = $this->input->post('password_baru');
		$password_konfirmasi = $this->input->post('konfirmasi_password_baru');
		$password_lama = $this->input->post('password_lama');

		if ($password_baru == null || $password_konfirmasi == null) {
			$this->session->set_flashdata('error', 'Maaf, Password gagal untuk diubah,');
			redirect('profile?username='.$data_user->username);
		}

		if ($data_user->password != $password_lama){
			$this->session->set_flashdata('error', 'Maaf, Password gagal untuk diubah, pastikan password lama sama');
			redirect('profile?username='.$data_user->username);
		}


		if ($password_baru != $password_konfirmasi){
			$this->session->set_flashdata('error', 'Maaf, Password gagal untuk diubah, pastikan password konfirmasi sama');
			redirect('profile?username='.$data_user->username);
		}

		if ($data_user->password == $password_lama) {
			if ($password_baru === $password_konfirmasi){
				$this->db->where('id_user', $id)->update('user', array('password' => $password_konfirmasi));
				$this->session->set_flashdata('success', 'Berhasil, Password anda telah diubah dengan yang baru.');
				redirect('profile?username='.$data_user->username);
			} else {
				$this->session->set_flashdata('error', 'Maaf, Password gagal untuk diubah,');
				redirect('profile?username='.$data_user->username);
			}
		}
	}
}