<?php
/**
 *
 */
class User_model extends CI_model
{

  function get_users(){
    $this->db->select('*');
    $this->db->from('user');
    return $this->db->get()->result_array();
  }
  function get_user($id){
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id',$id);
    return $this->db->get()->result_array();
  }
  function add_user($add_data){
    $this->db->insert('user',$add_data);
  }
  function update_user($id, $update_data){
    $this->db->where('id',$id);
    $this->db->update('user',$update_data);
  }

  function delete_user($id){
    $this->db->where('id',$id);
    $this->db->delete('user');
  }
  function get_names_freq(){
    $this->db->select('name, count(id) as freq');
    $this->db->from('user');
    $this->db->group_by('name');
    return $this->db->get()->result_array();
  }
  function get_average_ages(){
    $this->db->select('city, AVG(age) as age_avg');
    $this->db->from('age_data');
    $this->db->group_by('city');
    return $this->db->get()->result_array();
  }

}
