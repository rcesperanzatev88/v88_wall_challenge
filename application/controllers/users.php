<?php

class Users extends CI_Controller{

    public function index(){
        $this->load->view("users/main");
    }

    
    #DOCU : Create new user
    public function create_user(){
        $result = $this->user->validate_register();
        $this->session->set_flashdata('message_register', $result["message"]);
        redirect("/");
    }

    public function signin(){
        $result = $this->user->validate_login();
        if($result["status"]){
            $this->session->set_userdata("user_details", $result["data"]); 
            redirect("/dashboard");
        }
        else{
            $this->session->set_flashdata('message_login', $result["message"]);
            redirect("/");
        }
    }
}

?>