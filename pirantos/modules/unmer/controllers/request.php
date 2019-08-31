<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MX_Controller {


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
		$this->db->where('username', $username);
		$check_uname = $this->db->get('data_user')->result();
		if (count($check_uname) > 0) {
			$feedback_msg['auth_message'] = 'username exist';
		}else{
			$insert = $this->db->insert('data_user', $data);
			if ($insert) {
				$this->db->where('username', $username);
				$hasil = $this->db->get('data_user')->row();
				$feedback_msg['data_user'] = $hasil;
				$feedback_msg['auth_message'] = 'success';
			} else {
				$feedback_msg['auth_message'] = 'fail';
			}
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
		$date = date('Ymhs');

		// personal data
		$data = $this->input->post();		

		if(move_uploaded_file($_FILES['foto_file']['tmp_name'],'./prabotan/image/ktp/'.'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION)
			))
		{ 
			$file = 'ktp'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION);
			$data['img_ktp'] = $file;
		}

		if(move_uploaded_file($_FILES['foto_file2']['tmp_name'],'./prabotan/image/kk/'.'kk'.$date.'.'.pathinfo($_FILES['foto_file2']['name'], PATHINFO_EXTENSION)
			))
		{ 
			$file = 'kk'.$date.'.'.pathinfo($_FILES['foto_file2']['name'], PATHINFO_EXTENSION);
			$data['img_kk'] = $file;
		}

		if(move_uploaded_file($_FILES['foto_file3']['tmp_name'],'./prabotan/image/nisn/'.'nisn'.$date.'.'.pathinfo($_FILES['foto_file3']['name'], PATHINFO_EXTENSION)
			))
		{ 
			$file = 'nisn'.$date.'.'.pathinfo($_FILES['foto_file3']['name'], PATHINFO_EXTENSION);
			$data['img_nisn'] = $file;
		}
		if(move_uploaded_file($_FILES['foto_file4']['tmp_name'],'./prabotan/image/ijazah/'.'ijazah'.$date.'.'.pathinfo($_FILES['foto_file4']['name'], PATHINFO_EXTENSION)
			))
		{ 
			$file = 'ijazah'.$date.'.'.pathinfo($_FILES['foto_file4']['name'], PATHINFO_EXTENSION);
			$data['img_ijazah'] = $file;
		}

		if(move_uploaded_file($_FILES['foto_file5']['tmp_name'],'./prabotan/image/foto/'.'foto'.$date.'.'.pathinfo($_FILES['foto_file5']['name'], PATHINFO_EXTENSION)
			))
		{ 
			$file = 'foto'.$date.'.'.pathinfo($_FILES['foto_file5']['name'], PATHINFO_EXTENSION);
			$data['photo'] = $file;
		}

	 	$insert_personal = $this->db->insert('unmer_calon_mahasiswa.personal_data', $data);

		if ($insert_personal) {
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
