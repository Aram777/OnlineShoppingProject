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
        $OrdersId = $this->get('OrdersId');
        $OrdersId = isset($OrdersId) ? $OrdersId : 0;
        $orders = $this->Orders_mdl->get_orders($OrdersId);
        if ($orders) {
            $this->response($orders, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'No orders were found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function userorders_get()
    {
        $SystemUsersId = $this->get('SystemUsersId');
        $orders = $this->Orders_mdl->get_userorder($SystemUsersId);
        if ($orders) {
            $this->response($orders, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'No orders were found for this user',
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
            'OrderPrice' => $this->post('OrderPrice'),
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
        $ppp = $OrdersId;
        $update_data = array(
            'SystemUsersId' => $this->put('SystemUsersId'),
            'ProductsId' => $this->put('ProductsId'),
            'DiscountsId' => $this->put('DiscountsId'),
            'OrdersDate' => $this->put('OrdersDate'),
            'OrderStatus' => $this->put('OrderStatus'),
            'ProductRate' => $this->put('ProductRate'),
            'OrderQuantity' => $this->put('OrderQuantity'),
            'OrderPrice' => $this->put('OrderPrice'),
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

    public function ordersdel_get()
    {
        $OrdersId = $this->get('OrdersId');
        if ($OrdersId <= 0) {
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $test = $this->Orders_mdl->get_orders($OrdersId);
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

    public function orders_delete()
    {
        $OrdersId = $this->get('OrdersId');
        $OrdersId = isset($OrdersId) ? $OrdersId : 0;
        if ($OrdersId > 0) {
            $test = $this->Orders_mdl->get_orders($OrdersId);
            if (!empty($test[0]['OrdersId'])) {
                $this->Orders_mdl->delete_orders($OrdersId);
                $message = [
                    'OrdersId' => $OrdersId,
                    'message' => 'Deleted the resource',
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'OrdersId' => $OrdersId,
                    'message' => 'This ID is not exists',
                ];
                $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
            }
        }

    }
    public function orderscart_post()
    {
        // Add a new order
        $this->load->model('Products_mdl');
        $test = $this->Products_mdl->get_products($ProductsId);
        $OrderPrice=$test[0]['DiscountPrice'];

        $DiscountsId=NULL;
        $OrdersDate=date("Y/m/d");
        $OrderStatus=1;
        $ProductRate=1;
        $OrderQuantity=1;
        $add_data = array(
            'SystemUsersId' => $this->post('SystemUsersId'),
            'ProductsId' => $this->post('ProductsId'),
            'DiscountsId' =>$DiscountsId,
            'OrdersDate' => $OrdersDate,
            'OrderStatus' =>$OrderStatus,
            'ProductRate' => $ProductRate,
            'OrderQuantity' => $OrderQuantity,
            'OrderPrice' => $OrderPrice
        );
        $this->Orders_mdl->add_orders($add_data);
        $message = [
            'message' => 'Added a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }

}
