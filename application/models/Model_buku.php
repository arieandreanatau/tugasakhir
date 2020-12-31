<?php

class Model_buku extends CI_model
{
    public function get_buku()
    {
        return $this->db->get('tbl_buku')->result();
    }

    public function insert_buku()
    {
        $p = $this->input->post();
        if(isset($_FILES['foto'])){
            echo $_FILES['foto']['tmp_name'];
        }
        
        else{
            $p = $this->input->post();
   
            $foto = $_FILES['foto']['name'];
            if($foto == '')
            {
    
            }
            else{
                $config['upload_path'] = './assets/alumni';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 5000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                    
                    
                $this->load->library('upload',$config);
    
                if(!$this->upload->do_upload('foto')){
                    echo "Upload Foto Gagal";die();
                }
                else {$foto=$this->upload->data('file_name');
                }
                
            }
        }

            $data = [
            'id_buku' => $p['id_buku'],
            'judul' => $p['judul'],
            'penulis' => $p['penulis'],
            'genre' => $p['genre'],
           
            'harga' => $p['harga'],
            
        ];

        $this->db->insert('tbl_buku', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function update_buku()
    {
        $p = $this->input->post();
        $foto = $_FILES['foto']['name'];
        if($foto == '')
        {

        }
        else{
            $config['upload_path'] = './assets/buku';
            $config['allowed_types'] = 'jpg|png|gif';
        
            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('foto')){echo "Upload Foto Gagal";die();
            }
            else {$foto=$this->upload->data('file_name');
            }
            
        }
 
        $data = [
            'foto' => $foto,
            'judul' => $p['judul'],
            'penulis' => $p['penulis'],
            'genre' => $p['genre'],
            'harga' => $p['harga'],
        ];

        $this->db->where('id_buku', $p['id_buku'])
            ->update('tbl_buku', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }


    public function alumni_buku($id_buku)
    
    {
        $db = $this->db->where('id_buku',$id_buku)
        ->get('tbl_buku')->row_array();
        return $db;
    }


}
