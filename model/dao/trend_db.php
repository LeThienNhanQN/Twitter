<?php 
    class TrendDAO extends Database{

        public function findByHashtag($hashtag){
            $sql = "SELECT * FROM trends WHERE hashtag LIKE :hashtag";

            $params = [
                'hashtag' => $hashtag.'%'
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $trendMapper = new TrendMapper();
                    $trend = $trendMapper->mapRow($row);

                    $trends[] = $trend;
                }

                return $trends;
            }
        }

        public function checkHashtag($hashtag){
            $sql = "SELECT * FROM trends WHERE hashtag = :hashtag";

            $params = [
                'hashtag' => $hashtag
            ];

            if(empty(self::dbGetRow($sql, $params))){
                return true;
            }else{
                return false;
            }
        }

        public function findByTagUser($keyword){
            $sql = "SELECT user_id, username, screen_name, profile_image, profile_cover FROM users";
            $sql .= " WHERE username LIKE :keyword OR screen_name LIKE :keyword LIMIT 5";

            $params = [
                'keyword' => $keyword.'%'
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $user = new User();
                    $user->setId($row['user_id']);
                    $user->setScreenName($row['screen_name']);
                    $user->setUsername($row['username']);
                    $user->setProfileImage($row['profile_image']);
                    $user->setProfileCover($row['profile_cover']);

                    $users[] = $user;
                }
                return $users;
            }
        }

        public function saveHashtag($hashtag){
            preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
            if($matches){
                $result = array_values($matches[1]);
            }   

            $sql = "INSERT INTO trends(hashtag, trend_status, count_used, trends_create_date) ";
             $sql .= " VALUES(:hashtag, 1, 1, CURRENT_TIMESTAMP)";

            foreach($result as $trend){
                $params = [
                    'hashtag' => $trend
                ];
                self::dbExecute($sql, $params);
            }
        }

        public function findTrend(){
            $sql = "SELECT * FROM trends ORDER BY count_used DESC LIMIT 10";

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                    $trendMapper = new TrendMapper();
                    $trend = $trendMapper->mapRow($row);

                    $trends[] = $trend;
                }
                return $trends;
            }
        }

        public function updateCountByHashtag($hashtag, $count_used){
            $sql = "UPDATE trends SET count_used = :count_used WHERE hashtag = :hashtag";

            $params = [
                'count_used' => $count_used,
                'hashtag' => $hashtag
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findAll(){
            $sql = "SELECT * FROM trends";

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                    $trendMapper = new TrendMapper();

                    $trend = $trendMapper->mapRow($row);

                    $trends[] = $trend;
                }
                return $trends;
            }
        }

        public function statisticTweetUseHashtag(){
            $sql = "SELECT hashtag, COUNT(tweet_id) as tweetCount FROM trends INNER JOIN tweets ";
            $sql .= "ON tweet_status LIKE CONCAT('%#',hashtag,'%') ";
            $sql .= "GROUP BY hashtag ORDER BY tweetCount DESC LIMIT 10";

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                   $trend = new Trend();
                   $trend->setHashtag($row['hashtag']);
                   $trend->setTweetCount($row['tweetCount']);

                    $trends[] = $trend;
                }
                return $trends;
            }
        }

        public function deleteHashtag($hashtag){
            $sql = "DELETE FROM trends WHERE hashtag = :hashtag";

            $params = [
                'hashtag' => $hashtag
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findCountUsedByHashtag($hashtag){
            $sql = "SELECT count_used FROM trends WHERE hashtag = :hashtag";

            $params = [
                'hashtag' => $hashtag
            ];
            $count = 0;
            if(!empty(self::dbGetRow($sql, $params))){
                $row = self::dbGetRow($sql, $params);
                $count = $row['count_used'];
            }
            return $count;
        }

    }
?>