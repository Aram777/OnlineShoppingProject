<?php
/**
 *
 */
class Orders_mdl extends CI_model
{
    public function get_orders($OrdersId)
    {
        $this->db->select('*');
        $this->db->from('orders');
        if ($OrdersId > 0) {
            $this->db->where('OrdersId', $OrdersId);
        }
        return $this->db->get()->result_array();
    }

    public function get_userorder($SystemUsersId)
    {
        $this->db->select('*');
        $this->db->from('productandorderview');
        $this->db->where('SystemUsersId', $SystemUsersId);
        $this->db->where('OrderStatus', 1);
//        $this->db->limit(4);
        return $this->db->get()->result_array();
    }

    public function add_orders($add_data)
    {
        $this->db->insert('orders', $add_data);
    }
    public function update_orders($OrdersId, $update_data)
    {
        $this->db->where('OrdersId', $OrdersId);
        $this->db->update('orders', $update_data);
    }
    public function delete_orders($OrdersId)
    {
        $this->db->where('OrdersId', $OrdersId);
        $this->db->delete('orders');
    }
    public function updateshopcart($SystemUsersId)
    {
        $update_data = array(
            'OrderStatus' => 3,
        );

        $this->db->where('SystemUsersId', $SystemUsersId);
        $this->db->where('OrderStatus', 1);
        $this->db->update('orders', $update_data);

    }
}
