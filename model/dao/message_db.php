<?php
    class MessageDAO extends Database{

        public function findRecentMessage($userId){
            // $sql = "SELECT * FROM message WHERE (message_from = :userId ";
            // $sql .= "AND message_id IN (SELECT MAX(message_id) FROM message ";
            // $sql .= "WHERE message_from = :userId AND message_status = 1 GROUP BY message_to)) ";
            // $sql .= "OR (message_to = :userId AND message_id IN (SELECT MAX(message_id) FROM message ";
            // $sql .= "WHERE message_to = :userId AND message_status = 1 GROUP BY message_from))";

            $sql = "SELECT * FROM message INNER JOIN users ON message_from = user_id ";
            $sql .= "AND message_id IN (SELECT max(message_id) FROM message WHERE message_from = user_id) ";
            $sql .= "WHERE message_to = :userId and message_from = user_id GROUP BY user_id ORDER BY message_id DESC";
            
            $params = [
                'userId' =>$userId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $messageMapper = new MessageMapper();

                    $message = $messageMapper->mapRow($row);

                    $messages[] = $message;
                }
                return $messages;
            }
        }

        public function findMessage($messageFrom, $userId){
            $sql = "SELECT * FROM message WHERE message_from = :messageFrom ";
            $sql .= "AND message_to = :userId ";
            $sql .= "OR message_to = :messageFrom AND message_from = :userId ";
            $sql .= "AND message_status != -1 ORDER BY message_id";

            $params = [
                'userId' => $userId,
                'messageFrom' =>$messageFrom
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $messageMapper = new MessageMapper();

                    $message = $messageMapper->mapRow($row);

                    $messages[] = $message;
                }
                return $messages;
            }
        }

        public function findMessageByMessageFromAndMessageTo($messageFrom, $messageTo){
            $sql = "SELECT * FROM message WHERE message_from = :messageFrom ";
            $sql .= "AND message_to = :messageTo AND message_status = 1";

            $params = [
                'messageFrom' => $messageFrom,
                'messageTo' => $messageTo
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $messageMapper = new MessageMapper();

                    $message = $messageMapper->mapRow($row);

                    $messages[] = $message;
                }
                return $messages;
            }
        }

        public function save($message){
            $sql = "INSERT INTO message(message, message_to, message_from, create_date, message_status) ";
            $sql .= "VALUES(:message, :messageTo, :messageFrom, CURRENT_TIMESTAMP, :messageStatus)";

            $params = [
                'message' => $message->getMessage(),
                'messageTo' => $message->getMessageTo(),
                'messageFrom' => $message->getMessageFrom(),
                'messageStatus' => $message->getMessageStatus()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function hideMessage($messageId){
            $sql = "UPDATE message SET message_status = -1 ";
            $sql .= "WHERE message_id = :messageId";

            $params = [
                'messageId' => $messageId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function updateMessageStatusByUserId($userId){
            $sql = "UPDATE message SET message_status = 1 WHERE message_to = :userId";

            $params = [
                'userId' => $userId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }
    }
?>