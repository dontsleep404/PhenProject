<?php
    require_once("Models/Workspace.php");
    require_once("Models/Type.php");
    require_once("Models/Member.php");
    require_once("Models/Item.php");
    require_once("Models/GroupItem.php");
    class WorkspaceController{ 
        function toggleTask(){
            global $info;
            global $errors;
            if(!isset($_POST["itemid"]) || strlen($_POST["itemid"]) == 0) array_push($errors, "Require itemid");
            $userid = $_SESSION["user"]["userid"];

            $task = new Item();
            $find = $task->find(array(
                "itemid" => $_POST["itemid"]
            ));
            if($find){
                if($find->status == "true"){
                    $find->status = "false";
                }else{
                    $find->status = "true";
                }         
                $find->save();
                array_push($info, "Update");
            }else{
                array_push($errors, "Delete error");
            }
        } 
        function deleteTask(){
            global $info;
            global $errors;
            if(!isset($_POST["itemid"]) || strlen($_POST["itemid"]) == 0) array_push($errors, "Require itemid");
            $userid = $_SESSION["user"]["userid"];

            $task = new Item();
            $find = $task->find(array(
                "itemid" => $_POST["itemid"]
            ));
            if($find){
                $find->delete();
                array_push($info, "Delete success");
            }else{
                array_push($errors, "Delete error");
            }
        }   
        function createTask(){
            global $info;
            global $errors;
            if(!isset($_POST["workspaceid"]) || strlen($_POST["workspaceid"]) == 0) array_push($errors, "Require workspaceid");
            if(!isset($_POST["groupitemid"]) || strlen($_POST["groupitemid"]) == 0) array_push($errors, "Require groupitemid");
            $userid = $_SESSION["user"]["userid"];
            $workspace = new Workspace();
            $member = new Member();
            if(!$workspace->find(array(
                "userid" => $userid,
                "workspaceid" => $_POST["workspaceid"]
            )) && !$member->find(array(
                "userid" => $userid,
                "workspaceid" => $_POST["workspaceid"]
            ))) array_push($errors, "Error");
            if(!isset($_POST["task"]) || strlen($_POST["task"]) == 0) array_push($errors, "Require task");
            if(!$errors){
                $deadline = null;
                if(isset($_POST["deadline"])) $deadline = strtotime($_POST["deadline"]);
                $task = new Item(null, $_POST["groupitemid"], 1, $_POST["task"], $deadline, "false");
                if($task->save()){
                    array_push($info, "Success");
                }else{
                    array_push($errors, "Error");
                }
            }
        } 
        function createGroup(){
            global $info;
            global $errors;
            if(!isset($_POST["workspaceid"]) || strlen($_POST["workspaceid"]) == 0) array_push($errors, "Require workspaceid");
            if(!isset($_POST["groupitemname"]) || strlen($_POST["groupitemname"]) == 0) array_push($errors, "Require groupitemname");
            if(!$errors){
                $groupItem = new GroupItem(null, $_POST["workspaceid"], $_POST["groupitemname"]);
                if($groupItem->save()){
                    array_push($info, "Success");
                }else{
                    array_push($errors, "Error");
                }
            }
        }    
        function create(){
            global $info;
            global $errors;
            if(!isset($_POST["workspacename"]) || strlen($_POST["workspacename"]) == 0) array_push($errors, "Require workspacename");
            if(!$errors){
                $userid = $_SESSION["user"]["userid"];
                $workspace = new Workspace(0, $_POST["workspacename"], $userid);
                if($workspace->save()){
                    array_push($info, "Success");
                }else{
                    array_push($errors, "Error");
                }
            }
        }
        function edit(){
            global $info;
            global $errors;
            if(!isset($_POST["workspaceid"])) array_push($errors, "Require workspaceid");
            if(!isset($_POST["workspacename"])) array_push($errors, "Require workspacename");
            if(!$errors){
                $userid = $_SESSION["user"]["userid"];
                $workspace = new Workspace();
                if($ws = $workspace->find(array(
                    "userid" => $userid,
                    "workspaceid" => $_POST["workspaceid"]
                ))){
                    $ws->workspacename = $_POST["workspacename"];
                    if($ws->save()){
                        array_push($info, "Update success");
                    }else{
                        array_push($errors, "Update fail");
                    }
                }else{
                    array_push($errors, "Update fail");
                }
            }
        }
        function delete(){
            global $info;
            global $errors;
            if(!isset($_POST["workspaceid"])) array_push($errors, "Require workspaceid");
            if(!$errors){
                $userid = $_SESSION["user"]["userid"];
                $workspace = new Workspace();
                if($ws = $workspace->find(array(
                    "userid" => $userid,
                    "workspaceid" => $_POST["workspaceid"]
                ))){
                    if($ws->delete()){
                        array_push($info, "Delete success");
                    }else{
                        array_push($errors, "Delete fail");
                    }
                }else{
                    array_push($errors, "Delete fail");
                }
            }
        }
        function loadData($workspaceid){
            global $data;
            $data["workspace"] = array();

            $workspace = new Workspace();
            $ws = $workspace->find(array(
                "workspaceid" => $workspaceid
            ));
            if(!$ws) return false;
            $data["workspace"]["workspace"] = $ws;

            $type = new Type();
            $types = $type->findAll(array());

            $groupItem = new GroupItem();
            $groupItems = $groupItem->findAll(array(
                "workspaceid" => $workspaceid
            ));
            $data["types"] = array();
            foreach($types as $tp){
                array_push($data["types"], $tp);                
            }
            $data["workspace"]["groupname"] = array();
            $data["workspace"]["groups"] = array();                
                foreach($groupItems as $gi){
                    $data["workspace"]["groups"]["$gi->groupitemid"] = array();
                    $data["workspace"]["groupname"]["$gi->groupitemid"] = $gi->groupitemname;
                    $item = new Item();
                    $items = $item->findAll(array(
                        "groupitemid" => $gi->groupitemid,
                        "typeid" => 1
                    ));
                    foreach($items as $it){
                        array_push($data["workspace"]["groups"]["$gi->groupitemid"], $it);
                    }
                }
            echo "<script>console.log(".json_encode($data).")</script>";
            return true;
        }
        function addMember($workspaceid, $email){

        }
    }
?>