<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Orders_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['orders_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['orders_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['orders_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Orders_mdl');
    }
    public function orders_get()
    {

    }
    public function orders_post()
    {

    }
    public function orders_put()
    {
    }
    public function orders_delete()
    {
    }

}
