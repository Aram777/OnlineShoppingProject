<?php
/**
 *
 */
class Pricecategory_mdl extends CI_model
{
    function get_pricecategory(){
        $this->db->select('*');
        $this->db->from('pricecategory');
        return $this->db->get()->result_array();
      }
      function add_pricecategory($add_data){
        $this->db->insert('pricecategory',$add_data); 
     }
     function update_pricecategory($PriceCategoryId, $update_data){
        $this->db->where('PriceCategoryId',$PriceCategoryId);
        $this->db->update('pricecategory',$update_data);
      }
      function delete_pricecategory($PriceCategoryId){
        $this->db->where('PriceCategoryId',$PriceCategoryId);
        $this->db->delete('pricecategory');
      }
        
}