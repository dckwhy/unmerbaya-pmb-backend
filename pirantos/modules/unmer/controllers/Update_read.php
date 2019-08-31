<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_read extends MX_Controller {

	public function update_data()
	{
        $post_id = $this->input->post('post_id');
        
        $this->db->where('id', $post_id);
        $get_reader = $this->db->get('data_informasi')->row();

        $count = $get_reader->reader + 1;

        $data['reader'] = $count;

        $this->db->where('id', $post_id);
        $update_read = $this->db->update('data_informasi', $data);

        if ($update_read) {
            $this->db->where('id', $post_id);
            $get_reader = $this->db->get('data_informasi')->row();

            $feedback['reader'] = $get_reader->reader;
            $feedback['msg'] = 'success';
        }else {
            $feedback['msg'] = 'fail';
        }
        echo json_encode($feedback);
	}
}
