<?php 
    class CommentDAO extends Database{

        public function findByTweetId($tweetId){
            $sql = "SELECT * FROM comment c INNER JOIN users u";
            $sql .= " ON c.comment_by = u.user_id";
            $sql .= " INNER JOIN tweets t ON c.comment_tweet = t.tweet_id";
            $sql .= " WHERE c.comment_tweet = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $rows){
                    $commentMapper = new CommentMapper();
                    $comment = $commentMapper->mapRow($rows, 'user', 'tweet');

                    $comments[] = $comment;
                }
                return $comments;
            }
        }

        public function save($comment){
            $sql = "INSERT INTO comment(comment_status, comment_by, comment_tweet, comment_create_date) ";
            $sql .= "VALUES(:status, :commentBy, :commentTweet, CURRENT_TIMESTAMP)";
            $params = [
                'status' => $comment->getStatus(),
                'commentBy' => $comment->getUser()->getId(),
                'commentTweet' => $comment->getTweet()->getId()
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function deleteByTweetId($tweetId){
            $sql = "DELETE FROM comment WHERE comment_tweet = :tweetId";

            $params = [
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function deleteByTweetIdAndCommentId($commentId, $tweetId){
            $sql = "DELETE FROM comment WHERE comment_id = :commentId AND comment_tweet = :tweetId";

            $params = [
                'commentId' => $commentId,
                'tweetId' => $tweetId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        
    }
?>