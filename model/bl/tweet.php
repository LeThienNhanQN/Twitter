<?php

    class Tweet extends AbstractModel{

        private $status;
        private $userId;
        private $tweetImage;
        private $likesCount;
        private $retweetCount;
        private $checkStatus;

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setUserId($userId){
            $this->userId = $userId;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function setTweetImage($tweetImage){
            $this->tweetImage = $tweetImage;
        }

        public function getTweetImage(){
            return $this->tweetImage;
        }

        public function setLikeCount($likesCount){
            $this->likesCount = $likesCount;
        }

        public function getLikeCount(){
            return $this->likesCount;
        }

        public function setRetweetCount($retweetCount){
            $this->retweetCount = $retweetCount;
        }

        public function getRetweetCount(){
            return $this->retweetCount;
        }

        public function getCheckStatus(){
            return $this->checkStatus;
        }

        public function setCheckStatus($checkStatus){
            $this->checkStatus = $checkStatus;
        }
    }
?>