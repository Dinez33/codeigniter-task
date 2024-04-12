<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct(){
        $this->load->database();
    }

    public function get_users($username,$password){
        $query = $this->db->get_where('users' , array('username' => $username,'password' => $password ));
        return $query->result_array();
    }
    public function get_users_role($username,$password){
        $query = $this->db->get_where('users' , array('username' => $username,'password' => $password ));
        return $query->row_array();
    }
    public function insert_question($arItemData){
        $query = $this->db->insert('question' , $arItemData);
        $this->db->insert_id();
    } 
    public function insert_user($userdata){
        $query = $this->db->insert('users' , $userdata);
        $this->db->insert_id();
    } 
    public function get_Questions(){
        $query = $this->db->get_where('question', array('status' => 1));
        return $query->result_array();
    }
    public function get_User_Answers(){
        $userid = $_SESSION['user_id'];
        $query = $this->db->get_where('answer', array('user_id' => $userid));
        return $query->result_array();
    }
    public function delete_question($id){
        $data  = array(
             'status' => 2
           );
        $this->db->where('id' , $id);
        $this->db->update('question' , $data);
    }
    public function update_question($id){
        $data  = array(
            'question' => $this->input->post('question'),
            'question_type' => $this->input->post('question_type')
           );
        $this->db->where('id' , $id);
        $this->db->update('question' , $data);
    }
}