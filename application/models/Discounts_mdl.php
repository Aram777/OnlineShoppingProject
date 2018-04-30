<?php
/**
 *
 */
class Discounts_mdl extends CI_model
{
    public function get_discounts($discountsId)
    {
        $sqltxt='discountsId, PriceCatPerecent, ifnull((select tt.discountsId from products tt where tt.discountsId= discounts.discountsId limit 1),0) as Chkuse ';
        $this->db->select($sqltxt);
        $this->db->from('discounts');
        if ($discountsId > 0) {
            $this->db->where('discountsId', $discountsId);

        }
        return $this->db->get()->result_array();
    }
    public function add_discounts($add_data)
    {
        $this->db->insert('discounts', $add_data);
    }
    public function update_discounts($discountsId, $update_data)
    {
        $this->db->where('discountsId', $discountsId);
        $this->db->update('discounts', $update_data);
    }
    public function delete_discounts($discountsId)
    {
        $this->db->where('discountsId', $discountsId);
        $this->db->delete('discounts');
    }

}
