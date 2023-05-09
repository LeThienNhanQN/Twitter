<?php 
    class TrendMapper{
        public function mapRow($row){
            $trend = new Trend();
            $trend->setId($row['trend_id']);
            $trend->setHashtag($row['hashtag']);
            $trend->setTrendStatus($row['trend_status']);
            $trend->setCountUsed($row['count_used']);
            $trend->setCreateDate($row['trends_create_date']);

            if(isset($row['tweetCount'])){
                $trend->setTweetCount($row['tweetCount']);
            }

            return $trend;
        }
    }
?>