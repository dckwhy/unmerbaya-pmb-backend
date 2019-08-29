<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_detail_informasi extends MX_Controller {

    public function get_detail()
    {   
        $id = $this->input->post('id');
        $this->db->where('id' , $id);
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->row();

        echo json_encode($get_informasi);
    }
	
}
