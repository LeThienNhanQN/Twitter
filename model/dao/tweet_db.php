<?php 
    class TweetDAO extends Database{

        public function uploadImage($file){
            $fileName = $file['name'];
            $fileTml = $file['tmp_name'];
            $fileSize = $file['size'];
            $error = $file['error'];

            $ext = explode('.', $fileName);
            $ext = strtolower(end($ext));
            $allowedExtensions = array('jpg', 'png', 'jpeg');

            if(in_array($ext, $allowedExtensions)){
                if($error === 0){
                    if($fileSize < 3000000){
                        $root = 'public/imagetweet/'.$fileName;
                        move_uploaded_file($fileTml, $_SERVER['DOCUMENT_ROOT'].'/twitter/'.$root);
                        return $root;
                    }else{
                        $GLOBALS['imgError'] = "kích thước file quá lớn";
                    }
                }
            }else{
                $GLOBALS['imgError'] = "Only allowed JPG, PNG JPEG extensions";
            }
        }

        public function save($table, $fields){
            $columns = implode(',', array_keys($fields));
            $values  = ':'.implode(', :', array_keys($fields));
            
            $sql = "INSERT INTO  {$table}({$columns}) VALUES($values)";
            if(self::dbUpdate($sql, $fields)){
                return true;
            }else{
                return false;
            }
        }

        public function tweet($userId, $limit){
            $sql = "SELECT * FROM tweets WHERE tweet_userid = :user_id AND status = 1 ";
            $sql .= "OR tweet_userid IN (SELECT user_receive FROM follow WHERE user_sender = :user_id) ";
            $sql .= "ORDER BY retweet_count DESC limit ".$limit;

            $params = [
                'user_id' => $userId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $rows){
                   $tweetMapper = new TweetMapper();
                   $tweet = $tweetMapper->mapRow($rows);

                   $tweets[] = $tweet;
                }
                return $tweets;
            }
        }

        public function tweetPagination($pageId, $total){
            $sql = "SELECT * FROM tweets ORDER BY retweet_count DESC ";
            $sql .= "LIMIT ". ($pageId - 1) .",".$total;

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $rows){
                   $tweetMapper = new TweetMapper();
                   $tweet = $tweetMapper->mapRow($rows);

                   $tweets[] = $tweet;
                }
                return $tweets;
            }
        }

        public function countRow(){
            $sql = "SELECT COUNT(*) FROM tweets";

            $count = 0;

            if(!empty(self::dbNumRow($sql))){
                return self::dbNumRow($sql);
            }
        }

         //update like
         public function updateLike($tweetId){
            $sql = "UPDATE tweets SET likes_count = likes_count+1 WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId 
            ];
            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

          //update like
          public function unlike($tweetId){
            $sql = "UPDATE tweets SET likes_count = likes_count-1 WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId 
            ];
            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findByTweetId($tweetId){
            $sql = "SELECT * FROM tweets WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $tweetMapper = new TweetMapper();
                $tweet = $tweetMapper->mapRow($row);

                return $tweet;
            }
        }

        public function updateRetweetCount($tweet){
            $sql = "UPDATE tweets SET retweet_count = :retweetCount WHERE tweet_id = :tweetId";

            $params = [
                'retweetCount' => ($tweet->getRetweetCount() + 1),
                'tweetId' => $tweet->getId()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function findById($id){
            $sql = "SELECT * FROM tweets WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $id
            ];

            if(!empty(self::dbGetRow($sql, $params))){
                $row = self::dbGetRow($sql, $params);
                $tweetMapper = new TweetMapper();
                $tweet = $tweetMapper->mapRow($row);

                return $tweet;
            }
        }

        public function deleteById($tweetId){
            $sql = "DELETE FROM tweets WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function countTweetByUserId($userId){
            $sql = "SELECT COUNT(*) FROM tweets WHERE tweet_userid = :userId";

            $params = [
                'userId' => $userId
            ];
            $count = 0;
            if(!empty(self::dbNumRowCondition($sql, $params))){
                $count = self::dbNumRowCondition($sql, $params);
            }
            return $count;
            
        }

        public function countLikeByUserId($userId){
            $sql = "SELECT likes_count FROM tweets WHERE tweet_userid = :userId";

            $params = [
                'userId' => $userId
            ];
            $count = 0;
            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $count += $row['likes_count'];
                }
            }
            
            return $count;
        }

        public function findAll(){
            $sql = "SELECT * FROM tweets";

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                   $tweetMapper = new TweetMapper();

                   $tweet = $tweetMapper->mapRow($row);

                   $tweets[] = $tweet;
                }
                return $tweets;
            }
        }
        public function findTweetByHashtag($hashtag){
            $sql = "SELECT * FROM tweets WHERE tweet_status LIKE :hashtag";

            $params = [
                'hashtag' => '%#'.$hashtag.'%'
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $tweetMapper = new TweetMapper();
                    $tweet = $tweetMapper->mapRow($row);

                    $tweets[] = $tweet;
                }
                return $tweets;
            }
        }

        public function findUserByHashtag($hashtag){
            $sql = "SELECT DISTINCT * FROM tweets WHERE tweet_status LIKE :hashtag ";
            $sql .= "GROUP BY tweet_userid";

            $params = [
                'hashtag' => '%#'.$hashtag.'%'
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $row){
                    $tweetMapper = new TweetMapper();
                    $tweet = $tweetMapper->mapRow($row);

                    $tweets[] = $tweet;
                }
                return $tweets;
            }
        }

        public function findByUserId($userId){
            $sql = "SELECT * FROM tweets WHERE tweet_userid = :user_id ";
            $params = [
                'user_id' => $userId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $rows){
                   $tweetMapper = new TweetMapper();
                   $tweet = $tweetMapper->mapRow($rows);

                   $tweets[] = $tweet;
                }
                return $tweets;
            }
        }

        public function disableTweet($tweetId){
            $sql = "UPDATE tweets SET status = 0 WHERE tweet_id = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function enableTweet($tweetId){
            $sql = "UPDATE tweets SET status = 1 WHERE tweet_id = :tweetId";

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