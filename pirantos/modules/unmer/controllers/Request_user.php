<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class request_user extends MX_Controller {

    public function edit_profile()
    {
        $id = $this->input->post('id');
        $date = date('ymhs');
        $data = $this->input->post();

        $upload_file = './prabotan/image/photo/'.'photo'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION);
        if(move_uploaded_file($_FILES['foto_file']['tmp_name'], $upload_file))
		{ 	
			$file = 'photo'.$date.'.'.pathinfo($_FILES['foto_file']['name'], PATHINFO_EXTENSION);  
			$data['img'] = $file;
		}
		unset($data['foto_file']);

        $this->db->where('id', $id);
		$update = $this->db->update('data_user', $data);
		if ($update) {
            $feedback_msg['auth_message'] = 'success';
            $this->db->where('id', $id);
		    $hasil = $this->db->get('data_user')->row();
			$feedback_msg['data_user'] = $hasil;            
		} else {
			$feedback_msg['auth_message'] = 'fail';
		}
		echo json_encode($feedback_msg);
    }


}
?>