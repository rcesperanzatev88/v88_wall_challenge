<?php

class Messages extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->user_login = $this->session->userdata("user_details");

        if($this->user_login["id"] == ""){
            redirect("/");
        }
        
    }

    public function index(){
        $message_result = $this->message->fetch_messages();
        $view_details["messages"] = $this->load->view("partials/_all_messages", $message_result, TRUE);
        $this->load->view("messages/main", $view_details);
    }

    #DOCU: function to create new message
    public function create_message(){
        $result = $this->message->validate_message();
        $result["csrf"] = $this->security->get_csrf_hash();

        $message_result = $this->message->fetch_message($result["data"]);

        $result["data"] = $this->load->view("partials/_messages", $message_result, TRUE);
        $result["form"] = "messages";

        echo json_encode($result);
    }

    #DOCU: function to create new comment
    public function create_comment(){
        $result = $this->message->validate_comment();
        $result["csrf"] = $this->security->get_csrf_hash();

        $comment_result = $this->message->fetch_comment($result["data"]);

        $result["data"] = $this->load->view("partials/_comments", $comment_result, TRUE);
        echo json_encode($result);
    }

    public function delete_message(){
        $post_data = $this->input->post(NULL, TRUE);
    
        $result = $this->message->delete_message($post_data["id"]);
        $result["csrf"] = $this->security->get_csrf_hash();

        echo json_encode($result);
    }

    public function delete_comment(){

        $post_data = $this->input->post(NULL, TRUE);
    
        $result = $this->message->delete_comment($post_data["id"]);
        $result["csrf"] = $this->security->get_csrf_hash();

        echo json_encode($result);
    }
}

?>