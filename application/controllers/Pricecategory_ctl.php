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
        $pricecategory = $this->Pricecategory_mdl->get_Pricecategory();

        if ($pricecategory) {
            // Set the response and exit
            $this->response($pricecategory, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No users were found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

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
