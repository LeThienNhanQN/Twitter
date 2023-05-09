<?php 
    function timeAgo($datetime){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = strtotime($datetime);
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

    echo timeAgo('2021-01-14 22:04:46');

?>