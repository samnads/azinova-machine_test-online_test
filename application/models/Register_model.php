<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function create_user($data)
    {
        $query = $this->db->insert(USER_TABLE, $data);
        return $query;
    }
    function get_user_by_username($username)
    {
        $this->db->select('*');
        $this->db->from(USER_TABLE . ' u');
        $this->db->where(array('username' => $username));
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function getAll()
    {
        $query = $this->db->get(USER_TABLE);
        return $query->result();
    }

    function set_deleted_at($where) // mark as deleted
    {
        $this->db->where($where);
        $this->db->set('deleted_at', 'NOW()', FALSE); // deleted rows have a timestamp
        $query = $this->db->update(USER_TABLE);
        return $query;
    }
    function multi_set_deleted_at($ids, $where) // mark as deleted
    {
        $this->db->where_in('id', $ids);
        $this->db->where($where);
        $this->db->set('deleted_at', 'NOW()', FALSE); // deleted rows have a timestamp
        $query = $this->db->update(USER_TABLE);
        return $query;
    }
    function create($data)
    {
        $query = $this->db->insert(USER_TABLE, $data);
        return $query;
    }
    function update($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update(USER_TABLE, $data);
        return $query;
    }
    function get_total_products_where($where)
    {
        $this->db->select('COUNT(DISTINCT p.id)	as	total_products');
        $this->db->from(USER_TABLE . '		p');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['total_products'];
    }

    function get_total_brands_where($where)
    {
        $this->db->select('COUNT(DISTINCT p.brand)	as	total_brands');
        $this->db->from(USER_TABLE . '		p');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['total_brands'];
    }
}
