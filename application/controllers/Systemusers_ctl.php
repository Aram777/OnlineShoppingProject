<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Systemusers_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['systemusers_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['systemusers_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['systemusers_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Systemusers_mdl');
    }
    public function systemusers_get()
    {

    }
    public function systemusers_post()
    {

    }
    public function systemusers_put()
    {
    }
    public function systemusers_delete()
    {
    }

}
