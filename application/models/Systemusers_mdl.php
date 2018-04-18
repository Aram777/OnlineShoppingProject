<?php
/**
 *
 */
class Systemusers_mdl extends CI_model
{
    public function get_systemusers()
    {
        $this->db->select('*');
        $this->db->from('systemusersview');
        return $this->db->get()->result_array();
    }
    public function get_systemuser($SystemUsersId)
    {
        $this->db->select('*');
        $this->db->from('systemusers');
        $this->db->where('SystemUsersId', $SystemUsersId);
        return $this->db->get()->result_array();
    }
    public function add_systemusers($add_data)
    {
        $this->db->insert('systemusers', $add_data);
    }
    public function update_systemusers($SystemUsersId, $update_data)
    {
        $this->db->where('SystemUsersId', $SystemUsersId);
        $this->db->update('systemusers', $update_data);
    }

    public function delete_systemusers($SystemUsersId)
    {
        $this->db->where('SystemUsersId', $SystemUsersId);
        $this->db->delete('systemusers');
    }

}
