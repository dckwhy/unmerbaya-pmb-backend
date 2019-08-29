<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_data_user extends MX_Controller {

    public function get_data_personal()
    {
        $id = $this->input->post('id');

        $this->db->where('user_id', $id);
        $get_user = $this->db->get('unmer_calon_mahasiswa.personal_data')->row();

        if (count($get_user) == 0) {
            $feedback['msg'] = 'success';
        }else{
            $feedback['msg'] = 'fail';
        }
        echo json_encode($feedback);
    }
	
}
