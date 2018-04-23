<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Systemusers_ctl extends REST_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['systemusers_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['systemusers_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['systemusers_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Systemusers_mdl');
    }
    public function systemusers_get()
    {
        $SystemUsersId = $this->get('SystemUsersId');
        $SystemUsersId = isset($SystemUsersId) ? $SystemUsersId : 0;
        $systemusers = $this->Systemusers_mdl->get_systemusers($SystemUsersId);
        if ($systemusers) {
            $this->response($systemusers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' =>'No system user 22 were found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
    public function systemusers_post()
    {

        // Add a new systemusers
        $add_data = array(

            'UserFirstName' => $this->post('UserFirstName'),
            'UserLastName' => $this->post('UserLastName'),
            'UserEmail' => $this->post('UserEmail'),
            'UserType' => $this->post('UserType'),
            'UserState' => $this->post('UserState'),
            'UserAddress' => $this->post('UserAddress'),
            'UserPass' => $this->post('UserPass'),
        );
        $this->Systemusers_mdl->add_systemusers($add_data);
        $message = [

            'UserFirstName' => $this->post('UserFirstName'),
            'UserLastName' => $this->post('UserLastName'),
            'UserEmail' => $this->post('UserEmail'),
            'UserType' => $this->post('UserType'),
            'UserState' => $this->post('UserState'),
            'UserAddress' => $this->post('UserAddress'),
            'UserPass' => $this->post('UserPass'),
            'message' => 'Added a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }

    public function systemusers_put()
    { // Update the systemusers

        $SystemUsersId = $this->put('SystemUsersId');
        $update_data = array(
            'UserFirstName' => $this->put('UserFirstName'),
            'UserLastName' => $this->put('UserLastName'),
            'UserEmail' => $this->put('UserEmail'),
            'UserType' => $this->put('UserType'),
            'UserState' => $this->put('UserState'),
            'UserAddress' => $this->put('UserAddress'),
            'UserPass' => $this->put('UserPass'),
        );

        $this->Systemusers_mdl->update_systemusers($SystemUsersId, $update_data);
        $message = [
            'UserFirstName' => $this->put('UserFirstName'),
            'UserLastName' => $this->put('UserLastName'),
            'UserEmail' => $this->put('UserEmail'),
            'UserType' => $this->put('UserType'),
            'UserState' => $this->put('UserState'),
            'UserAddress' => $this->put('UserAddress'),
            'UserPass' => $this->put('UserPass'),
            'message' => 'Updates a resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

    }
    public function systemusers_delete()
    {$SystemUsersId = (int) $this->get('SystemUsersId');
        // Validate the SystemUsersId.
        if ($SystemUsersId <= 0) {
            // Set the response and exit
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        // $this->some_model->delete_something($id);
        //check if the systemusers exists
        $test = $this->Systemusers_mdl->get_systemusers($SystemUsersId);
        if (!empty($test[0]['SystemUsersId'])) {
            $this->Systemusers_mdl->delete_systemusers($SystemUsersId);
            $message = [
                'SystemUsersId' => $SystemUsersId,
                'message' => 'Deleted the resource',
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = "Error";
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }

}
