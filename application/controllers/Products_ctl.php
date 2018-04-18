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

        $products = $this->Products_mdl->get_products();

        $ProductsId = $this->get('ProductsId');

        // If the id parameter doesn't exist return all the users

        if ($ProductsId === null) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($products) {
                // Set the response and exit
                $this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No users were found',
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $ProductsId = (int) $ProductsId;

        // Validate the id.
        if ($ProductsId <= 0) {
            // Invalid id, set the response and exit.
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $product = null;

        if (!empty($products)) {
            //Get the user from database
            $product = $this->Products_mdl->get_product($ProductsId);
        }

        if (!empty($product)) {
            $this->set_response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'product could not be found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
    public function products_post()
    {

        $add_data = array(

            'ProductsCategoryId' => $this->post('ProductsCategoryId'),
            'PriceCategoryId' => $this->post('PriceCategoryId'),
            'ProductName' => $this->post('ProductName'),
            'ProductQuantity' => $this->post('ProductQuantity'),
            'ProductDesc' => $this->post('ProductDesc'),
            'ProductPicture' => $this->post('ProductPicture'),
            'ProdutMaxCapasity' => $this->post('ProdutMaxCapasity'),
            'ProductOrderPoint' => $this->post('ProductOrderPoint'),
            'ProductState' => $this->post('ProductState'),
            'ProductAddingDate' => $this->post('ProductAddingDate'),
            'ProductPrice' => $this->post('ProductPrice'),
        );
        $this->Products_mdl->add_products($add_data);
        $message = [
            'ProductsCategoryId' => $this->post('ProductsCategoryId'),
            'PriceCategoryId' => $this->post('PriceCategoryId'),
            'ProductName' => $this->post('ProductName'),
            'ProductQuantity' => $this->post('ProductQuantity'),
            'ProductDesc' => $this->post('ProductDesc'),
            'ProductPicture' => $this->post('ProductPicture'),
            'ProdutMaxCapasity' => $this->post('ProdutMaxCapasity'),
            'ProductOrderPoint' => $this->post('ProductOrderPoint'),
            'ProductState' => $this->post('ProductState'),
            'ProductAddingDate' => $this->post('ProductAddingDate'),
            'ProductPrice' => $this->post('ProductPrice'),

            'message' => 'Added a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }
    public function products_put()
    {
        // Update the orders
        $ProductsId = $this->put('ProductsId');
        $update_data = array(

            'ProductsId' => $this->put('ProductsId'),
            'ProductsCategoryId' => $this->put('ProductsCategoryId'),
            'PriceCategoryId' => $this->put('PriceCategoryId'),
            'ProductName' => $this->put('ProductName'),
            'ProductQuantity' => $this->put('ProductQuantity'),
            'ProductDesc' => $this->put('ProductDesc'),
            'ProductPicture' => $this->put('ProductPicture'),
            'ProdutMaxCapasity' => $this->put('ProdutMaxCapasity'),
            'ProductOrderPoint' => $this->put('ProductOrderPoint'),
            'ProductState' => $this->put('ProductState'),
            'ProductAddingDate' => $this->put('ProductAddingDate'),
            'ProductPrice' => $this->put('ProductPrice'),
        );

        $this->Products_mdl->update_products($PRODUCTSID, $update_data);
        $message = [
            'ProductsId' => $this->put('ProductsId'),
            'ProductsCategoryId' => $this->put('ProductsCategoryId'),
            'PriceCategoryId' => $this->put('PriceCategoryId'),
            'ProductName' => $this->put('ProductName'),
            'ProductQuantity' => $this->put('ProductQuantity'),
            'ProductDesc' => $this->put('ProductDesc'),
            'ProductPicture' => $this->put('ProductPicture'),
            'ProdutMaxCapasity' => $this->put('ProdutMaxCapasity'),
            'ProductOrderPoint' => $this->put('ProductOrderPoint'),
            'ProductState' => $this->put('ProductState'),
            'ProductAddingDate' => $this->put('ProductAddingDate'),
            'ProductPrice' => $this->put('ProductPrice'),
            'message' => 'Updates a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }

    public function products_delete()
    {
        $ProductsId = (int) $this->get('ProductsId');
        // Validate the ORDERSID.
        if ($ProductsId <= 0) {
            // Set the response and exit
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        // $this->some_model->delete_something($id);
        //check if the orders exists
        $test = $this->Products_mdl->get_products($ProductsId);
        if (!empty($test[0]['ProductsId'])) {
            $this->Products_mdl->delete_products($ProductsId);
            $message = [
                'ProductsId' => $ProductsId,
                'message' => 'Deleted the resource',
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = "Error";
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }
}
