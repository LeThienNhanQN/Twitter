<?php
    class TrendService{

        public function statisticTweetUseHashtag(){
            $trendDAO = new TrendDAO();
            return $trendDAO->statisticTweetUseHashtag();
        }
    }
?>