<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insert_like extends MX_Controller {

    public function insert_data()
    {
        $post_id = $this->input->post('post_id');
		$user_id = $this->input->post('user_id');
		$data = array(
			'post_id' => $post_id,
			'user_id' => $user_id,
        );
		$insert_data = $this->db->insert('data_appreciate', $data);
		if ($insert_data) {
            $this->db->where('post_id', $post_id);
            $get_jumlah = $this->db->get('data_appreciate')->result();
            $feedback_msg['jumlah'] = count($get_jumlah);
			$feedback_msg['msg'] = 'success';
		} else {
			$feedback_msg['msg'] = 'fail';
		}
		echo json_encode($feedback_msg);
    }

}
?>