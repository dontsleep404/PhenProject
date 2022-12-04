<?php
    require_once("Connection.php");
    $tmp = new Connection();
    $connection = $tmp->connection;
    abstract class Model{
        function query_status($query){            
            global $connection;
            return $connection->query($query);
        }
        function query_select($query, $all = false){
            global $connection;
            $res = $connection->query($query);
            return $res ? ($all ? $res : $res->fetch_assoc()) : false;
        }         
        function delete(){            
            $key = explode("|", $this->primary_key())[0];
            $value = $this->$key;
            $table_name = $this->table_name();
            if($this->query_status("delete from $table_name where $key = $value")){
                return true;
            }else{
                return false;
            }
        }
        function save(){
            $key = explode("|", $this->primary_key())[0];
            $value = $this->$key;
            $keys = implode(", ", $this->getKeys());
            $datas = "'".implode("', '", $this->getData())."'";
            $table_name = $this->table_name();
            $check = $this->query_select("select * from $table_name where $key = '$value'");
            if($check){
                $str = "";$first = true;$canupdate = false;
                foreach($this->getData() as $_key => $_value){
                    if($check[$_key] == $_value || $_value == null) continue;
                    $canupdate = true;
                    if(!$first){
                        $str .= ", " . $_key . " = " . (gettype($_value) == "string" ? "'" . $_value . "'" : $_value) . " ";
                    }else{
                        $str .= $_key . " = " . (gettype($_value) == "string" ? "'" . $_value . "'" : $_value) . " ";
                        $first = false;
                    }
                }
                return $canupdate && $this->query_status("update $table_name SET $str where $key = '$value'");
            }else{
                return $this->query_status("INSERT INTO $table_name($keys) VALUES ($datas)");
            }
        }
        function find($data){
            $str = "";
            $first = true;
            foreach($data as $key => $value){
                if(in_array($key, $this->filter()) || in_array($key, $this->getKeys())){
                    $v_tmp = $value;
                    $k_tmp = addSlashes($key);
                                       
                    if(gettype($value) == "string") {
                        $v_tmp = addslashes($v_tmp);
                        $v_tmp = "'$v_tmp'";
                    }                    
                    if(!$first) {
                        $str .= " and " . "$k_tmp = $v_tmp";  
                    }else{
                        $first = false;
                        $str .= "$k_tmp = $v_tmp";
                    } 
                }
            }
            $table_name = $this->table_name();
            $result = $this->query_select("select * from $table_name where $str");
            if($result){
                // $obj = $this->create();
                // foreach ($result as $key => $value){
                //     $obj->$key = $value;
                // }
                // return $obj;
                return $this->fromArray($result);
            }
            return null;
        }
        function findAll($data = array()){
            $str = "";
            $first = true;
            if(!$data) $str = "1";
            else
            foreach($data as $key => $value){
                if(in_array($key, $this->filter()) || in_array($key, $this->getKeys())){
                    $v_tmp = $value;
                    $k_tmp = addSlashes($key);
                                       
                    if(gettype($value) == "string") {
                        $v_tmp = addslashes($v_tmp);
                        $v_tmp = "'$v_tmp'";
                    }                    
                    if(!$first) {
                        $str .= " and " . "$k_tmp = $v_tmp";  
                    }else{
                        $first = false;
                        $str .= "$k_tmp = $v_tmp";
                    } 
                }
            }
            $table_name = $this->table_name();
            $result = $this->query_select("select * from $table_name where $str", true);
            $arr = array();
            while($row = $result->fetch_assoc()){
                // $obj = $this->create();
                // foreach ($row as $key => $value){
                //     $obj->$key = $value;
                // }
                array_push($arr, $this->fromArray($row));
            }
            return $arr;
        }
        function getKeys(){
            $keys = array();
            $filter = $this->filterKey();
            foreach($this as $key => $value){
                if(!in_array($key, $filter)){
                    array_push($keys, $key);
                }
            }
            return $keys;
        }
        function getData(){
            $keys = $this->getKeys();
            $data = array();
            foreach($keys as $key){
                $data[$key] = $this->$key;
            }
            return $data;
        }
        function filterKey(){
            return array(...$this->filter());
        }
        function filter(){
            return array();
        }
        function isPrimaryKey($key){
            $tmp = str_split($this->primary_key(), "|");
            return in_array($key, $tmp);
        }
        function toArray(){
            $arr = array();
            foreach($this as $key => $value){
                $arr[$key] = $value;
            }
            return $arr;
        }
        function fromArray($arr){
            $tmp = $this->create();
            foreach($tmp as $key => $value){
                if($arr[$key]){
                    $tmp->$key = $arr[$key];
                }
            }
            return $tmp;
        }
        abstract function create();
        abstract function table_name();
        abstract function primary_key();
    }
?>