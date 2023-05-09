<?php 
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../bl/init.php');
    include_once('../dao/init.php');

    if(isset($_POST['like']) && !empty($_POST['like'])){
        $userId = $_SESSION['user_id'];
        $tweetId = filter_input(INPUT_POST ,'like');

        $tweetDAO->updateLike($tweetId);
        $likeDAO->save($tweetId, $userId, 'tweet');
        $userFor = $tweetDAO->findByTweetId($tweetId);
       
        $notificationDAO->saveNotification($userFor->getUserId(), $userId, $tweetId, "like");
        
    }else if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
        $userId = $_SESSION['user_id'];
        $tweetId = filter_input(INPUT_POST ,'unlike');

        $tweetDAO->unlike($tweetId);
        $likeDAO->unlikeByTweetId($tweetId, $userId, 'tweet');
    }
?>