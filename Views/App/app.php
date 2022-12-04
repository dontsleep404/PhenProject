<?php
    $workspace = isset($_GET['workspace']) ? $_GET['workspace'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";    
    
    require_once("Controllers/WorkspaceController.php");
    $workspaceController = new WorkspaceController();    
    if(is_numeric($workspace) && $workspaceController->loadData($workspace)){
        require_once("Views/App/Workspace.php");        
    }else{
        require_once("Views/Error/SelectProject.php");
    }
?>