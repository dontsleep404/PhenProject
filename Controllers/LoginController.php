<?php
    require_once("Models/User.php");
    class LoginController{       
        function login(){
            global $errors;
            global $info;
            if(isset($_POST['submit'])){
                if(!isset($_POST['username'])) array_push($errors, "Require Username");
                if(!isset($_POST['password'])) array_push($errors, "Require Password");
                if(count($errors) == 0){
                    $user = new User();
                    if($find = $user->find(array(
                        "username" => $_POST['username'],
                        "password" => md5($_POST['password'])
                    ))){
                        $_SESSION["user"] = $find->toArray();
                        array_push($info, "Login success");
                    }else{
                        array_push($errors, "Login failed");
                    }
                }
            }
        }
        function logout(){
            if(isset($_SESSION["user"])){
                session_destroy();
            }
            header("Location: /?route=login");
            die();
        }
        function register(){
            global $errors;
            global $info;
            if(isset($_POST['submit'])){
                if(!isset($_POST['email'])) array_push($errors, "Require Email");
                if(!isset($_POST['username'])) array_push($errors, "Require Username");
                if(!isset($_POST['password'])) array_push($errors, "Require Password");
                if(!isset($_POST['repassword'])) array_push($errors, "Require Confirm Password");
                if(count($errors) == 0){
                    if($_POST['repassword'] != $_POST['password']){
                        array_push($errors, "Password doesn't match");
                    }else{
                        $user = new User(0, $_POST['username'], md5($_POST['password']), $_POST['email']);
                        if($user->find(array(
                            "username" => $_POST['username']
                        ))){
                            array_push($errors, "Username exist");
                        }else{
                            $user = new User(0, $_POST['username'], md5($_POST['password']), $_POST['email']);
                            if($user->save()){
                                $find = $user->find(array(
                                    "username" => $_POST['username']
                                ));
                                $_SESSION["user"] = $find->toArray();
                                array_push($info, "Register success");
                            }else{
                                array_push($errors, "Register failed");
                            }
                        }                        
                    }
                }
            }
        }
    }
?>