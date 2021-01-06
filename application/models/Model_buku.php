<?php

class Model_buku extends CI_model
{
    public function get_buku()
    {
        return $this->db->get('produk')->result();
    }

    public function insert_produk()
    {
            $data = [
            'kodeproduk' => $p['kodeproduk'],
            'nama_produk' => $p['nama_produk'],
            'keterangan' => $p['keterangan'],
            'harga' => $p['harga'],
            'jumlah' => $p['jumlah'],
        ];

        $this->db->insert('produk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function update_produk()
    {
       
 
        $data = [
            'nama_produk' => $p['nama_produk'],
            'keterangan' => $p['keterangan'],
            'harga' => $p['harga'],
            'jumlah' => $p['jumlah'],
        ];

        $this->db->where('kodeproduk', $p['kodeproduk'])
            ->update('produk', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }





}
?>