<?php
/**
 *
 */
class Pricecategory_mdl extends CI_model
{
    function get_Pricecategory(){
        $this->db->select('*');
        $this->db->from('pricecategory');
        return $this->db->get()->result_array();
      }
      function add_Pricecategory($add_data){
        $this->db->insert('pricecategory',$add_data); 
     }
     function update_pricecategory($PRICECATEGORYID, $update_data){
        $this->db->where('PRICECATEGORYID',$PRICECATEGORYID);
        $this->db->update('pricecategory',$update_data);
      }
        
}