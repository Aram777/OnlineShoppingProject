<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Login_ctl extends REST_Controller
{
    public function login_get()
    {
        $this->load->model('Systemusers_mdl');
        $email = $this->get('email');
        $pass = $this->get('password');
        if ($email && $pass) 
        {
            $resqur=$this->Systemusers_mdl->validate_user($email, $pass);
            if ($resqur['ChkData']==123)
            {
                
                $this->set_response([
                    'status' => true,
                    'message' => 'login succeed',
                    'isAdmin'=> 1,
                    'username'=> $resqur['UserFirstName']
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => false,
                    'message' => 'login failed',
                    'isAdmin'=> 0,
                    'username'=> 'kashk'
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

            }
        } 
        else 
        {
            $this->response([
                'status' => false,
                'message' => 'Some thing is wrong in user name pass',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
    public function logout_get()
    {
        $this->session->sess_destroy();
        $this->set_response([
            'status' => true,
            'message' => 'logout'
        ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

       // $this->index();
    }
}
?>