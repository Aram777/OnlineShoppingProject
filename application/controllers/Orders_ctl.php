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
        // Users from a data store e.g. database
        $orders=$this->Orders_mdl->get_orders();
        $OrdersId = $this->get('OrdersId');
        // If the id parameter doesn't exist return all the users
        if ($OrdersId === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($orders)
            {
                // Set the response and exit
                $this->response($orders, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No orders were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        // Find and return a single record for a particular user.
        $OrdersId = (int) $OrdersId;
        // Validate the id.
        if ($OrdersId <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.
        $order = NULL;
        if (!empty($orders))
        {
            //Get the user from database
            $order=$this->Orders_mdl->get_order($OrdersId);
        }
        if (!empty($order))
        {
            $this->set_response($order, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'order could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function orders_post()
    {
        // Add a new order
        $add_data = array(
            'SystemUsersId' => $this->post('SystemUsersId'),
            'ProductsId' => $this->post('ProductsId'),
            'DiscountsId' => $this->post('DiscountsId'),
            'OrdersDate' => $this->post('OrdersDate'),
            'OrderStatus' => $this->post('OrderStatus'),
            'ProductRate' => $this->post('ProductRate'),
            'OrderQuantity' => $this->post('OrderQuantity'),
            'OrderPrice' => $this->post('OrderPrice')
        );
        $this->Orders_mdl->add_orders($add_data);
        $message = [

            'SystemUsersId' => $this->post('SystemUsersId'),
            'ProductsId' => $this->post('ProductsId'),
            'DiscountsId' => $this->post('DiscountsId'),
            'OrdersDate' => $this->post('OrdersDate'),
            'OrderStatus' => $this->post('OrderStatus'),
            'ProductRate' => $this->post('ProductRate'),
            'OrderQuantity' => $this->post('OrderQuantity'),
            'OrderPrice' => $this->post('OrderPrice'),
            'message' => 'Added a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }
    public function orders_put()
    {
        // Update the orders

        $OrdersId = $this->put('OrdersId');
        $ppp=$OrdersId ;
        $update_data = array(
            'SystemUsersId' => $this->put('SystemUsersId'),
            'ProductsId' => $this->put('ProductsId'),
            'DiscountsId' => $this->put('DiscountsId'),
            'OrdersDate' => $this->put('OrdersDate'),
            'OrderStatus' => $this->put('OrderStatus'),
            'ProductRate' => $this->put('ProductRate'),
            'OrderQuantity' => $this->put('OrderQuantity'),
            'OrderPrice' => $this->put('OrderPrice')
        );
        $this->Orders_mdl->update_orders($OrdersId, $update_data);
        $message = [
            'SystemUsersId' => $this->put('SystemUsersId'),
            'ProductsId' => $this->put('ProductsId'),
            'DiscountsId' => $this->put('DiscountsId'),
            'OrdersDate' => $this->put('OrdersDate'),
            'OrderStatus' => $this->put('OrderStatus'),
            'ProductRate' => $this->put('ProductRate'),
            'OrderQuantity' => $this->put('OrderQuantity'),
            'OrderPrice' => $this->put('OrderPrice'),
            'message' => 'Updates a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }
    public function orders_delete()
    {
        $OrdersId = (int) $this->get('OrdersId');
        // Validate the ORDERSID.
        if ($OrdersId <= 0) {
            // Set the response and exit
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        // $this->some_model->delete_something($id);
        //check if the orders exists
        $test = $this->Orders_mdl->get_order($OrdersId);
        if (!empty($test[0]['OrdersId'])) {
            $this->Orders_mdl->delete_orders($OrdersId);
            $message = [
                'OrdersId' => $OrdersId,
                'message' => 'Deleted the resource',
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = "Error";
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }

}
