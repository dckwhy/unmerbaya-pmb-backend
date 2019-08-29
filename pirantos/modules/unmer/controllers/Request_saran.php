<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_saran extends MX_Controller {

    public function kirim_saran()
    {
        $nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telp = $this->input->post('no_telp');
        $pesan = $this->input->post('pesan');
		$data = array(
			'nama' => $nama,
			'email' => $email,
			'no_telp' => $telp,
            'pesan' => $pesan,
        );
		$insert_data = $this->db->insert('data_saran_pmb', $data);
		if ($insert_data) {
			$feedback_msg['msg'] = 'success';
		} else {
			$feedback_msg['msg'] = 'fail';
		}
		echo json_encode($feedback_msg);
    }

}
?>