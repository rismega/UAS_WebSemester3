<?php

class M_checklist extends CI_Model
{
    public $table = 'checklist';
    public $id = 'id';
    public $order = 'DESC';

    public function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function total_rows_user()
    {
        $this->db->from($this->table);
        $this->db->where('checklist.users_id', $this->session->userdata('id'));
        return $this->db->count_all_results();
    }

    function get_limit_data()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('checklist.*, toilet.lokasi as toilet_lokasi, users.nama as user_nama');
        $this->db->join('users', 'users.id  = checklist.users_id');
        $this->db->join('toilet', 'toilet.id = checklist.toilet_id');
        $this->db->order_by('tanggal', $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_limit_data_user()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('checklist.*, toilet.lokasi as toilet_lokasi, users.nama as user_nama');
        $this->db->join('users', 'users.id  = checklist.users_id');
        $this->db->join('toilet', 'toilet.id = checklist.toilet_id');
        $this->db->where('checklist.users_id', $this->session->userdata('id'));
        $this->db->order_by('tanggal', $this->order);
        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
}
