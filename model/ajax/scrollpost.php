<?php 
     include_once('../dao/util/connection.php');
     include_once('../../mapper/mapper.php');
     include_once('../bl/init.php');
     include_once('../dao/init.php');
     include_once('../service/init.php');

     if(isset($_POST['scrollPost']) && !empty($_POST['scrollPost'])){
         $userId = $_SESSION['user_id'];
         $limit = (int) trim(filter_input(INPUT_POST, 'scrollPost'));
         $tweets = $tweetDAO->tweet($userId, $limit);
     }
?>

<?php
    include_once('../../web/include/newfeed.php');
?>