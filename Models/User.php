<?php
    require_once("Model.php");
    class User extends Model{
        var $userid;
        var $username;
        var $password;
        var $email;
        function __construct($userid = null, $username = null, $password = null, $email = null) {
            $this->userid = $userid;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }
        function create(){
            return new User();
        }
        function table_name(){
            return "user";
        }
        function primary_key(){
            return "userid";
        }
    }
?>