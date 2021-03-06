<?php
/**
 *
 */
class Products_mdl extends CI_model
{
    public function get_3products()
    {
        $this->db->select('*');
        $this->db->from('productsfullview');
        $this->db->limit(3);
        return $this->db->get()->result_array();
    }
    public function get_products($ProductsId)
    {
        $this->db->select('*');
        $this->db->from('productsfullview');
        if ($ProductsId > 0) {
            $this->db->where('ProductsId', $ProductsId);
        }
        return $this->db->get()->result_array();
    }
    public function add_products($add_data)
    {
        $this->db->insert('Products', $add_data);
    }
    public function update_products($ProductsId, $update_data)
    {
        $this->db->where('ProductsId', $ProductsId);
        $this->db->update('Products', $update_data);
    }
    public function delete_products($ProductsId)
    {
        $this->db->where('ProductsId', $ProductsId);
        $this->db->delete('Products');
    }
}
