<?php
/**
 *
 */
class Orders_mdl extends CI_model
{
    public function get_orders()
    {
        $this->db->select('*');
        $this->db->from('orders');
        return $this->db->get()->result_array();
    }
    function add_orders($add_data){
        $this->db->insert('orders',$add_data); 
     }
     function update_orders($ORDERSID, $update_data){
        $this->db->where('ORDERSID',$ORDERSID);
        $this->db->update('orders',$update_data);
      }
    }
