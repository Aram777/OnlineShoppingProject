<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Products_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['products_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['products_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['products_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Products_mdl');
    }
    public function products_get()
    {

    }
    public function products_post()
    {

    }
    public function products_put()
    {
    }
    public function products_delete()
    {
    }

}
