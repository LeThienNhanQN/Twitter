<?php 
    
    /*$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
    $appPath = explode('/', $uri);
    echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . $appPath[1] . '/admin';*/
    include_once('../model/dao/util/connection.php');
    include_once('../mapper/mapper.php');
    include_once('../model/bl/init.php');
    include_once('../model/dao/init.php');
    include_once('../model/service/init.php');

    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 1){
           include_once('view/common/admin.php');
        }else if($_SESSION['role'] == 2){
            header('Location: '.BASE_URL.'my/home');
        }
    }
?>