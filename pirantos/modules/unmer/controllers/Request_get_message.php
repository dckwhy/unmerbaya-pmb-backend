<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_get_message extends MX_Controller {

    public function get_message(){
		$data = $this->input->post('id');

		$this->db->where('mahasiswa_id', $data);
		$message = $this->db->get('data_message')->result();

		foreach ($message as $value) {
			if ($value->sender == 'mahasiswa') {
				$this->db->where('id', $data);
				$data_mahasiswa = $this->db->get('data_user')->row();
				$value->img = base_url('prabotan/image/photo/'.$data_mahasiswa->img);
				$value->time = date('h:i A', strtotime($value->date_send));
			}else{
				$value->img = base_url('prabotan/image/unmerbaya.png');
				$value->time = date('h:i A', strtotime($value->date_send));
				$value->layout = '
					<div class="img_cont_msg">
						<img src="" class="rounded-circle user_img_msg">
					</div>
					<div class="msg_container_reply ml-2" id="msg-container">
						<p class="content-msg mb-0" id="content-msg"></p>
						<small class="msg_time_send_admin ml-2"></small>
					</div>
			  	';
			}
		}
		echo json_encode($message);
	}
	
	public function get_data_message(){
		$data = $this->input->post('id');

		$this->db->where('mahasiswa_id', $data);
		$this->db->where('sender', 'admin');
		$this->db->where('status', 1);
		$get_message = $this->db->get('data_message')->result();
		$count = count($get_message);
		
		echo json_encode($count);
	}
    
    public function update_message_admin(){
		$data = $this->input->post('id');

		$status['status'] = 0;
		$this->db->where('mahasiswa_id', $data);
		$this->db->where('sender', 'admin');
		$update = $this->db->update('data_message', $status);

		if ($update) {
			$feedback['msg'] = 'success';
		}else{
			$feedback['msg'] = 'fail';
		}
		echo json_encode($feedback);
	}
	
}
