<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_send_message extends MX_Controller {

    
    public function send_message(){
        $data = $this->input->post();
        $data['date_send'] = date ('Y-m-d H:m');

        $data_insert = $this->db->insert('data_message', $data);

        if ($data_insert) {
            $feedback ['msg'] = 'success';
        }else{
            $feedback ['msg'] = 'fail';
        }

        echo json_encode($feedback);
    }
	
}
