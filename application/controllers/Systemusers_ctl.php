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
        $systemusers=$this->Systemusers_mdl->get_systemusers();
        
                $SYSTEMUSERSID = $this->get('SYSTEMUSERSID');
        
                // If the id parameter doesn't exist return all the users
        
                if ($SYSTEMUSERSID === NULL)
                {
                    // Check if the users data store contains users (in case the database result returns NULL)
                    if ($systemusers)
                    {
                        // Set the response and exit
                        $this->response($systemusers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                    }
                    else
                    {
                        // Set the response and exit
                        $this->response([
                            'status' => FALSE,
                            'message' => 'No systemusers were found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }
                }
        
                // Find and return a single record for a particular user.
        
                $SYSTEMUSERSID = (int) $SYSTEMUSERSID;
        
                // Validate the id.
                if ($SYSTEMUSERSID <= 0)
                {
                    // Invalid id, set the response and exit.
                    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
        
                // Get the systemuser from the array, using the systemuserid as key for retrieval.
                // Usually a model is to be used for this.
        
                $systemusers = NULL;
        
                if (!empty($systemusers))
                {
                    //Get the user from database
                    $systemusers=$this->Systemusers_mdl->get_($SYSTEMUSERSID);
                }
        
                if (!empty($systemusers))
                {
                    $this->set_response($systemusers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'systemusers could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            

    }
    public function systemusers_post()
    {
        
        // Add a new systemusers
        $add_data=array(
          
          'USERFIRSTNAME'=>$this->post('USERFIRSTNAME'),
          'USERLASTNAME'=>$this->post('USERLASTNAME'),
          'USEREMAIL'=>$this->post('USEREMAIL'),
          'USERTYPE'=>$this->post('USERTYPE'),
          'USERSTATE'=>$this->post('USERSTATE'),
          'USERADDRESS'=>$this->post('USERADDRESS'),
          'USERPASS'=>$this->post('USERPASS')
        );
        $this->Systemusers_mdl->add_systemusers($add_data);
        $message = [
            
            'USERFIRSTNAME'=>$this->post('USERFIRSTNAME'),
            'USERLASTNAME'=>$this->post('USERLASTNAME'),
            'USEREMAIL'=>$this->post('USEREMAIL'),
            'USERTYPE'=>$this->post('USERTYPE'),
            'USERSTATE'=>$this->post('USERSTATE'),
            'USERADDRESS'=>$this->post('USERADDRESS'),
            'USERPASS'=>$this->post('USERPASS'),
            'message' => 'Added a resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    
}

    
    public function systemusers_put()
    {// Update the systemusers


        $SYSTEMUSERSID=$this->put('SYSTEMUSERSID');
        $update_data=array(
            'USERFIRSTNAME'=>$this->put('USERFIRSTNAME'),
            'USERLASTNAME'=>$this->put('USERLASTNAME'),
            'USEREMAIL'=>$this->put('USEREMAIL'),
            'USERTYPE'=>$this->put('USERTYPE'),
            'USERSTATE'=>$this->put('USERSTATE'),
            'USERADDRESS'=>$this->put('USERADDRESS'),
            'USERPASS'=>$this->put('USERPASS')
          );

        $this->Systemusers_mdl->update_systemusers($SYSTEMUSERSID, $update_data);
        $message = [
            'USERFIRSTNAME'=>$this->put('USERFIRSTNAME'),
            'USERLASTNAME'=>$this->put('USERLASTNAME'),
            'USEREMAIL'=>$this->put('USEREMAIL'),
            'USERTYPE'=>$this->put('USERTYPE'),
            'USERSTATE'=>$this->put('USERSTATE'),
            'USERADDRESS'=>$this->put('USERADDRESS'),
            'USERPASS'=>$this->put('USERPASS'),
            'message' => 'Updates a resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    
    }
    public function systemusers_delete()
    {
    }

}
