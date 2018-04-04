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
        
}