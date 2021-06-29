<?php 
    class FollowDAO extends Database{
        
        public function checkFollow($followerId, $userId){
            $sql = "SELECT * FROM follow WHERE user_sender = :userSender AND user_receive = :userReceive";

            $params = [
                'userSender' => $userId,
                'userReceive' => $followerId
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $followMapper = new FollowMapper();
                $follow = $followMapper->mapRow($row);

                return $follow;
            }else{
                return false;
            }
        }

        public function follow($follow){
            $sql = "INSERT INTO follow(user_sender, user_receive, follow_create_date) ";
            $sql .= "VALUES(:userSender, :userReceive, CURRENT_TIMESTAMP)";

            $params = [
                'userSender' => $follow->getUserSender(),
                'userReceive' => $follow->getUserReceive()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function unfollow($follow){
            $sql = "DELETE FROM follow WHERE user_sender = :userSender AND user_receive = :userReceive";

            $params = [
                'userSender' => $follow->getUserSender(),
                'userReceive' => $follow->getUserReceive()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findByUserReceive($userReceive){
            $sql = "SELECT * FROM follow WHERE user_receive = :userReceive";

            $params = [
                'userReceive' => $userReceive
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $followMapper = new FollowMapper();
                    $follow = $followMapper->mapRow($row);

                    $follows[] = $follow; 
                }
                return $follows;
            }
        }
        public function findbyUserSender($userSender){
            $sql = "SELECT * FROM follow WHERE user_sender = :userSender";

            $params = [
                'userSender' => $userSender
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $followMapper = new FollowMapper();
                    $follow = $followMapper->mapRow($row);

                    $follows[] = $follow; 
                }
                return $follows;
            }
        }

        public function findByUserSenderAndReceive($userSender, $userReceive){
            $sql = "SELECT * FROM follow WHERE user_sender = :userSender ";
            $sql .= "AND user_receive = :userReceive";

            $params = [
                'userSender' => $userSender, 
                'userReceive' => $userReceive
            ];

            if(!empty(self::dbGetRow($sql, $params))){
                return true;
            }else{
                return false;
            }
        }

        public function countFollowerByUserId($userId){
            $sql = "SELECT COUNT(*) FROM follow WHERE user_sender = :userId";

            $params = [
                'userId' => $userId
            ];

            if(!empty(self::dbNumRowCondition($sql, $params))){
                return self::dbNumRowCondition($sql, $params);
            }
        }

        public function countFollowingByUserId($userId){
            $sql = "SELECT COUNT(*) FROM follow WHERE user_receive = :userId";

            $params = [
                'userId' => $userId
            ];

            if(!empty(self::dbNumRowCondition($sql, $params))){
                return self::dbNumRowCondition($sql, $params);
            }
        }

      
    }

?>