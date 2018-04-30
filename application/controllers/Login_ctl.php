<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Login_ctl extends REST_Controller
{
    public function logindata_get()
    {
        $result_log = -1;
        $msgres='session is expierd';
        $usrid = $this->get('usrId');
        
        if ($this->session->has_userdata('logged_in')) {
            if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('userId') == $usrid) {
                $msgres='Log in data ok';
                $result_log = 1;
            }
        }
        $this->set_response([
            'status' => true,
            'message' =>$msgres,
            'logged_in'=> $result_log
        ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
    }
    public function login_get()
    {
        $hasorder=0;
        $this->load->model('Systemusers_mdl');
        $email = $this->get('email');
        $pass = $this->get('password');
        if ($email && $pass) {
            $resqur = $this->Systemusers_mdl->validate_user($email, $pass);
            if ($resqur['userId'] > 0) {
                $this->load->model('Orders_mdl');
                $orders=$this->Orders_mdl->get_userorder($resqur['userId']);
                if (count($orders) >0) {
                    $hasorder=count($orders);
                }

                $this->set_response([
                    'status' => true,
                    'message' => 'login succeed',
                    'isAdmin' => $resqur['isAdmin'],
                    'username' => $resqur['username'],
                    'userId'=>$resqur['userId'],
                    'hasorder'=>$hasorder
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => false,
                    'message' => 'login failed',
                    'isAdmin' => -1,
                    'username' => 'khali',//$resqur['username'],
                    'userId'=>-1,
                    'hasorder'=>$hasorder
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

            }
        } else {
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
            'message' => 'logout',
        ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

        // $this->index();
    }
}
