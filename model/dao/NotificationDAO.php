<?php 
    class NotificationDAO extends Database{

        public function getNotificationCountByUserId($userId){
            $sql = "SELECT COUNT(message_id) AS totalMessage, (SELECT COUNT(notification_id) FROM notification ";
            $sql .= "WHERE notification_for = :userId AND status = 0) AS totalNotification FROM message ";
            $sql .= "WHERE message_to = :userId AND message_status = 0";

            $params = [
                'userId' => $userId
            ];

            if(!empty(self::dbGetRow($sql, $params))){
                $row = self::dbGetRow($sql, $params);
                
                $totalMessage = $row['totalMessage'];
                $totalNotification = $row['totalNotification'];
                $total = array(
                    "totalMessage" => $totalMessage,
                    "totalNotification" => $totalNotification
                );

                return $total;
            }
        }

        public function getNotification($userId){
            $sql = "CALL statistic_notification(:userId)";
            return self::fetchObj($sql, array('userId' => $userId));
            
        }

        public function hideNotification($userId){
            $sql = "UPDATE notification SET status = 1 WHERE notification_for = :userId";

            $params = [
                'userId' => $userId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function saveNotification($userFor, $userSend, $target, $type){
            $sql = "INSERT INTO notification(notification_for, notification_from, target, type, create_date, status)";
            $sql .= " VALUES(:notificationFor, :notificationFrom, :target, :type, CURRENT_TIMESTAMP, :status)";

            $params = [
                'notificationFor' => $userFor,
                'notificationFrom' => $userSend,
                'target' => $target,
                'type' => $type,
                'status' => 0
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }
    }
?>