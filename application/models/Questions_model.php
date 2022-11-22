<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Questions_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_questions($ids)
    {
        $this->db->select('id,question');
        $this->db->from(QUESTION_TABLE . ' q');
        $this->db->where_in('id',$ids);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    function get_questions_ids($limit)
    {
        $this->db->select('id');
        $this->db->from(QUESTION_TABLE . ' q');
        //$this->db->where(array('username' => $username));
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function get_question_by_id($id)
    {
        $this->db->select('*');
        $this->db->from(QUESTION_TABLE . ' q');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    function get_question_id($where)
    {
        $this->db->select('id');
        $this->db->from(QUESTION_TABLE . ' q');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    function get_correct_answer($id)
    {
        $this->db->select('id,answer');
        $this->db->from(ANSWER_TABLE . ' a');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    function get_optional_answers($correct)
    {
        $this->db->select('*');
        $this->db->from(ANSWER_TABLE . ' a');
        $this->db->where(array('id !=' => $correct));
        $this->db->limit(3);
        $this->db->order_by('rand()');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
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
}