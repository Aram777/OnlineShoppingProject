<?php
/**
 *
 */
class Products_mdl extends CI_model
{
    function get_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        return $this->db->get()->result_array();
    }
    function get_product($PRODUCTSID)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('PRODUCTSID',$PRODUCTSID);

        return $this->db->get()->result_array();
    }
  function add_products($add_data){
$this->db->insert('products',$add_data);
  }
  function update_products($PRODUCTSID, $update_data){
       $this->db->where('PRODUCTSID',$PRODUCTSID);
       $this->db->update('products',$update_data);
}
function delete_products($PRODUCTSID){
       $this->db->where('PRODUCTSID',$PRODUCTSID);
       $this->db->delete('products');
}
}
