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
        // Add a new pricecategory

        $add_data=array(
          'PRICECATEGORYID'=>$this->post('PRICECATEGORYID'),
          'PRICECATPERECENT'=>$this->post('PRICECATPERECENT')
          );
        $this->Pricecategory_mdl->add_pricecategory($add_data);
        $message = [
            'PRICECATEGORYID' => $this->post('PRICECATEGORYID'), // Automatically generated by the model
            'PRICECATPERECENT' => $this->post('PRICECATPERECENT'),
            'message' => 'Added a resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function pricecategory_put()
    {
        // Update the pricecategory
        $PRICECATEGORYID=$this->put('PRICECATEGORYID');
        $update_data=array(
          'PRICECATPERECENT'=>$this->put('PRICECATPERECENT')
        );
        $this->Pricecategory_mdl->update_pricecategory($PRICECATEGORYID, $update_data);
        $message = [
            'PRICECATEGORYID' => $this->put('PRICECATEGORYID'), // Automatically generated by the model
            'PRICECATPERECENT' => $this->put('PRICECATPERECENT'),
            'message' => 'Updates a pricecategory'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }


    public function pricecategory_delete()
    {
    }


}