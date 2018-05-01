<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Discounts_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['discounts_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['discounts_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['discounts_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('discounts_mdl');
    }
    public function discountsdel_get()
    {
        $discountsId = $this->get('discountsId');
        $discountsId = isset($discountsId) ? $discountsId : 0;
        if ($discountsId > 0) {
            $test = $this->discounts_mdl->get_discounts($discountsId);
            if (!empty($test[0]['discountsId'])) {
                $this->discounts_mdl->delete_discounts($discountsId);
                $message = [
                    'discountsId' => $discountsId,
                    'message' => 'Deleted the resource',
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'discountsId' => $discountsId,
                    'message' => 'This ID is not exists',
                ];
                $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
            }
        }

    }

    public function discounts_get()
    {
        $discountsId = $this->get('discountsId');
        $discountsId = isset($discountsId) ? $discountsId : 0;
        $discounts = $this->discounts_mdl->get_discounts($discountsId);
        if ($discounts) {
            $this->response($discounts, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'No price category were found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
    public function discounts_post()
    {
        // Add a new discounts

        $add_data = array(
            'discountsId' => $this->post('discountsId'),
            'ProductsId' => $this->post('ProductsId'),
            'DiscountStartDate' => $this->post('DiscountStartDate'),
            'DiscountEndDate' => $this->post('DiscountEndDate'),
            'DiscountPercent' => $this->post('DiscountPercent'),
        );
        $this->discounts_mdl->add_discounts($add_data);
        $message = [
            'discountsId' => $this->post('discountsId'), // Automatically generated by the model
            'message' => 'Added a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function discounts_put()
    {
        // Update the discounts

        $discountsId = $this->put('discountsId');
        $update_data = array(
            'ProductsId' => $this->put('ProductsId'),
            'DiscountStartDate' => $this->put('DiscountStartDate'),
            'DiscountEndDate' => $this->put('DiscountEndDate'),
            'DiscountPercent' => $this->put('DiscountPercent'),
        );
        $this->discounts_mdl->update_discounts($discountsId, $update_data);
        $message = [
            'discountsId' => $discountsId, // Automatically generated by the model
            'message' => 'Updates a discounts ',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function discounts_delete()
    {

        $discountsId = $this->get('discountsId');
        if ($discountsId <= 0) {
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $test = $this->discounts_mdl->get_discounts($discountsId);
        if (!empty($test[0]['discountsId'])) {
            $this->discounts_mdl->delete_discounts($discountsId);
            $message = [
                'discountsId' => $discountsId,
                'message' => 'Deleted the resource',
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = "Error";
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }

}