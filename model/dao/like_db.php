<?php
    class LikeDAO extends Database{
        
        public function save($tweetId, $userId, $type){
            $sql = "INSERT INTO likes(user_id, tweet_id, like_date, like_type) ";
            $sql .= "VALUES(:userId, :tweetId, CURRENT_TIMESTAMP, :likeType)";

            $params  = [
                'userId' => $userId,
                'tweetId' => $tweetId,
                'likeType' => $type
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function saveLikeRetweet($retweetId, $userId, $type){
            $sql = "INSERT INTO likes(user_id, retweet_id, like_date, like_type) ";
            $sql .= "VALUES(:userId, :retweetId, CURRENT_TIMESTAMP, :likeType)";

            $params  = [
                'userId' => $userId,
                'retweetId' => $retweetId,
                'likeType' => $type
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        //select like of current user 
        public function findByUserIdAndTweetId($userId, $tweetId){
            $sql = "SELECT * FROM likes WHERE user_id = :userId ";
            $sql .= "AND tweet_id = :tweetId AND like_type = 'tweet'";

            $params = [
                'userId' => $userId,
                'tweetId' => $tweetId
            ];
            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $likeMapper = new LikeMapper();
                $like = $likeMapper->mapRow($row);

                return $like;
            }
            
        }

        public function findByUserIdAndRetweetId($userId, $retweetId){
            $sql = "SELECT * FROM likes WHERE user_id = :userId ";
            $sql .= "AND retweet_id = :retweetId AND like_type = 'retweet'";

            $params = [
                'userId' => $userId,
                'retweetId' => $retweetId
            ];
            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $likeMapper = new LikeMapper();
                $like = $likeMapper->mapRow($row);

                return $like;
            }
        }

        //remove like
        public function unlikeByTweetId($tweetId, $userId, $type){
            $sql = "DELETE FROM likes WHERE user_id = :userId AND tweet_id = :tweetId ";
            $sql .= "AND like_type = :likeType";

            $params = [
                'userId' => $userId,
                'tweetId' => $tweetId,
                'likeType' =>$type
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        //remove like
        public function unlikeByRetweetId($retweetId, $userId, $type){
            $sql = "DELETE FROM likes WHERE user_id = :userId AND retweet_id = :retweetId ";
            $sql .= "AND like_type = :likeType";

            $params = [
                'userId' => $userId,
                'retweetId' => $retweetId,
                'likeType' =>$type
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function deleteByTweetId($tweetId){
            $sql = "DELETE FROM likes WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function countLikeByRetweet($retweetId){
            $sql = "SELECT COUNT(*) FROM likes WHERE retweet_id = :retweetId AND like_type = 'retweet'";

            $params = [
                'retweetId' => $retweetId
            ];

            if(!empty(self::dbNumRowCondition($sql, $params))){
                return self::dbNumRowCondition($sql, $params);
            }
        }

        
    }
?>