<?php 
include_once 'database.php';
include_once 'session.php';


/**
 * Database Connection
 */

class User{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    /**
     * User Registration Mechanism
     */
    public function userRegistration($data){
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $password   = md5($data['password']);
        $chk_email  = $this->is_email_exist($email);

        if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Field must not be empty...</div>";
            return $msg;
        }
        if (strlen($username) < 3) {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Username is too short...</div>";
            return $msg;
        }
        if (preg_match('/[^a-z0-9_-]+/i', $username) ) {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Username must contain string or numeric...</div>";
            return $msg;
        }
        if (filter_var($email,FILTER_VALIDATE_EMAIL)===true) {
           $msg = "<div class='alert alert-danger'><b>Error ! </b>Invalid Email...</div>";
           return $msg;
       }
       if ($chk_email===true) {
        $msg = "<div class='alert alert-danger'><b>Error ! </b>Email already exist...</div>";
        return $msg;
        }

        $sql = "INSERT INTO tbl_user ( name, username, email, password ) 
                VALUES ( :name, :username, :email, :password )";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':username',$username);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $result = $query->execute();

        if($result){
            $msg = "<div class='alert alert-success'><b>Success ! </b>Data inserted successfully...</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-warning'><b>Success ! </b>Failed to insert data...</div>";
            return $msg;
        }

    }


    private function is_email_exist($email){
        $sql    = "SELECT email FROM tbl_user WHERE email = :email";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        return $query->rowCount()>0 ? true : false;
    }

     /**
     * User Login Mechanism
     */

    public function getUserLogin($email,$password){

        $sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function userLogin($data){
        $email      = $data['email'];
        $password   = md5($data['password']);
        $chk_email  = $this->is_email_exist($email);
        $result     = $this->getUserLogin($email,$password);

        if ($email == "" OR $password == "") {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Field must not be empty...</div>";
            return $msg;
        }

        if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
           $msg = "<div class='alert alert-danger'><b>Error ! </b>Invalid Email...</div>";
           return $msg;
       }

       if ($chk_email===false) {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Email not exist...</div>";
            return $msg;
        }

        if ($result['password'] != $password) {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Wrong Password...</div>";
            return $msg;
        }

        if ($result) {
            Session::init();
            Session::set("login",true);
            Session::set("id",$result['id']);
            Session::set("name",$result['name']);
            Session::set("username",$result['username']);
            Session::set("loginmsg","<div class='alert alert-success'><b>Congrats ! </b>You are now logged in...</div>");
            header("Location: index.php");
        }else{
            $msg = "<div class='alert alert-danger'><b>Error ! </b>...</div>";
            return $msg;
        }
    }

    /**
    * Get user data for index page
    */
    public function getUserData(){
        $sql    = "SELECT * FROM tbl_user ORDER BY id DESC";
        $query  = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    /**
    * Get user data by id for  profile page
    */
    public function getUserDataByID($id){
        $sql    = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':id',$id);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }    

    /**
    * Update user data by id for  profile page
    */

    public function updateUserDataByID($userId,$data){
         $name       = $data['name'];
         $username   = $data['username'];
         $email      = $data['email'];

         if ($name == "" OR $username == "" OR $email == "") {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Field must not be empty...</div>";
            return $msg;
        }
        $sql    = "UPDATE tbl_user SET
                name      = :name,
                username  = :username,
                email     = :email
                WHERE id  = :id";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':id',$userId);
        $query->bindValue(':name',$name);
        $query->bindValue(':username',$username);
        $query->bindValue(':email',$email);
        $result = $query->execute();
        if ($result) {
            Session::set("username",$username);
            Session::set("name",$name);
            $msg = "<div class='alert alert-success'><b>Success ! </b>Data updated successfully..</div>";
            return $msg;
        }
    }

    /**
    * Change password machanism
    */
    private function matchedPasswrodFromDB($id,$password){
        $sql = 'SELECT password FROM tbl_user WHERE password = :password AND id = :id';
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id',$id);
        $query->bindValue(':password',md5($password));
        $query->execute();
        return $query->rowCount()>0 ? true : false;
    }
    public function updatePassword($id,$data){
        $oldpassword = $data['old_password'];
        $newpassword = $data['new_password'];
        $match_password = $this->matchedPasswrodFromDB($id,$oldpassword);

        if ($oldpassword == "" OR $newpassword == "") {
            $msg = "<div class='alert alert-danger'><b>Error ! </b>Field must not be empty...</div>";
            return $msg;
        }

        if ($match_password) {
            $sql = "UPDATE tbl_user SET password = :password WHERE id = :id";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id',$id);
            $query->bindValue(':password',md5($newpassword));
            $result = $query->execute();
            if($result){
                $msg = "<div class='alert alert-success'><b>Success ! </b>Password changed successfully.....</div>";
                return $msg;
            }
        }else{
            $msg = "<div class='alert alert-warning'><b>Sorry ! </b>Old password didn't matched..</div>";
            return $msg;
        }
    }


}