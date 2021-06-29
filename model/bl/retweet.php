<?php
    class Retweet extends AbstractModel{
        private $retweetStatus;
        private $userRetweet;
        private $tweetId;
        private $user;
        private $likeCount;

        public function setRetweetStatus($retweetStatus){
            $this->retweetStatus = $retweetStatus;
        }

        public function getRetweetStatus(){
            return $this->retweetStatus;
        }

        public function setUserRetweet($userRetweet){
            $this->userRetweet = $userRetweet;
        }

        public function getUserRetweet(){
            return $this->userRetweet;
        }

        public function setTweetId($tweetId){
            $this->tweetId = $tweetId;
        }

        public function getTweetId(){
            return $this->tweetId;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getUser(){
            return $this->user;
        }

        public function setLikeCount($likesCount){
            $this->likesCount = $likesCount;
        }

        public function getLikeCount(){
            return $this->likesCount;
        }


        
    }
?>