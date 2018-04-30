<?php
/**
 *
 */
class Systemusers_mdl extends CI_model
{
    public function get_systemusers($SystemUsersId)
    {
        $this->db->select('*');
        $this->db->from('systemusersview');
        if ($SystemUsersId > 0) {
            $this->db->where('SystemUsersId', $SystemUsersId);
        }
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
        $this->db->where('UserPass',$password); // sha1($password));
        $this->db->where('UserState', 1);
        $login = $this->db->get()->result_array();
        $newdata = array(
            'userId' => -1,
            'username' => 'khali',
            'email' => 'khali',
            'isAdmin' => 'khali',
            'logged_in' => 0
        );
   
        if (is_array($login) && count($login) == 1) {
                $newdata['userId'] = $login[0]['SystemUsersId'];
                $newdata['username'] = $login[0]['UserFirstName'];
                $newdata['email'] = $email;
                $newdata['isAdmin'] = $login[0]['UserType'];
                $newdata['logged_in'] = 1;
            $this->session->set_userdata($newdata);
        } else {
            $newdata['userId'] = -1; //$login[0]['SystemUsersId'],
            $newdata['username'] = 'beshkan';
            $newdata['email'] = 'khali';
            $newdata['isAdmin'] = -1;
            $newdata['logged_in'] = 0;

            $this->session->set_userdata($newdata);
        }
        return $newdata;
    }

}
