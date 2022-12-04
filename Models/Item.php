<?php
    require_once("Model.php");
    class Item extends Model{
        var $itemid;
        var $groupitemid;
        var $typeid;
        var $data;
        var $deadline;
        var $status;
        function __construct($itemid = null, $groupitemid = null, $typeid = null, $data = null, $deadline = null, $status = null) {
            $this->itemid = $itemid;
            $this->groupitemid = $groupitemid;
            $this->typeid = $typeid;
            $this->data = $data;
            $this->deadline = $deadline;
            $this->status = $status;
        }
        function create(){
            return new Item();
        }
        function table_name(){
            return "item";
        }
        function primary_key(){
            return "itemid";
        }
    }
?>