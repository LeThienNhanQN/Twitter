<?php 
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
	include_once('../bl/init.php');
    include_once('../service/init.php');
    
    if(isset($_POST['tweetId']) && !empty($_POST['tweetId'])){
        
        $tweetId = filter_input(INPUT_POST, 'tweetId');
        $commentId = filter_input(INPUT_POST, 'commentId');

        $commentDAO->deleteByTweetIdAndCommentId($commentId, $tweetId);
    }
?>