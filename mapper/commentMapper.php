<?php 
    class CommentMapper{
        public function mapRow($row, ...$params){
            
            foreach($params as $p){
                if($p === 'user'){
                    $user = new User();
                }else if($p === 'tweet'){
                    $tweet = new Tweet();
                }
            }

            $comment = new Comment();
            $comment->setId($row['comment_id']);
            $comment->setStatus($row['comment_status']);
            
            if(isset($user)){
                $user->setId($row['user_id']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
                $user->setScreenName($row['screen_name']);
                $user->setProfileImage($row['profile_image']);
                $comment->setUser($user);
            }

            if(isset($tweet)){
                $tweet->setId($row['tweet_id']);
                $tweet->setStatus($row['tweet_status']);
                $tweet->setTweetImage($row['tweet_image']);
                $comment->setTweet($tweet);
            }

            $comment->setCreateDate($row['comment_create_date']);

            return $comment;
        }
    }
?>