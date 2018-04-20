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
    function get_order($OrdersId){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('OrdersId',$OrdersId);
        return $this->db->get()->result_array();
      }

      function get_userorder($SystemUsersId){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('SystemUsersId',$SystemUsersId);
        return $this->db->get()->result_array();
      }



    function add_orders($add_data){
        $this->db->insert('orders',$add_data); 
     }
     function update_orders($OrdersId, $update_data){
        $this->db->where('OrdersId',$OrdersId);
        $this->db->update('orders',$update_data);
      }
      function delete_orders($OrdersId){
        $this->db->where('OrdersId',$OrdersId);
        $this->db->delete('orders');
      }
    }
