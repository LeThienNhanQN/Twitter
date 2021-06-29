<?php
    include_once('user_service.php');
    include_once('tweetService.php');
    include_once('comment_service.php');
    include_once('follow_service.php');
    include_once('message_service.php');
    include_once('TrendService.php');

    $userService = new UserService();
    $tweetService = new TweetService();
    $commentService = new CommentService();
    $followService = new FollowService();
    $messageService = new MessageService();
    $trendService = new TrendService();
  
?>