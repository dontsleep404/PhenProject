<?php
    require_once("Model.php");
    class GroupItem extends Model{
        var $groupitemid;
        var $workspaceid;
        var $groupitemname;
        function __construct($groupitemid = null, $workspaceid = null, $groupitemname = null) {
            $this->groupitemid = $groupitemid;
            $this->workspaceid = $workspaceid;
            $this->groupitemname = $groupitemname;
        }
        function create(){
            return new GroupItem();
        }
        function table_name(){
            return "groupitem";
        }
        function primary_key(){
            return "groupitemid";
        }
    }
?>