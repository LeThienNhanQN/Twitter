<?php

    include_once('../../model/dao/connection.php');
    include_once('../../model/bl/init.php');
    include_once('../../model/service/init.php');
   
    $userService->logout();
    if($userService->LoggedIn() === false){
        header("Location: ".BASE_URL."index.php");

    }
    
?>