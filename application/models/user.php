<?php 

class User extends CI_Model{
    
    public function validate_register(){
        $result = array("status" => "false", "data" => "", "message" => "");

        $this->load->library("form_validation");
        $config = array(
            array("field" => "email",       "label" => "Email Address",     "rules" => "required|valid_email"),
            array("field" => "first_name",  "label" => "First name",        "rules" => "required"),
            array("field" => "last_name",   "label" => "Last Name",         "rules" => "required"),
            array("field" => "password",    "label" => "Password",          "rules" => "required|min_length[8]"),
            array("field" => "c_password",  "label" => "Confirm Password",  "rules" => "required|matches[password]")
        );

        $this->form_validation->set_rules($config);

        $result["status"] = $this->form_validation->run();
        
        if($result["status"]){
            $post_data = $this->input->post(NULL, TRUE);
            $user = array("first_name" => $post_data["first_name"], "last_name" => $post_data["last_name"],
                          "email"=>$post_data["email"] , "password" => $post_data["password"]
                        );

            $this->insert_user($user);
            $result["message"] = 'User Created Succesfully';
        }else{
            $result["message"] = validation_errors();
        }

        return $result;
    }


    public function validate_login(){
        $result = array("status" => "false", "data" => "", "message" => "");

        $this->load->library("form_validation");
        $config = array(
            array("field" => "email_login",       "label" => "Email Address",     "rules" => "required|valid_email"),
            array("field" => "password_login",    "label" => "Password",          "rules" => "required|min_length[8]"),
        );

        $this->form_validation->set_rules($config);

        $result["status"] = $this->form_validation->run();

        if($result["status"]){
            $post_data = $this->input->post(NULL, TRUE);
            $user = array("email_login"=>$post_data["email_login"] , "password_login" => $post_data["password_login"]);

            $result = $this->check_user_login($user);
        }else{
            $result["message"] = validation_errors();
        }

        return $result;
    }

    #DOCU: function to save new user record
    public function insert_user($user){
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = md5($user["password"].$salt);
        
        $query = "  INSERT INTO users (first_name, last_name, email, salt, password, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, NOW(), NOW() )";
        $values = array($user["first_name"], $user["last_name"], $user["email"], $salt, $encrypted_password);
        return $this->db->query($query, $values);
    }

    #DOCU: function to check user to sign in the system
    public function check_user_login($user){
        $result = array("status" => "false", "data" => "", "message" => "");

        $query = "  SELECT id, first_name, last_name, email FROM users 
                    WHERE email = ? and password = md5(concat(?,salt)) ";
        $values = array($user["email_login"], $user["password_login"]);
        $query_result = $this->db->query($query, $values)->row_array();

        if($query_result == NULL){
            $result["status"] = FALSE;
            $result["message"] = "Invalid User Login";
        }else{
            $result["status"] = TRUE;
            $result["data"] =  $query_result;
        }

        return $result;
    }
}
?>