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

        $products=$this->Products_mdl->get_products();

        $PRODUCTSID = $this->get('PRODUCTSID');

        // If the id parameter doesn't exist return all the users

        if ($PRODUCTSID === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($products)
            {
                // Set the response and exit
                $this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

        $PRODUCTSID = (int) $PRODUCTSID;

        // Validate the id.
        if ($PRODUCTSID <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $product = NULL;

        if (!empty($products))
        {
            //Get the user from database
            $product=$this->Products_mdl->get_product($PRODUCTSID);
        }

        if (!empty($product))
        {
            $this->set_response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
    public function products_post()
    {

// Add a new order
$add_data=array(

    'PRODUCTSCATEGORYID'=>$this->post('PRODUCTSCATEGORYID'),
    'PRICECATEGORYID'=>$this->post('PRICECATEGORYID'),
    'PRODUCNAME'=>$this->post('PRODUCNAME'),
    'PRODUCTQUANTITY'=>$this->post('PRODUCTQUANTITY'),
    'PRODUCTDESC'=>$this->post('PRODUCTDESC'),
    'PRODUCTPICTURE'=>$this->post('PRODUCTPICTURE'),
    'PRODUTMAXCAPASITY'=>$this->post('PRODUTMAXCAPASITY'),
    'PRODUCTORDERPOINT'=>$this->post('PRODUCTORDERPOINT'),
    'PRODUCTSTATE'=>$this->post('PRODUCTSTATE'),
    'PRODUCTADDINGDATE'=>$this->post('PRODUCTADDINGDATE'),
    'PRODUCTPRICE'=>$this->post('PRODUCTPRICE')
  );
  $this->Products_mdl->add_products($add_data);
  $message = [
    'PRODUCTSCATEGORYID'=>$this->post('PRODUCTSCATEGORYID'),
    'PRICECATEGORYID'=>$this->post('PRICECATEGORYID'),
    'PRODUCNAME'=>$this->post('PRODUCNAME'),
    'PRODUCTQUANTITY'=>$this->post('PRODUCTQUANTITY'),
    'PRODUCTDESC'=>$this->post('PRODUCTDESC'),
    'PRODUCTPICTURE'=>$this->post('PRODUCTPICTURE'),
    'PRODUTMAXCAPASITY'=>$this->post('PRODUTMAXCAPASITY'),
    'PRODUCTORDERPOINT'=>$this->post('PRODUCTORDERPOINT'),
    'PRODUCTSTATE'=>$this->post('PRODUCTSTATE'),
    'PRODUCTADDINGDATE'=>$this->post('PRODUCTADDINGDATE'),
    'PRODUCTPRICE'=>$this->post('PRODUCTPRICE'),

      'message' => 'Added a resource'
  ];
  $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }
    public function products_put()
    {
      // Update the orders
        $PRODUCTSID=$this->put('PRODUCTSID');
        $update_data=array(

              'PRODUCTSID'=>$this->put('PRODUCTSID'),
              'PRODUCTSCATEGORYID'=>$this->put('PRODUCTSCATEGORYID'),
              'PRICECATEGORYID'=>$this->put('PRICECATEGORYID'),
              'PRODUCNAME'=>$this->put('PRODUCNAME'),
              'PRODUCTQUANTITY'=>$this->put('PRODUCTQUANTITY'),
              'PRODUCTDESC'=>$this->put('PRODUCTDESC'),
              'PRODUCTPICTURE'=>$this->put('PRODUCTPICTURE'),
              'PRODUTMAXCAPASITY'=>$this->put('PRODUTMAXCAPASITY'),
              'PRODUCTORDERPOINT'=>$this->put('PRODUCTORDERPOINT'),
              'PRODUCTSTATE'=>$this->put('PRODUCTSTATE'),
              'PRODUCTADDINGDATE'=>$this->put('PRODUCTADDINGDATE'),
              'PRODUCTPRICE'=>$this->put('PRODUCTPRICE')
            );

        $this->Products_mdl->update_products($PRODUCTSID, $update_data);
        $message = [
          'PRODUCTSID'=>$this->put('PRODUCTSID'),
          'PRODUCTSCATEGORYID'=>$this->put('PRODUCTSCATEGORYID'),
          'PRICECATEGORYID'=>$this->put('PRICECATEGORYID'),
          'PRODUCNAME'=>$this->put('PRODUCNAME'),
          'PRODUCTQUANTITY'=>$this->put('PRODUCTQUANTITY'),
          'PRODUCTDESC'=>$this->put('PRODUCTDESC'),
          'PRODUCTPICTURE'=>$this->put('PRODUCTPICTURE'),
          'PRODUTMAXCAPASITY'=>$this->put('PRODUTMAXCAPASITY'),
          'PRODUCTORDERPOINT'=>$this->put('PRODUCTORDERPOINT'),
          'PRODUCTSTATE'=>$this->put('PRODUCTSTATE'),
          'PRODUCTADDINGDATE'=>$this->put('PRODUCTADDINGDATE'),
          'PRODUCTPRICE'=>$this->put('PRODUCTPRICE'),
            'message' => 'Updates a resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }

      public function products_delete()
        {
            $PRODUCTSID = (int) $this->get('PRODUCTSID');
            // Validate the ORDERSID.
            if ($PRODUCTSID <= 0)
            {
                // Set the response and exit
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            // $this->some_model->delete_something($id);
            //check if the orders exists
            $test=$this->Products_mdl->get_products($PRODUCTSID);
            if(!empty($test[0]['PRODUCTSID'])) {
              $this->Products_mdl->delete_products($PRODUCTSID);
              $message = [
                  'PRODUCTSID' => $PRODUCTSID,
                  'message' => 'Deleted the resource'
              ];
              $this->set_response($message, REST_Controller::HTTP_OK);
            }
            else {
              $message="Error";
              $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
            }
    }
}
