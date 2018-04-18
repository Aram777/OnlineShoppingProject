<?php
/**
 *
 */
class Products_mdl extends CI_model
{
    public function get_products()
    {
        $this->db->select('*');
        $this->db->from('productsfullview');
        return $this->db->get()->result_array();
    }
    public function get_product($ProductsId)
    {
        $this->db->select('*');
        $this->db->from('productsfullview');
        $this->db->where('ProductsId', $ProductsId);

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
