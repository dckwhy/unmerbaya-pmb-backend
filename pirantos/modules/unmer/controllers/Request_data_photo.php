<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_data_photo extends MX_Controller {

	public function get_photo()
	{
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $data_photo = $this->db->get('data_user')->row();
        $data_photo->img = base_url('prabotan/image/photo/'.$data_photo->img);

        echo json_encode($data_photo);
	}
}
