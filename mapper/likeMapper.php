<?php
    class LikeMapper{
        public function mapRow($row){
            $like = new Like();
            $like->setId($row['like_id']);
            $like->setUserId($row['user_id']);
            $like->setTweetId($row['tweet_id']);
            $like->setLikeType($row['like_type']);
            $like->setCreateDate($row['like_date']);
            if(!empty($row['retweet_id'])){
                $retweet = new Retweet();
                $retweet->setId($row['retweet_id']);
                $like->setRetweet($retweet);
            }
            return $like;
        }
    }
?>  