<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Pricecategory_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['pricecategory_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['pricecategory_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['pricecategory_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Pricecategory_mdl');
    }
    public function pricecategory_get()
    {

    }
    public function pricecategory_post()
    {

    }
    public function pricecategory_put()
    {
    }
    public function pricecategory_delete()
    {
    }

}
