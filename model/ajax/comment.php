<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
	include_once('../bl/init.php');
    include_once('../service/init.php');
    
    if(isset($_POST['comment']) && !empty($_POST['comment'])){
        $status = filter_input(INPUT_POST, 'comment');
        $tweetId = filter_input(INPUT_POST, 'tweetId');
        $userId = filter_input(INPUT_POST, 'userId');

        if(!empty($status)){
            $comment->setStatus($status);
            $user->setId($userId);
            $comment->setUser($user);
            $tweet->setId($tweetId);
            $comment->setTweet($tweet);

            $kt = $commentDAO->save($comment);
            if($kt == false){
                echo 'status invalid';
            }
            $tweets = $tweetDAO->findById($tweetId);
            $comments = $commentDAO->findByTweetId($tweetId);
?>
<!--COMMENTS--> 
<?php 
    if(!empty($comments)):
        foreach($comments as $comment):
    ?>
    <div class="tweet-show-popup-comment-box">
        <div class="tweet-show-popup-comment-inner">
            <div class="tweet-show-popup-comment-head">
                <div class="tweet-show-popup-comment-head-left">
                    <div class="tweet-show-popup-comment-img">
                        <img src="<?php echo BASE_URL.$comment->getUser()->getProfileImage(); ?>">
                    </div>
                </div>
                <div class="tweet-show-popup-comment-head-right">
                    <div class="tweet-show-popup-comment-name-box">
                        <div class="tweet-show-popup-comment-name-box-name"> 
                            <a href="<?php echo BASE_URL.'profile/'.$comment->getUser()->getUsername(); ?>">
                            <?php echo $comment->getUser()->getScreenName(); ?></a>
                        </div>
                        <div class="tweet-show-popup-comment-name-box-tname">
                            <a href="<?php echo BASE_URL.'profile/'.$comment->getUser()->getUsername(); ?>">
                            @<?php echo $comment->getUser()->getUsername().' - '.
                                $comment->getCreateDate()
                            ?>
                            </a>
                        </div>
                    </div>
                    <div class="tweet-show-popup-comment-right-tweet">
                        <p>
                        <a href="<?php echo BASE_URL.'profile/'.$comment->getUser()->getUsername(); ?>">
                        @<?php echo $comment->getUser()->getUsername(); ?>
                        </a>
                        <!-- get link -->
                            <?php echo $commentService->getCommentLink($comment->getStatus()); ?>
                            </p>
                    </div>
                    <div class="tweet-show-popup-footer-menu">
                        <ul>
                            <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
                            <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                            <?php 
                                if($comment->getUser()->getId() == $userId):
                            ?>
                            <li>
                                <a class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul> 
                                    <li>
                                        <label class="deleteTweet">Delete comment</label>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--TWEET SHOW POPUP COMMENT inner END-->
    </div>
    <?php 
        endforeach;
        endif;
    ?>

<?php
        }
    }
    
?>
