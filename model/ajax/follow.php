<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
    include_once('../bl/init.php');
    include_once('../service/init.php');

    if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
        $userSender = filter_input(INPUT_POST, 'unfollow');
        $userReceive = filter_input(INPUT_POST,'userReceiverFollow');

        $follow = new Follow();
        $follow->setUserSender($userSender);
        $follow->setUserReceive($userReceive);

        $followDAO->unfollow($follow);

        
          //trừ số following cho người được user theo dõi
        $user = $userDAO->findById($userReceive);
        $countFollowing = $followDAO->countFollowingByUserId($userReceive);
        if($countFollowing < 1){
            $userDAO->updateFollowing(0, $userReceive);
        }else{
            $userDAO->updateFollowing($countFollowing, $userReceive);
        }

        //trừ số người được user theo dõi
        $userFollowed = $userDAO->findById($userSender);
        $countFollower = $followDAO->countFollowerByUserId($userSender);
        if($countFollower < 1){
            $userDAO->updateFollower(0, $userSender);
        }else{
            $userDAO->updateFollower($countFollower, $userSender);
        }
        
        $arr = array(
            'follower' => $userFollowed->getFollower()
        );  
        //echo  $userFollowed->getFollower();

        echo json_encode($arr);
    }

    if(isset($_POST['follow']) && !empty($_POST['follow'])){
        $userSender = filter_input(INPUT_POST, 'follow');
        $userReceive = filter_input(INPUT_POST,'userReceiverFollow');

        $follow = new Follow();
        $follow->setUserSender($userSender);
        $follow->setUserReceive($userReceive);

        //$target = 11100011001;
        //echo $userReceive;
        $notificationDAO->saveNotification($userReceive, $userSender, 0, 'follow');
        $followDAO->follow($follow);

        //cộng số following cho người được user theo dõi
        $user = $userDAO->findById($userReceive);
        $countFollowing = $followDAO->countFollowingByUserId($userReceive);
        $userDAO->updateFollowing($countFollowing, $userReceive);

        //cộng số người được user theo dõi
        $userFollowed = $userDAO->findById($userSender);
        $countFollower = $followDAO->countFollowerByUserId($userSender);
        $userDAO->updateFollower($countFollower, $userSender);

        $arr = array(
            'follower' => $user->getFollower()
        );
        echo json_encode($arr);
    }
?>