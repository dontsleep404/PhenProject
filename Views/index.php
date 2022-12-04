<?php
    $route = isset($_GET['route']) ? $_GET['route'] : "home"; 
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $errors = array();
    $info = array();
    $data = array();
    switch($route){
        case "home":                
            require_once("Home/Header.php");
            require_once("Home/Home.php");
            require_once("Home/Footer.php");
            break;
        case "login":
            if(isset($_SESSION["user"]) && $action != "logout"){
                header("Location: /?route=app");
                die();
            }
            require_once("Controllers/LoginController.php");
            $LoginController = new LoginController();
            switch($action){
                case "logout":
                    $LoginController->logout();
                    break;
                case "register":
                    $LoginController->register();
                    require_once("Login/Register.php");
                    break;
                default:
                    $LoginController->login();
                    require_once("Login/Login.php");
                    break;
            }
            if(isset($_SESSION["user"]) && $action != "logout"){
                echo "<script>location.href='/?route=app'</script>";
                //header("Location: /?route=app");
                die();
            }
            break;
        case "app":
            if(!isset($_SESSION["user"])){
                header("Location: /?route=login");
                die();
            }
            require_once("Models/User.php");
            $user = new User();
            $find = $user->find(array(
                "userid" => $_SESSION["user"]["userid"]
            ));
            if(!$find){
                header("Location: /?route=login");
                die();
            }else{
                $_SESSION["user"] = $find->toArray();
            }
            require_once("Controllers/WorkspaceController.php");
            $workspaceController = new WorkspaceController();
            if(isset($_POST['submit'])){
                switch($action){
                    case "create":     
                        $workspaceController->create();
                        break;
                    case "delete":     
                        $workspaceController->delete();
                        break;
                    case "edit":     
                        $workspaceController->edit();
                        break;
                    case "createGroup":     
                        $workspaceController->createGroup();
                        break;
                    case "addTask":     
                        $workspaceController->createTask();
                        break;
                    case "deleteTask":     
                        $workspaceController->deleteTask();
                        break;
                    case "toggleTask":     
                        $workspaceController->toggleTask();
                        break;
                    default:
                        break;
                }
            }
            require_once("Controllers/AppController.php");
            $app = new AppController();
            $app->loadData();
            $err = implode("\n", $errors);
            $inf = implode("\n", $info);
            if($errors){
                echo "<script>alert(\"".$err."\", \"error\")</script>";
            }
            if($info){
                echo "<script>alert(\"".$inf."\", \"info\")</script>";
            }
            require_once("Views/App/index.php");
            break;
        default:
            require_once("./Views/Error/404.php");
            break;        
    }
?>