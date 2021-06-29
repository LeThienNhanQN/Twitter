<?php
    include_once('like_db.php');
    include_once('trend_db.php');
    include_once('user_db.php');
    include_once('tweet_db.php');
    include_once('retweet_db.php');
    include_once('comment_db.php');
    include_once('follow_db.php');
    include_once('message_db.php');
    include_once('NotificationDAO.php');

    $userDAO = new UserDAO();
    $tweetDAO = new TweetDAO();
    $trendDAO = new TrendDAO();
    $likeDAO = new LikeDAO();
    $retweetDAO = new RetweetDAO();
    $commentDAO = new CommentDAO();
    $followDAO = new FollowDAO();
    $messageDAO = new MessageDAO();
    $notificationDAO = new NotificationDAO();
?>