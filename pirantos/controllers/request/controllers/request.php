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

	public function get_soal_ipa_matematika()
	{
		$this->db->like('code','MTK');
		$soal_ipa = $this->db->get('unmer_bank_soal.ipa')->result();
		echo json_encode($soal_ipa);
	}
	public function get_soal_ipa_fisika()
	{
		$this->db->like('code','FIS');
		$soal_ipa = $this->db->get('unmer_bank_soal.ipa')->result();
		echo json_encode($soal_ipa);
	}
	public function get_soal_ipa_kimia()
	{
		$this->db->like('code','KIM');
		$soal_ipa = $this->db->get('unmer_bank_soal.ipa')->result();
		echo json_encode($soal_ipa);
	}
	public function get_soal_ipa_biologi()
	{
		$this->db->like('code','BIO');
		$soal_ipa = $this->db->get('unmer_bank_soal.ipa')->result();
		echo json_encode($soal_ipa);
	}
	public function get_soal_ips_geografi()
	{
		$this->db->like('code','GEO');
		$soal_ips = $this->db->get('unmer_bank_soal.ips')->result();
		echo json_encode($soal_ips);
	}
	public function get_soal_ips_sejarah()
	{
		$this->db->like('code','SEJ');
		$soal_ips = $this->db->get('unmer_bank_soal.ips')->result();
		echo json_encode($soal_ips);
	}
	public function get_soal_ips_ekonomi()
	{
		$this->db->like('code','EKO');
		$soal_ips = $this->db->get('unmer_bank_soal.ips')->result();
		echo json_encode($soal_ips);
	}
	public function get_soal_ips_sosiologi()
	{
		$this->db->like('code','SOS');
		$soal_ips = $this->db->get('unmer_bank_soal.ips')->result();
		echo json_encode($soal_ips);
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
