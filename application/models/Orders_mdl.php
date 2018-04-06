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
    function get_order($ORDERSID){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('ORDERSID',$ORDERSID);
        return $this->db->get()->result_array();
      }
    function add_orders($add_data){
        $this->db->insert('orders',$add_data); 
     }
     function update_orders($ORDERSID, $update_data){
        $this->db->where('ORDERSID',$ORDERSID);
        $this->db->update('orders',$update_data);
      }
      function delete_orders($ORDERSID){
        $this->db->where('ORDERSID',$ORDERSID);
        $this->db->delete('orders');
      }
    }