<?php
/**
 *
 */
class Pricecategory_mdl extends CI_model
{
    public function get_pricecategory($PriceCategoryId)
    {
        $this->db->select('*');
        $this->db->from('pricecategory');
        if ($PriceCategoryId > 0) {
            $this->db->where('PriceCategoryId', $PriceCategoryId);

        }
        return $this->db->get()->result_array();
    }
    public function add_pricecategory($add_data)
    {
        $this->db->insert('pricecategory', $add_data);
    }
    public function update_pricecategory($PriceCategoryId, $update_data)
    {
        $this->db->where('PriceCategoryId', $PriceCategoryId);
        $this->db->update('pricecategory', $update_data);
    }
    public function delete_pricecategory($PriceCategoryId)
    {
        $this->db->where('PriceCategoryId', $PriceCategoryId);
        $this->db->delete('pricecategory');
    }

}
