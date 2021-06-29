<?php 
    class TweetService{

        public function getTweetLink($tweet){
            
            $x = "/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/";
             $tweet = preg_replace("/(http?s?:\/\/)([\w].+.)([\w.\.])([\w.]+.)+/",
              "<a href='$0' target='_blink' style='color:blue'>$0</a>", $tweet);
            // $tweet = preg_replace("/[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi",
            //  "<a href='$0' target='_blink' style='color:blue'>$0</a>", $tweet);
            //\w [a-zA-Z0-9_]
            $tweet = preg_replace("/#([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/hashtag/$1'>$0</a>", $tweet);
             		
            $tweet = preg_replace("/@([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/profile/$1'>$0</a>", $tweet);
            
            return $tweet;
        }

        public function timeAgo($datetime){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $time    = strtotime($datetime);
             $current = time();
             $seconds = $current - $time;
             $minutes = round($seconds / 60);
            $hours   = round($seconds / 3600);
            $months  = round($seconds / 2600640);
    
            if($seconds <= 60){
                if($seconds == 0){
                    return 'now';
                }else{
                    return $seconds.'s';
                }
            }else if($minutes <= 60){
    
                return $minutes.'m';
    
            }else if($hours <= 24){
    
                return $hours.'h';
    
            }else if($months <= 12){
    
                return date('M j', $time);
    
            }else{
                return date('j M Y', $time);
            }
        }

    }
?>