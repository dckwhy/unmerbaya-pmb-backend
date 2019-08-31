<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_get_status extends MX_Controller {

	public function get_status()
	{
        $user_id = $this->input->post('user_id');
        
        $this->db->where('user_id', $user_id);
        $get_data = $this->db->get('unmer_calon_mahasiswa.personal_data')->row();

        if ($get_data->status == 'Lulus') {
            $feedback['msg'] = 'Lulus';
        }else {
            $feedback['msg'] = 'Waiting';
        }
        echo json_encode($feedback);
	}
}
