<?php
    require_once("Model.php");
    class Member extends Model{
        var $memberid;
        var $workspaceid;
        var $userid;
        function __construct($memberid = null, $workspaceid = null, $userid = null) {
            $this->memberid = $memberid;
            $this->workspaceid = $workspaceid;
            $this->userid = $userid;
        }
        function create(){
            return new Member();
        }
        function table_name(){
            return "member";
        }
        function primary_key(){
            return "memberid";
        }
    }
?>