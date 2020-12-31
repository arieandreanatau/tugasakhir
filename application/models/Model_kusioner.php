<?php

class Model_kusioner extends CI_model
{
    public function get_kusioner()
    {
        return $this->db->where('is_created', '1')
            ->get('tbl_kuisioner')->result();
    }
    public function get_kusionerById($id_kuisioner)
    {
        return $this->db->where('id_kuisioner', $id_kuisioner)
            ->get('tbl_kuisioner')->row_array();
    }

    public function update_kuisioner($id, $data)
    {
        $this->db->where('id_kuisioner', $id)
            ->update('tbl_kuisioner', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function get_pertanyaan($id)
    {
        return $this->db->where('id_kuisioner', $id)->get('tbl_pertanyaan')->result_array();
    }

    public function last_data()
    {
        $this->db->order_by('id_kuisioner', 'DESC')
            ->limit(1);

        return $this->db->get('tbl_kuisioner')->row_array();
    }

    public function tambah_pertanyaan($data)
    {
        $this->db->insert('tbl_pertanyaan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
}
