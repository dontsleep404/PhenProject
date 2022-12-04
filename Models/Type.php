<?php
    require_once("Model.php");
    class Type extends Model{
        var $typeid;
        var $typename;
        function __construct($typeid = null, $typename = null) {
            $this->typeid = $typeid;
            $this->typename = $typename;
        }
        function create(){
            return new Type();
        }
        function table_name(){
            return "type";
        }
        function primary_key(){
            return "typeid";
        }
    }
?>