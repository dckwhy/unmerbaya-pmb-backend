<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_data_informasi extends MX_Controller {

    public function data_informasi()
    {   
        $user_id = $this->input->post('user_id');
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $this->db->where('post_id', $value->id);
            $jumlah_like = $this->db->get('data_appreciate')->result();
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
            $value->jumlah = count($jumlah_like);
            $value->img = base_url('prabotan/image/information/'.$value->img);

            $this->db->where('post_id', $value->id);
            $this->db->where('user_id', $user_id);
            $check_like = $this->db->get('data_appreciate')->result();
            if (count($check_like) == 1) {
			    $value->msg = 'exist';                
            }

        }
        echo json_encode($get_informasi);
    }

    public function data_informasi_pendaftaran()
    {
        $user_id = $this->input->post('user_id');        
        $this->db->where('kategori', 'Pendaftaran');
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $this->db->where('post_id', $value->id);
            $jumlah_like = $this->db->get('data_appreciate')->result();
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
            $value->jumlah = count($jumlah_like);
            $value->img = base_url('prabotan/image/information/'.$value->img);

            $this->db->where('post_id', $value->id);
            $this->db->where('user_id', $user_id);
            $check_like = $this->db->get('data_appreciate')->result();
            if (count($check_like) == 1) {
			    $value->msg = 'exist';                
            }
        }
        echo json_encode($get_informasi);
    }

    public function data_informasi_jadwal()
    {
        $user_id = $this->input->post('user_id');        
        $this->db->where('kategori', 'Jadwal Tes');
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $this->db->where('post_id', $value->id);
            $jumlah_like = $this->db->get('data_appreciate')->result();
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
            $value->jumlah = count($jumlah_like);
            $value->img = base_url('prabotan/image/information/'.$value->img);

            $this->db->where('post_id', $value->id);
            $this->db->where('user_id', $user_id);
            $check_like = $this->db->get('data_appreciate')->result();
            if (count($check_like) == 1) {
			    $value->msg = 'exist';                
            }
        }
        echo json_encode($get_informasi);
    }
	
}
