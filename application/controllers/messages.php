<?php

class Messages extends CI_Controller{

    public function __construct(){
        parent:: __construct();
        $this->user_login = $this->session->userdata("user_details");

        if($this->user_login["id"] == ""){
            redirect("/");
        }
    }

    public function index(){
        $message_result = $this->message->fetch_messages();
        $view_details["messages"] = $this->load->view("partials/all_messages", $message_result, TRUE);
        $this->load->view("messages/main", $view_details);
    }

    public function create_message(){
        $result = $this->message->validate_message();

        
        if($result["status"] == TRUE) {
            $message_result = $this->message->fetch_messages();
            $result["data"] =  $this->load->view("partials/all_messages", $message_result, TRUE);
        }

        $result["csrf"] = $this->security->get_csrf_hash();

        echo json_encode($result);
    }


    public function create_comment(){
        $result = $this->message->validate_comment();
       
        if($result["status"] == TRUE) {
            $message_result = $this->message->fetch_messages();
            $result["data"] =  $this->load->view("partials/all_messages", $message_result, TRUE);
        }

        $result["csrf"] = $this->security->get_csrf_hash();

        echo json_encode($result);
    }


    public function delete_message(){

        $post_data = $this->input->post(NULL, true);

        $result = $this->message->delete_message($post_data["id"]);

        if($result["status"] == TRUE) {
            $message_result = $this->message->fetch_messages();
            $result["data"] =  $this->load->view("partials/all_messages", $message_result, TRUE);
        }

        $result["csrf"] = $this->security->get_csrf_hash();

        echo json_encode($result);
    }

    public function delete_comment(){

        $post_data = $this->input->post(NULL, true);

        $result = $this->message->delete_comment($post_data["id"]);

        if($result["status"] == TRUE) {
            $message_result = $this->message->fetch_messages();
            $result["data"] =  $this->load->view("partials/all_messages", $message_result, TRUE);
        }

        $result["csrf"] = $this->security->get_csrf_hash();
        
        echo json_encode($result);
    }

}
