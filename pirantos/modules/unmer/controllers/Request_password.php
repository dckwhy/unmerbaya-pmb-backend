<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_password extends MX_Controller {

    public function send_password()
    {
        $username = $this->input->post('username');

		$this->db->select('username');
		$this->db->where('username', $username);
		$check_username = $this->db->get('data_user');
		if ($check_username->num_rows() == 0) {
			$feedback_msg['auth_message'] = 'fail';
		} else {
			$this->db->where('username', $username);
			$get_user = $this->db->get('data_user')->row();
			$this->load->library('email');

			$config['protocol']     = "smtp";
			$config['smtp_host']    = "smtp.gmail.com";
			$config['smtp_port']    = 587;
			$config['smtp_user']    = "umerbaya.pmb@gmail.com";
			$config['smtp_pass']    = "pmb_admin#";
			$config['newline']      = "\r\n";
			$config['mailtype']     = 'text';
			$config['charset']      = 'iso-8859-1';
			$config['smtp_crypto']  = 'tls';

			$this->email->initialize($config);

			$this->email->from('unmerbaya.pmb@gmail.com');
			$this->email->to($get_user->email);

			$this->email->subject('Login Account');
			$this->email->message('Password anda adalah:'."\r\n\r\n".'password: '.$get_user->pass);

			if($this->email->send()){
				$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			}
			else{
				$this->session->set_flashdata("email_sent","You have encountered an error");
			}

			$feedback_msg['auth_message'] = 'success';
		}
		echo json_encode($feedback_msg);
    }

}
?>