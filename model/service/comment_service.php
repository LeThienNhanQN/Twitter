<?php 
    class CommentService{
        public function getCommentLink($tweet){
    
            $tweet = preg_replace("/(http?s?:\/\/)([\w]+.)([\w\.])+/",
             "<a href='$0' target='_blink' style='color:blue'>$0</a>", $tweet);
            //\w [a-zA-Z0-9_]
            $tweet = preg_replace("/#([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/hashtag/$1'>$0</a>", $tweet);
             		
            $tweet = preg_replace("/@([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/$1'>$0</a>", $tweet);
            
            return $tweet;
        }
    }
?>