<?php 
    class Comment extends AbstractModel{
        private $status;
        private $user;
        private $tweet;

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getUser(){
            return $this->user;
        }

        public function setTweet($tweet){
            $this->tweet = $tweet;
        }

        public function getTweet(){
            return $this->tweet;
        }
    }
?>