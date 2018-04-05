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
        $products=$this->Orders_mdl->get_orders();
        
                $id = $this->get('id');
        
                // If the id parameter doesn't exist return all the users
        
                if ($id === NULL)
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
                            'message' => 'No users were found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }
                }
        
                // Find and return a single record for a particular user.
        
                $id = (int) $id;
        
                // Validate the id.
                if ($id <= 0)
                {
                    // Invalid id, set the response and exit.
                    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
        
                // Get the user from the array, using the id as key for retrieval.
                // Usually a model is to be used for this.
        
                $product = NULL;
        
                if (!empty($orders))
                {
                    //Get the user from database
                    $product=$this->Orders_mdl->get_product($id);
                }
        
                if (!empty($orders))
                {
                    $this->set_response($orders, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'orders could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }
        
    public function orders_post()

        {
            // Add a new order
            $add_data=array(
              'SYSTEMUSERSID'=>$this->post('SYSTEMUSERSID'),
              'PRODUCTSID'=>$this->post('PRODUCTSID'),
              'ORDERDATE'=>$this->post('ORDERDATE'),
              'ORDERSTATUS'=>$this->post('ORDERSTATUS'),
              'PRODUCTRATE'=>$this->post('PRODUCTRATE'),
              'ORDERQUANTITY'=>$this->post('ORDERQUANTITY'),
              'ORDERPRICE'=>$this->post('ORDERPRICE')
            );
            $this->Orders_mdl->add_orders($add_data);
            $message = [
               
              'SYSTEMUSERSID'=>$this->post('SYSTEMUSERSID'),
              'PRODUCTSID'=>$this->post('PRODUCTSID'),
              'ORDERDATE'=>$this->post('ORDERDATE'),
              'ORDERSTATUS'=>$this->post('ORDERSTATUS'),
              'PRODUCTRATE'=>$this->post('PRODUCTRATE'),
              'ORDERQUANTITY'=>$this->post('ORDERQUANTITY'),
              'ORDERPRICE'=>$this->post('ORDERPRICE'),
                'message' => 'Added a resource'
            ];
            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        
    }
    public function orders_put()
    {
    }
    public function orders_delete()
    {
    }

}
