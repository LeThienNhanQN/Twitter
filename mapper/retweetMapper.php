<?php
    class RetweetMapper{

        public function mapRow($row){
            $retweet = new Retweet();
            $retweet->setId($row['retweet_id']);
            $retweet->setRetweetStatus($row['retweet_status']);
            $retweet->setUserRetweet($row['user_retweet']);
            $retweet->setTweetId($row['tweet_id']);
            $retweet->setLikeCount($row['like_count']);
            $retweet->setCreateDate($row['post_date']);
            return $retweet;
        }
    }
?>