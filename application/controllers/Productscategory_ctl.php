<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Productscategory_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['productscategory_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['productscategory_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['productscategory_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Productscategory_mdl');
    }
    public function productscategory_get()
    {

    }
    public function productscategory_post()
    {

    }
    public function productscategory_put()
    {
    }
    public function productscategory_delete()
    {
    }

}
