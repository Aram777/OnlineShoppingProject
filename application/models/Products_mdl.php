<?php
/**
 *
 */
class Products_mdl extends CI_model
{
    public function get_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        return $this->db->get()->result_array();
    }
    public function get_product()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('PRODUCTSID',$id);

        return $this->db->get()->result_array();
    }
  
}