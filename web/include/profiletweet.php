<?php
    if(isset($tweets)):
    foreach($tweets as $tweet):
        $user = $userDAO->findById($tweet->getUserId());
        if(!empty($likeDAO->findByUserIdAndTweetId($_SESSION['user_id'], $tweet->getId()))){
            $like = $likeDAO->findByUserIdAndTweetId($_SESSION['user_id'], $tweet->getId());
        }
        $countRetweet = $retweetDAO->countRowByUserIdAndTweetId($tweet->getUserId(), $tweet->getId());    
        $retweets = $retweetDAO->findByUserIdAndTweetId($tweet->getUserId(), $tweet->getId());
?>

    <div class="all-tweet">
    <div class="t-show-wrap" style="margin-top: 15px;">	
    <div class="t-show-inner">
       <?php 
           
           // foreach($retweets as $retweet):
               // $user = $userDAO->findById($retweet->getUserRetweet());
        ?>
        
        <div class="t-show-popup" data-tweet="<?php echo $tweet->getId(); ?>">
            <div class="t-show-head">
                <div class="t-show-img">
                    <img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
                </div>
                <div class="t-s-head-content">
                    <div class="t-h-c-name">
                        <span><a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
                            <?php echo $user->getScreenName(); ?></a>
                        </span>
                        <span>@<?php echo $user->getUsername(); ?></span>
                        <span><?php echo $tweet->getCreateDate(); ?></span>
                    </div>
                    <div class="t-h-c-dis">
                        <?php echo $tweetService->getTweetLink($tweet->getStatus()); ?>
                    </div>
                </div>
            </div>
            <!--tweet show head end-->
            <div class="t-show-body">
            <div class="t-s-b-inner">
            <?php
                if($tweet->getTweetImage() != ""):
            ?>
            <div class="t-s-b-inner-in">
                <img src="<?php echo BASE_URL.$tweet->getTweetImage(); ?>" 
                class="imagePopup" data-tweet="<?php echo $tweet->getId(); ?>"/>
            </div>
                <?php endif; ?>
            </div>
            </div>
            <!--tweet show body end-->
        </div>
        <div class="t-show-footer">
            <div class="t-s-f-right">
                <ul> 
                    <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
                    <!-- share -->
                    <li>
                        <button class="retweet" title="Chia sẻ" 
                        data-tweet="<?php echo $tweet->getId(); ?>" 
                        data-user="<?php echo $tweet->getUserId(); ?>">
                            <i class="fa fa-retweet" aria-hidden="true"></i>
                            <span class="retweetCount"><?php echo $countRetweet ?></span>
                        </button>
                    </li>
                    <!-- /end share -->

                    <li>

                    <!-- check like on user -->
                    <?php
                        if($like->getTweetId() == $tweet->getId()){
                    ?>
                        <button class="unlike-btn"  
                            data-tweet="<?php echo $tweet->getId(); ?>" 
                            data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="likeCount">
                                <?php echo $tweet->getLikeCount() > 0 ? $tweet->getLikeCount() : ''; ?>
                            </span>
                        </button>
                    <?php
                        }else {
                    ?>
                        <button class="like-btn"  
                            data-tweet="<?php echo $tweet->getId(); ?>" data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="likeCount">
                                <?php echo $tweet->getLikeCount() > 0 ? $tweet->getLikeCount() : '';?>
                            </span>
                        </button>
                    <?php 
                        }
                    ?>
                    
                    
                    </li>
                        <li>
                        <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <ul> 
                        <?php
                            if($tweet->getUserId() == $_SESSION['user_id']):
                        ?>
                        <li>
                            <label class="deleteTweet" 
                                data-tweet="<?php echo $tweet->getId(); ?>" 
                                data-user="<?php echo $_SESSION['user_id'] ?>">
                                xoá Tweet
                            </label>                    
                        </li>
                        <?php
                            endif;
                        ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
       
      
    </div>
    </div>
    </div>
    <?php endforeach; endif; ?>