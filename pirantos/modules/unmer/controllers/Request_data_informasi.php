<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_data_informasi extends MX_Controller {

    public function data_informasi()
    {   
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
        }
        echo json_encode($get_informasi);
    }

    public function data_informasi_pendaftaran()
    {
        $this->db->where('kategori', 'Pendaftaran');
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
        }
        echo json_encode($get_informasi);
    }

    public function data_informasi_jadwal()
    {
        $this->db->where('kategori', 'Jadwal Tes');
        $this->db->order_by('id', 'desc');
        $get_informasi = $this->db->get('data_informasi')->result();

        foreach ($get_informasi as $value) {
            $value->tgl = date('d M Y', strtotime($value->tanggal_publish));
            $value->content = limit_text($value->content, 15);
        }
        echo json_encode($get_informasi);
    }
	
}
