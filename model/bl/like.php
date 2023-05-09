<?php
    class Like extends AbstractModel{
        private $userId;
        private $tweetId;
        private $likeType;
        private $retweet;

        public function setUserId($userId){
            $this->userId = $userId;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function setTweetId($tweetId){
            $this->tweetId = $tweetId;
        }

        public function getTweetId(){
            return $this->tweetId;
        }

        public function setLikeType($likeType){
            $this->likeType = $likeType;
        }

        public function getLikeType(){
            return $this->likeType;
        }

        public function setRetweet($retweet){
            $this->retweet = $retweet;
        }

        public function getRetweet(){
            return $this->retweet;
        }
    }
?>