<?php 
    $content = filter_input(INPUT_GET, 'c');
    if(!empty($content)){
        
        switch($content){

            case 'listUser':
                include_once("view/user/userManager.php");
            break;
            case 'editUser':
                include_once("view/user/editUser.php");
            break;
            case 'listTweet':
                include_once("view/tweet/list.php");
            break;
           
        }
    }else{
        include_once("view/home.php");
    }
