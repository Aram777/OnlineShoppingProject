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
    public function validate_user($email, $password)
    {
        $this->db->from('systemusers');
        $this->db->where('UserEmail', $email);
        $this->db->where('UserPass', $password); //sha1($password) );
        $this->db->where('UserState', 1);
        $login = $this->db->get()->result_array();
        $resultlog = array();
        if (is_array($login) && count($login) == 1) {
            $newdata = array(
                'userId' => $login[0]['SystemUsersId'],
                'username' => $login[0]['UserFirstName'],
                'email' => $email,
                'isAdmin' => $login[0]['UserType'],
                'logged_in' => 1,
            );
            $this->session->set_userdata($newdata);
            $resultlogtt = array(
                'ChkData' => 123,
                'UserFirstName' => $login[0]['UserFirstName'],
                'isAdmin' => $login[0]['UserType'],
                'logged_in' => 1);
        } else {
            $newdata = array(
                'userId' => -1,
                'username' => 'beshkan',
                'email' => '',
                'isAdmin' => -1,
                'logged_in' => 0,
            );
            $this->session->set_userdata($newdata);
            $resultlogt = array(
                'ChkData' => 111,
                'UserFirstName' => 'hichi',
                'isAdmin' => -1,
                'logged_in' => 0);
        }
        return $resultlogt;
    }

}
