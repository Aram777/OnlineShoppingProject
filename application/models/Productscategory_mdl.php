<?php
/**
 *
 */
class Productscategory_mdl extends CI_model
{
    public function get_productscategory($ProductsCategoryId)
    {
        $this->db->select('*');
        $this->db->from('productscategory');
        if ($ProductsCategoryId>0) {
            $this->db->where('ProductsCategoryId', $ProductsCategoryId);

        }
        return $this->db->get()->result_array();
    }
    public function add_productscategory($add_data)
    {
        $this->db->insert('productscategory', $add_data);
    }
    public function update_productscategory($ProductsCategoryId, $update_data)
    {
        $this->db->where('ProductsCategoryId', $ProductsCategoryId);
        $this->db->update('productscategory', $update_data);
    }
    public function delete_productscategory($ProductsCategoryId)
    {
        $this->db->where('ProductsCategoryId', $ProductsCategoryId);
        $this->db->delete('productscategory');
    }
}
