<?php
/**
 *
 */
class Productscategory_mdl extends CI_model
{
  function get_productscategory()
  {
      $this->db->select('*');
      $this->db->from('productscategory');
      return $this->db->get()->result_array();
  }
  function get_productcategory($ProductsCategoryId)
  {
      $this->db->select('*');
      $this->db->from('productscategory');
      $this->db->where('ProductsCategoryId',$ProductsCategoryId);

      return $this->db->get()->result_array();
  }
  function add_productscategory($add_data){
$this->db->insert('productscategory',$add_data);
  }
  function update_productscategory($ProductsCategoryId, $update_data){
        $this->db->where('ProductsCategoryId',$ProductsCategoryId);
        $this->db->update('productscategory',$update_data);
}
function delete_productscategory($ProductsCategoryId){
       $this->db->where('ProductsCategoryId',$ProductsCategoryId);
       $this->db->delete('productscategory');
}
}
