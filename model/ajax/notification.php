<?php 
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
	include_once('../bl/init.php');
    include_once('../service/init.php');

    if(isset($_GET['showNotification']) && !empty($_GET['showNotification'])){
        $userId = $_SESSION['user_id'];
        $notification = $notificationDAO->getNotificationCountByUserId($userId);

        echo json_encode($notification);
    }
?>