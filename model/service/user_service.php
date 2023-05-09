<?php
    
    class UserService{

        public function checkInput($data){
            $data  = htmlspecialchars($data);
            $data = trim($data);

            //loai bo cac dau backslashes trong chuoi
            $data = stripcslashes($data);

            return $data;
        }

        public function logout(){
            if(isset($_SESSION['user_id'])){
                unset($_SESSION['user_id']);
                echo "success";
            }
        }

        public function loggedIn(){
            return (isset($_SESSION['user_id'])) ? true : false;
        }

        public function getTweetLink($tweet){
    
            $tweet = preg_replace("/(http?s?:\/\/)([\w]+.)([\w\.])+/",
             "<a href='$0' target='_blink' style='color:blue'>$0</a>", $tweet);
            //\w [a-zA-Z0-9_]
            $tweet = preg_replace("/#([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/hashtag/$1'>$0</a>", $tweet);
             		
            $tweet = preg_replace("/@([\w]+)/",
             "<a style='color:blue' href='http://localhost/twitter/profile/$1'>$0</a>", $tweet);
            
            return $tweet;
        }    
    }
?>