<?php
    include_once('AbstractModel.php');
    include_once('user.php');
    include_once('follow.php');
    include_once('tweet.php');
    include_once('trend.php');   
    include_once('like.php');
    include_once('retweet.php');
    include_once('comment.php');
    include_once('message.php');
    include_once('Notification.php');
    include_once('Role.php');
    
    session_start();

    $user = new User();
    $tweet = new Tweet();
    $follow = new Follow();
    $trend = new Trend();
    $like = new Like();
    $retweet = new Retweet();
    $comment = new Comment();
    $message = new Message();
    $notification = new Notification();

    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
    $appPath = explode('/', $uri);
    define("BASE_URL", "http://". $_SERVER['HTTP_HOST']."/".$appPath[1]."/");
?>