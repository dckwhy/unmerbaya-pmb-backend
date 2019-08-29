<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class request extends MX_Controller {


	public function __construct()
	{
		parent::__construct();
	}

	function antiInjection($str) {
		$r = stripslashes(strip_tags(htmlspecialchars($str, ENT_QUOTES)));
		return $r;
	}

	public function register(){
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$data = array(
			'name' => $name,
			'phone' => $phone,
			'email' => $email,
			'username' => $username,
			'pass' => $pass,
		);
		// $data = $this->input->post();
		$insert = $this->db->insert('data_user', $data);
		if ($insert) {
			$feedback_msg['auth_message'] = 'success';
		} else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
	}

	public function login()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$feedback_msg['auth'] = 'log';

		$get = $this->db->query("SELECT * FROM data_user WHERE username = '$user' AND pass = '$pass'");
		$hasil = $get->row();

		if ($hasil) {
			unset($hasil->password);
			$feedback_msg['login_data'] = $hasil;
			$feedback_msg['auth_message'] = 'success';
		} else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
	}

	public function input_data_pendaftaran(){
		// personal data
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$agama = $this->input->post('agama');
		$kota = $this->input->post('kota');
		$kecamatan = $this->input->post('kecamatan');
		$desa = $this->input->post('desa');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$nik = $this->input->post('nik');
		$nisn = $this->input->post('nisn');

		$address_all = array($alamat, ',',  $desa, ',', $kecamatan, ',', $kota);
		$address = implode($address_all);
		unset($alamat);
		unset($desa);
		unset($kecamatan);
		unset($kota);

		// detail personal
		$sekolah_asal = $this->input->post('sekolah_asal');
		$alamat_sekolah_asal = $this->input->post('alamat_sekolah_asal');
		$nama_kantor = $this->input->post('nama_kantor');
		$alamat_kantor = $this->input->post('alamat_kantor');

		$prodi = $this->input->post('prodi');
		$waktu = $this->input->post('waktu');
		$gelombang = $this->input->post('gelombang');

		$sumber_informasi = $this->input->post('sumber_informasi');
		$foto_file = $this->input->post('img_ktp');
		$foto_file2 = $this->input->post('img_kk');
		$foto_file3 = $this->input->post('img_nisn');
		$foto_file4 = $this->input->post('img_ijazah');
		$foto_file5 = $this->input->post('photo');

		$personal_data = array(
			'name' => $name,
			'gender' => $gender,
			'tgl_lahir' => $tgl_lahir,
			'tempat_lahir' => $tempat_lahir,
			'agama' => $agama,
			'address' => $address,
			'phone' => $phone,
			'nik' => $nik,
			'nisn' => $nisn,
		);
		$detail_personal_data = array(
			'sekolah_asal' => $sekolah_asal,
			'alamat_sekolah_asal' => $alamat_sekolah_asal,
			'nama_kantor' => $nama_kantor,
			'alamat_kantor' => $alamat_kantor,
			'prodi' => $prodi,
			'waktu' => $waktu,
			'gelombang' => $gelombang,
			'sumber_informasi' => $sumber_informasi,
			'img_ktp' => $foto_file,
			'img_kk' => $foto_file2,
			'img_nisn' => $foto_file3,
			'img_ijazah' => $foto_file4,
			'photo' => $foto_file5,
		);

		$date = date('Y');

		if(move_uploaded_file( $_FILES['foto_file']['tmp_name'],'./prabotan/image/ktp/'.'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION))){
			$file  = 'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION);
		}
			// $detail_personal_data['img_ktp'] = $file;

		unset($foto_file);

	// 	if(move_uploaded_file(
	// 		$_FILES['foto_file_2']['tmp_name'],
	// 		'./prabotan/image/kk/'.'kk'.$date.'.'.pathinfo($_FILES['foto_file_2']['name'], PATHINFO_EXTENSION)
	// 		)){ $file  = 'kk'.$date.'.'.pathinfo($_FILES['foto_file_2']['name'], PATHINFO_EXTENSION); }
	// 		$detail_personal_data['img_kk'] = $file;

	// 	unset($detail_personal_data['foto_file_2']);

	// 	if(move_uploaded_file(
	// 		$_FILES['foto_file_3']['tmp_name'],
	// 		'./prabotan/image/nisn/'.'nisn'.$date.'.'.pathinfo($_FILES['foto_file_3']['name'], PATHINFO_EXTENSION)
	// 		)){ $file  = 'nisn'.$date.'.'.pathinfo($_FILES['foto_file_3']['name'], PATHINFO_EXTENSION); }
	// 		$detail_personal_data['img_nisn'] = $file;

	// 	unset($detail_personal_data['foto_file_3']);

	// 	if(move_uploaded_file(
	// 		$_FILES['foto_file_4']['tmp_name'],
	// 		'./prabotan/image/ijazah/'.'ijazah'.$date.'.'.pathinfo($_FILES['foto_file_4']['name'], PATHINFO_EXTENSION)
	// 		)){ $file  = 'ijazah'.$date.'.'.pathinfo($_FILES['foto_file_4']['name'], PATHINFO_EXTENSION); }
	// 		$detail_personal_data['img_ijazah'] = $file;

	// 	unset($detail_personal_data['foto_file_4']);

	// 	if(move_uploaded_file(
	// 		$_FILES['foto_file_5']['tmp_name'],
	// 		'./prabotan/image/photo/'.'photo'.$date.'.'.pathinfo($_FILES['foto_file_5']['name'], PATHINFO_EXTENSION)
	// 		)){ $file  = 'photo'.$date.'.'.pathinfo($_FILES['foto_file_5']['name'], PATHINFO_EXTENSION); }
	// 		$detail_personal_data['photo'] = $file;

	// 	unset($detail_personal_data['foto_file_5']);

		if ($personal_data) {
			$this->db->insert('unmer_calon_mahasiswa.personal_data', $personal_data);
			$this->db->insert('unmer_calon_mahasiswa.personal_data_details', $detail_personal_data);
			$feedback_msg['auth_message'] = 'success';
		}
		else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
	}

	public function input_personal_data(){
		$data = $this->input->post();
		$address = array($data['alamat'],', ', $data['desa'],', ', $data['kecamatan'],', ', $data['kota']);
		$data['address'] = implode($address);
		unset($data['alamat']);
		unset($data['desa']);
		unset($data['kecamatan']);
		unset($data['kota']);
		$data_insert = $this->db->insert('unmer_calon_mahasiswa.personal_data', $data);
		if ($data_insert) {
			$feedback_msg['auth_message'] = 'success';
		} else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
	}

	public function input_detail_personal_data(){
		$data = $this->input->post();
		$date = date('Y');

		if(move_uploaded_file(
			$_FILES['foto_file']['tmp_name'],
			'./prabotan/image/ktp/'.'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION)
			)){ $file  = 'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION); }
			$data['img_ktp'] = $file;

		unset($data['foto_file']);

		if(move_uploaded_file(
			$_FILES['foto_file_2']['tmp_name'],
			'./prabotan/image/kk/'.'kk'.$date.'.'.pathinfo($_FILES['foto_file_2']['name'], PATHINFO_EXTENSION)
			)){ $file  = 'kk'.$date.'.'.pathinfo($_FILES['foto_file_2']['name'], PATHINFO_EXTENSION); }
			$data['img_kk'] = $file;

		unset($data['foto_file_2']);

		if(move_uploaded_file(
			$_FILES['foto_file_3']['tmp_name'],
			'./prabotan/image/nisn/'.'nisn'.$date.'.'.pathinfo($_FILES['foto_file_3']['name'], PATHINFO_EXTENSION)
			)){ $file  = 'nisn'.$date.'.'.pathinfo($_FILES['foto_file_3']['name'], PATHINFO_EXTENSION); }
			$data['img_nisn'] = $file;

		unset($data['foto_file_3']);

		if(move_uploaded_file(
			$_FILES['foto_file_4']['tmp_name'],
			'./prabotan/image/ijazah/'.'ijazah'.$date.'.'.pathinfo($_FILES['foto_file_4']['name'], PATHINFO_EXTENSION)
			)){ $file  = 'ijazah'.$date.'.'.pathinfo($_FILES['foto_file_4']['name'], PATHINFO_EXTENSION); }
			$data['img_ijazah'] = $file;

		unset($data['foto_file_4']);

		if(move_uploaded_file(
			$_FILES['foto_file_5']['tmp_name'],
			'./prabotan/image/photo/'.'photo'.$date.'.'.pathinfo($_FILES['foto_file_5']['name'], PATHINFO_EXTENSION)
			)){ $file  = 'photo'.$date.'.'.pathinfo($_FILES['foto_file_5']['name'], PATHINFO_EXTENSION); }
			$data['photo'] = $file;

		unset($data['foto_file_5']);

		$data_insert = $this->db->insert('unmer_calon_mahasiswa.personal_data_details', $data);

		if ($data_insert){
			$feedback_msg['auth_message'] = 'success';
		} else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
	}

}
?>
