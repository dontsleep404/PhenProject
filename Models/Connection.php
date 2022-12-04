<?php
    class Connection{
        var $connection;
        function __construct(){
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "tudu";

            $this->connection = new mysqli($host, $username, $password, $database);
            $this->connection->set_charset("utf8");
            if($this->connection->connect_error){
                die("Connection failed: " . $this->connection->connect_error);
            }
        }
    }
?>  