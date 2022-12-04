<?php
    require_once("Models/Workspace.php");
    require_once("Models/Member.php");
    class AppController{       
        function loadData(){
            global $data;
            $userid = $_SESSION["user"]["userid"];
            $workspace = new Workspace();
            $member = new Member();
            $workspaces_1 = $workspace->findAll(array(
                "userid" => $userid
            ));
            $members = $member->findAll(array(
                "userid" => $userid
            ));
            $workspaces = array(...$workspaces_1);
            foreach($members as $mbs){
                $tmp = $workspace->find(array(
                    "workspaceid" => $mbs->workspaceid
                ));
                array_push($workspaces, $tmp);
            }
            $data["workspaces"] = $workspaces;
        }
    }
?>