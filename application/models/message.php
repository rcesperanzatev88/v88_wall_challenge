<?php 

class Message extends CI_Model{


    public function validate_message(){
        $result = array("status" => "false", "data" => "", "message" => "");

        $this->load->library("form_validation");
        $config = array(
            array("field" => "message",       "label" => "Message",     "rules" => "required"),

        );

        $this->form_validation->set_rules($config);

        $result["status"] = $this->form_validation->run();
        
        if($result["status"]){
            $post_data = $this->input->post(NULL, TRUE);
            $message = array("message" => $post_data["message"], "user_id" => $this->session->userdata("user_details")["id"]);

            $result = $this->insert_message($message);
        }else{
            $result["message"] = validation_errors();
        }

        return $result;
    }

    public function validate_comment(){
        $result = array("status" => "false", "data" => "", "message" => "");

        $this->load->library("form_validation");
        $config = array(
            array("field" => "message",       "label" => "Comment",            "rules" => "required"),
            array("field" => "message_id",    "label" => "Message ID",         "rules" => "required"),

        );

        $this->form_validation->set_rules($config);

        $result["status"] = $this->form_validation->run();
        
        if($result["status"]){
            $post_data = $this->input->post(NULL, TRUE);
            $comment = array("message" => $post_data["message"], "message_id" =>  $post_data["message_id"], "user_id" => $this->session->userdata("user_details")["id"]);

            $result = $this->insert_comment($comment);
        }else{
            $result["message"] = validation_errors();
        }

        return $result;
    }

    public function insert_message($message){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = " INSERT INTO messages (user_id, message, created_at, updated_at) 
                   VALUES (?, ?, NOW(), NOW() )";
        $values = array($message["user_id"], $message["message"]);

        $result["status"] = $this->db->query($query, $values);
        $result["data"] = $this->db->insert_id();

        $result["status"] == TRUE ? $result["message"] = "Message Created Successfully" : $result["message"] = "Error in Saving Data";

        return $result;
    }

    public function insert_comment($comment){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = " INSERT INTO comments (user_id, message_id, comment, created_at, updated_at) 
                   VALUES (?, ?, ?, NOW(), NOW() )";
        $values = array($comment["user_id"],  $comment["message_id"], $comment["message"],);

        $result["status"] = $this->db->query($query, $values);
        $result["data"] = $this->db->insert_id();

        $result["status"] == TRUE ? $result["message"] = "Comnment Created Successfully" : $result["message"] = "Error in Saving Data";

        return $result;
    }

    public function fetch_messages(){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = "  SELECT messages.id, CONCAT(users.first_name, ' ', users.last_name) as creator, message, DATE_FORMAT(messages.created_at, '%M %d %Y %h %i %p') as created_at, users.id as  message_user_id,
                    JSON_ARRAYAGG(
                        CASE WHEN comments.id IS NOT NULL THEN
                            JSON_OBJECT('id', comments.id, 'creator', CONCAT(users2.first_name, ' ', users2.last_name), 'message', comment,
                            'created_at', DATE_FORMAT(comments.created_at, '%M %d %Y %h %i %p'), 'message_user_id', users2.id )
                        ELSE
                            JSON_ARRAY('')
                        END
                        ) as comments
                    FROM Messages
                    LEFT JOIN comments on comments.message_id = messages.id
                    LEFT JOIN users on users.id = messages.user_id
                    LEFT JOIN users as users2 on users2.id = comments.user_id
                    GROUP BY messages.id
                    ORDER BY messages.id DESC";

        $result["data"] = $this->db->query($query)->result_array();
        $result["status"] = TRUE;

        return $result;
    }

    public function delete_message($id){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = " DELETE FROM messages where id = ? and user_id = ? ";

        $result["status"] = $this->db->query($query, array($id, $this->session->userdata("user_details")["id"]));

        return $result;

    }

    public function delete_comment($id){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = " DELETE FROM comments where id = ? and user_id = ? ";

        $result["status"] = $this->db->query($query, array($id, $this->session->userdata("user_details")["id"]));

        return $result;

    }
}
?>