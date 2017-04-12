<?php

defined('BASEPATH') OR exit('No direct script access allowed');

const HTTP_SUCCESS = 200; // for successfull response with data
const HTTP_UNSUCCESS = 201; // for unsuccessfull response with data
const HTTP_NO_CONTENT = 204; // for  successfull response but data not found
const HTTP_UNAUTHORIZE = 401; // for unauthorize access
const SECURITY_TOKEN = "c464816f86aad7ebff9e98f2e414aa3b"; // we can use random token. for testing i used statically

class Purchase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    /*
     * Add customer form
     * Params: customer_name, offering, quantity
     */

    public function index() {
        echo $this->input->post('customerName');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('offering', 'Offering', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');
        
        if ($this->form_validation->run() == FALSE) {
            $data['offers'] = $this->Purchase_model->getOffering();
            $this->load->view('purchase', $data);
        } else {
            $data = array(
                'security_token' => SECURITY_TOKEN,
                'offeringID' => (int) $this->input->post('offering'),
                'customerName' => $this->input->post('customer_name'),
                'quantity' => $this->input->post('quantity'),
            );
            $url = base_url().'Purchase/add_purchase';
            echo $this->build_request($data, 'POST', $url);
        }
    }

    public function get() {
        $data = array(
            'security_token' => SECURITY_TOKEN,
        );
        $url = base_url().'Purchase/purchases';
        $data = $this->build_request($data, 'POST', $url);
		$lists = json_decode($data);
        $this->load->view('list',array('lists'=>$lists));
    }

    private function build_request($data, $method, $request) {
		$ch = curl_init($request);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);
        return $response;
    }

    /*
     * Define json ecode 
     * for converting php array to json
     */

    public function JSONEncode($array, $array_format = true) {
        if ($array_format)
            $array = self::My()->JSONArrayFormat($array);
        return json_encode($array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    /*
     * Define json send 
     * for sending json data to api
     */

    public function send($status_code, $response = [], $message = null) {
        $ack = 'error';
        $success = ['200', '204'];
        if (in_array($status_code, $success))
            $ack = 'success';
        else
            $message = ['errors' => $message];
        $json['status_code'] = $status_code;
        $json['ack'] = $ack;
        $json['response'] = $response;
        die($this->JSONEncode($json, 0));
    }

    /*
     * Define authentication 
     * params: security_token
     * value : c464816f86aad7ebff9e98f2e414aa3b
     */

    public function authenticateUser() {
        $security_token = $this->input->post("security_token");
        if (empty($this->input->post("security_token"))) {
            $this->send(HTTP_UNAUTHORIZE, 'Required security token');
        } else if ($security_token != SECURITY_TOKEN) {
            $this->send(HTTP_UNAUTHORIZE, 'Invalid security token');
        } else {
            return true;
        }
    }

    /*
     * Get purchase list
     */

    public function purchases() {
        $this->load->model('Purchase_model');
        $purchaseData = $this->Purchase_model->get_purchase();
        $json = [];
        empty($purchaseData) and $this->send(HTTP_NO_CONTENT);

        foreach ($purchaseData as $purchase) {
            $josn[] = [
                'id' => $purchase['id'],
                'customerName' => $purchase['customerName'],
                'offeringID' => $purchase['offeringID'],
                'title' => $purchase['title'],
                'price' => $purchase['price'],
                'quantity' => $purchase['quantity'],
            ];
        }
        $this->send(HTTP_SUCCESS, $josn);
    }

    /*
     * add purchase list 
     * params: customerName, offeringID, quantity
     */

    public function add_purchase() {
        $this->authenticateUser();
        $this->load->model('Purchase_model'); // load model
        $customerName = $this->input->post("customerName"); // get customer name 
        $offeringID = $this->input->post("offeringID"); // get offeringID
        $quantity = $this->input->post("quantity"); // get quantity

        /*         * ******* check to valid data *********** */
        if (empty($customerName)) {
            $this->send(HTTP_UNSUCCESS, 'Please enter customer name');
        }

        if (!is_numeric($offeringID)) {
            $this->send(HTTP_UNSUCCESS, 'Please enter numeric offering id');
        }

        if (!is_numeric($quantity)) {
            $this->send(HTTP_UNSUCCESS, 'Please enter numeric quantity');
        }
        /*         * *********** End validation*************** */

        $table = 'Purchase';
        $data = [
            'customerName' => $customerName,
            'offeringID' => $offeringID,
            'quantity' => $quantity
        ];
        $insert_id = $this->Purchase_model->add_purchase($table, $data);
        if ($insert_id) {
            $this->send(HTTP_SUCCESS, ['purchase_id' => $insert_id]);
        } else {
            $this->send(HTTP_SUCCESS, []);
        }
    }

}
