<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function purchases() {
        $this->load->view('users/index');
        echo "yes";
    }
}
