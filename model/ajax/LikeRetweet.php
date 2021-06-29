<?php 
    include_once('../dao/util/connection.php');
    include_once('../bl/init.php');
    include_once('../dao/init.php');

    if(isset($_POST['like']) && !empty($_POST['like'])){
        $userId = $_SESSION['user_id'];
        $retweetId = filter_input(INPUT_POST ,'like');

        $likeDAO->save($retweetId, $userId, 'retweet');
        //$userFor = $tweetDAO->findByTweetId($tweetId);
        /*if($userFor->getId() != $userId){
            $notificationDAO->saveNotification($userFor->getId(), $userId, $tweetId, 'like');
        }*/
    }else if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
        $userId = $_SESSION['user_id'];
        $retweetId = filter_input(INPUT_POST ,'unlike');

        $likeDAO->unlikeByRetweetId($retweetId, $userId, 'retweet');
    }
?>