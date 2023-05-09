<?php 
    class RetweetDAO extends Database{

        public function save($retweet){
            $sql = "INSERT INTO retweets(retweet_status, user_retweet, tweet_id, like_count, post_date)";
            $sql .= " VALUES(:retweetStatus, :userRetweet, :tweetId, 0, CURRENT_TIMESTAMP)";

            $params = [
                'retweetStatus' => $retweet->getRetweetStatus(),
                'userRetweet' => $retweet->getUserRetweet(),
                'tweetId' => $retweet->getTweetId()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findByUserIdAndTweetId($userId, $tweetId){
            $sql = "SELECT * FROM retweets INNER JOIN users ON user_retweet = user_id ";
            $sql .= "WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $retweetMapper = new RetweetMapper();
                    $retweet = $retweetMapper->mapRow($row);

                    $userMapper = new UserMapper();
                    $user = $userMapper->mapRow($row);
                    $retweet->setUser($user);

                    $retweets[] = $retweet;
                }
                return $retweets;
            }
        }

        public function findByUserId($userId){
            $sql = "SELECT * FROM retweets INNER JOIN users ON user_retweet = user_id ";
            $sql .= "WHERE user_retweet = :userId";

            $params = [
                'userId' => $userId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $retweetMapper = new RetweetMapper();
                    $retweet = $retweetMapper->mapRow($row);

                    $userMapper = new UserMapper();
                    $user = $userMapper->mapRow($row);
                    $retweet->setUser($user);

                    $retweets[] = $retweet;
                }
                return $retweets;
            }
        }

        public function countRowByUserIdAndTweetId($userId, $tweetId){
            $sql = "SELECT count(*) FROM retweets WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];
            $count = 0;
            if(!empty(self::dbNumRowCondition($sql, $params))){
                $count = self::dbNumRowCondition($sql, $params);
            }
            return $count;
        }

        public function deleteByTweetId($tweetId){
            $sql = "DELETE FROM retweets WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>