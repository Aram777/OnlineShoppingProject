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
  function get_productcategory($PRODUCTSCATEGORYID)
  {
      $this->db->select('*');
      $this->db->from('productscategory');
      $this->db->where('PRODUCTSCATEGORYID',$PRODUCTSCATEGORYID);

      return $this->db->get()->result_array();
  }
  function add_productscategory($add_data){
$this->db->insert('productscategory',$add_data);
  }
  function update_productscategory($PRODUCTSCATEGORYID, $update_data){
        $this->db->where('PRODUCTSCATEGORYID',$PRODUCTSCATEGORYID);
        $this->db->update('productscategory',$update_data);
}
function delete_productscategory($PRODUCTSCATEGORYID){
       $this->db->where('PRODUCTSCATEGORYID',$PRODUCTSCATEGORYID);
       $this->db->delete('productscategory');
}
}
