<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Login Controller
class Login_ctl extends REST_Controller
{


/* 
    public function __construct()
    {
        parent::__construct();
        $this->methods['orders_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['orders_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['orders_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Systemusers_mdl');

        $newdata = array(
            'userId'=> '0',
            'username' => '0',
            'email' => '@',
            'isAdmin'=> 0,
            'logged_in' => 0
        );
    
        $this->session->set_userdata($newdata);
    }

 */
    public function login_get()
    {
        $this->load->model('Systemusers_mdl');
        $email = $this->get('email');
        $pass = $this->get('password');
        if ($email && $pass) {
            $resqur=$this->Systemusers_mdl->validate_user($email, $pass);
            if ($resqur['ChkData']==123){
                
                $this->set_response([
                    'status' => true,
                    'message' => 'login succeed',
                    'isAdmin'=> 1,
                    'username'=> $resqur['UserFirstName']
    
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
/*
$_SESSION['logged_in'] = false;
$data['message'] = 'You have logged out';
$this->load->view('Login/Login_frm', $data);
 */}
    

    public function index()
    {
//        echo "<script type='text/javascript'> alert('".$this->session->userdata('logged_in')."') </script>";

        $data['page'] = 'menu/testpage';
        $this->load->view('menu/showpage', $data);

/*         if ($this->session->userdata('isLoggedIn')) {
$data['page'] = 'menu/testpage';
$this->load->view('menu/showpage', $data);
} else {
$this->show_login(false);
}
 */}
    public function login_form()
    {
        $this->load->view('Login/Login_frm');
    }
    public function log_in()
    {
        $this->load->model('user_m');

        // Grab the email and password from the form POST
        /*         $user_form = $this->input->post('username');
        $pass_form = $this->input->post('password');
         */
        $pass = '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8';
        $email = 'admin@example.com';

/*         $email = $this->input->post('email');
$pass  = $this->input->post('password');
 */
        if ($email && $pass && $this->user_m->validate_user($email, $pass)) {
//            echo "<script type='text/javascript'> alert('".$this->session->userdata['username']."') </script>";

            $data['page'] = 'menu/testpage';
            $this->load->view('menu/showpage', $data);
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }

/*         $real_username = 'admin';
$real_password = 'admin123';
if ($user_form == $real_username && $pass_form == $real_password) {
// session_start();
$_SESSION['logged_in'] = true;
$_SESSION['admin'] = true;
$_SESSION['user'] = $user_form;
$data['message'] = 'You have logged in';
$data['page'] = 'menu/testpage';
$this->load->view('menu/showpage', $data);
} else {
$data['message'] = 'Username/Password did not match';
$this->load->view('login/login_frm', $data);
}
 */
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
/*
$_SESSION['logged_in'] = false;
$data['message'] = 'You have logged out';
$this->load->view('Login/Login_frm', $data);
 */}
    public function show_login($show_error = false)
    {

        $data['error'] = $show_error;
        $this->load->helper('form');
        $this->load->view('Login/Login_frm');
    }
}
