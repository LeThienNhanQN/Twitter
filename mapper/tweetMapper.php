<?php
    class TweetMapper{
        public function mapRow($row){
            $tweet = new Tweet();
            $tweet->setId($row['tweet_id']);
            $tweet->setStatus($row['tweet_status']);
            $tweet->setUserId($row['tweet_userid']);
            $tweet->setTweetImage($row['tweet_image']);
            $tweet->setLikeCount($row['likes_count']);
            $tweet->setRetweetCount($row['retweet_count']);
            $tweet->setCreateDate($row['tweet_create_date']);
            $tweet->setCheckStatus($row['status']);
          
            return $tweet;
        }
    }
?>  