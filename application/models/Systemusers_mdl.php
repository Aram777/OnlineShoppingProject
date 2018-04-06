<?php
/**
 *
 */
class Systemusers_mdl extends CI_model
{
    public function get_systemusers()
    {
        $this->db->select('*');
        $this->db->from('systemusers');
        return $this->db->get()->result_array();
    }
    public function get_systemuser($SYSTEMUSERSID)
    {
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('SYSTEMUSERSID', $SYSTEMUSERSID);
        return $this->db->get()->result_array();
    }
    public function add_systemusers($add_data)
    {
        $this->db->insert('systemusers', $add_data);
    }
    public function update_systemusers($SYSTEMUSERSID, $update_data)
    {
        $this->db->where('SYSTEMUSERSID', $SYSTEMUSERSID);
        $this->db->update('systemusers', $update_data);
    }

    public function delete_systemusers($SYSTEMUSERSID)
    {
        $this->db->where('SYSTEMUSERSID', $SYSTEMUSERSID);
        $this->db->delete('systemusers');
    }

}
