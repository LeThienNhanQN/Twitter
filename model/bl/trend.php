<?php 
    class Trend extends AbstractModel{
        private $hashtag;
        private $trendStatus;
        private $countUsed;
        private $createDate;
        private $tweetCount;

        public function setHashtag($hashtag){
            $this->hashtag = $hashtag;
        }

        public function getHashtag(){
            return $this->hashtag;
        }

        public function setCreateDate($createDate){
            $this->createDate = $createDate;
        }

        public function getCreateDate(){
            return $this->createDate;
        }

        public function setTrendStatus($trendStatus){
            $this->trendStatus = $trendStatus;
        }

        public function getTrendStatus(){
            return $this->trendStatus;
        }

        public function setCountUsed($countUsed){
            $this->countUsed = $countUsed;
        }

        public function getCountUsed(){
            return $this->countUsed;
        }

        public function setTweetCount($tweetCount){
            $this->tweetCount = $tweetCount;
        }

        public function getTweetCount(){
            return $this->tweetCount;
        }
    }
?>