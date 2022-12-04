<?php
    require_once("Model.php");
    class Workspace extends Model{
        var $workspaceid;
        var $workspacename;
        var $userid;
        function __construct($workspaceid = null, $workspacename = null, $userid = null) {
            $this->workspaceid = $workspaceid;
            $this->workspacename = $workspacename;
            $this->userid = $userid;
        }
        function create(){
            return new Workspace();
        }
        function table_name(){
            return "workspace";
        }
        function primary_key(){
            return "workspaceid";
        }
    }
?>