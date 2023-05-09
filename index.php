<?php
    include_once('model/dao/util/connection.php');
    include_once('model/bl/init.php');
    include_once('model/dao/init.php');
    include_once('model/service/init.php');
    
    $db = new Database();
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 1){
            header('Location: admin/');
        }else if($_SESSION['role'] == 2){
            header('Location: my/home');
        }
    }else{
        include_once('web/view/Login.php');
    }
?>

