<?php
    foreach($_GET as $key => $value){
        $_GET[$key] = addslashes(htmlspecialchars(($value)));
    }
    foreach($_POST as $key => $value){
        $_POST[$key] = addslashes(htmlspecialchars(($value)));
    }
?>